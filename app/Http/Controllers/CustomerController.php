<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    function info()
    {
        return view('info');
    }
    function login()
    {
        return view('login');
    }
    function logout(Request $request)
    {
        $customer = Customer::findOrFail(auth()->guard('customer')->user()->id);
        $customer->update(['status' => 0]);
        $customer->save();

        Auth::guard('customer')->logout();

        $request->session()->regenerateToken();

        return back();
    }
    function login_store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ], [], [
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ])->validate();

        if (Auth::guard('customer')->attempt($data)) {
            $request->session()->regenerate();
            Alert::success('Đăng nhập thành công!');
            if (Auth::guard('customer')->user()) {
                $customer = Customer::findOrFail(auth()->guard('customer')->user()->id);
                $customer->update(['status' => 1]);
                $customer->save();
            }
            return redirect()->route('home');
        } else {
            Alert::warning('Tên tài khoản hoặc mật khẩu không đúng!');
            return redirect()->back();
        }

        return view('login');
    }
    function register()
    {
        return view('register');
    }
    function register_store(Request $request)
    {
        $data = $request->all();
        
        $this->customValidator($data, [
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ],[
            'fullName' => 'Họ tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Nhập lại mật khẩu',
        ]);

        unset($data['_token']);
        unset($data['confirm_password']);
        $data['password'] = Hash::make($request->password);
        $data['avatar'] = 'default.png';

        $cus = Customer::updateOrCreate($data);
        $cus->save();

        Alert::success('Đăng ký thành công!');
        return redirect()->route('home.login');
    }
    function index()
    {
        $customer = Customer::orderBy('id', 'desc')->get();
        return view('admin.customer.index', compact('customer'));
    }
    function add()
    {
        return view('admin.customer.add');
    }
    function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.edit', compact('customer'));
    }
    function delete($id)
    {
        $customer = Customer::find($id);
        // Nếu khách hàng có comment
        if ($customer->comment) {
            foreach ($customer->comment as $item) {
                $item->delete();
            }
        }
        // Nếu khách hàng có phản hồi
        if ($customer->comment) {
            foreach ($customer->comment as $item) {
                $item->delete();
            }
        }
        if ($customer->delete()) {
            toast()->success('Xóa khách hàng thành công!');
            return back();
        }
    }
    function store(Request $request)
    {
        $data = $request->all();

        $this->customValidate($data);

        unset($data['_token']);
        unset($data['confirm_password']);

        $file = $request->file('avatar');

        $file = $request->file('avatar');
        if ($file) {
            $filename = rand() . $file->getClientOriginalName();
            $file->storeAs('/public/avatar', $filename);
            $data['avatar'] = $filename;
        } else {
            $data['avatar'] = 'default.png';
        }

        $cus = Customer::updateOrCreate($data);
        $cus->save();

        return redirect()->route('admin.customer');
    }
    function update(Request $request, $id = null)
    {
        $data = $request->all();
        $this->customValidate($data, $id);

        unset($data['_token']);
        unset($data['confirm_password']);

        $file = $request->file('avatar');
        $customer = Customer::find($id);

        if ($file) {
            $filename = rand() . $file->getClientOriginalName();
            $file->storeAs('/public/avatar', $filename);
            $data['avatar'] = $filename;
            if ($customer->avatar != 'default.png') {
                Storage::delete('/public/avatar/' . $customer->avatar);
            }
        } else {
            $data['avatar'] = $customer->avatar;
        }

        if ($data['password'] != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $customer->password;
        }

        $customer->update($data);
        $customer->save();
        return redirect()->route('admin.customer');
    }
    function customValidate($data, $id = null)
    {
        $validator = Validator::make($data, [
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => $id ? '' : 'required',
            'confirm_password' => $id ? '' : 'required|same:password'
        ], [], [
            'fullName' => 'Họ tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Nhập lại mật khẩu'
        ])->validate();

        return $validator;
    }
    function storeChangePassword(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        Validator::make($data, [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|min:6|same:new_password'
        ], [], [
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
            'confirm_new_password' => 'Nhập lại mật khẩu mới'
        ])->validate();

        $id = Auth::guard('customer')->user()->id;

        if (!Hash::check($data['old_password'], Auth::guard('customer')->user()->password)) {
            toast()->error('Mật khẩu cũ không đúng');
            return back();
        } else {
            unset($data['confirm_new_password']);
            $new_password = Hash::make($data['new_password']);
            $customer = Customer::find($id);
            $customer->update(['password' => $new_password]);
            toast()->success('Thay đổi mật khẩu thành công!');
            return back();
        }
    }
    function changePassword()
    {
        return view('change_password');
    }
    function my_order()
    {
        $id_customer = Auth::guard('customer')->user()->id;
        $order = Order::where('id_customer', $id_customer)->get();
        $total = Order::where('id_customer', $id_customer)->sum('total');
        return view('my_order', compact(['order', 'total']));
    }
}
