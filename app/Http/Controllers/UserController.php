<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index()
    {
        $user = User::orderBy('id', 'desc')->paginate(5);
        return view('admin.user.index', compact('user'));
    }
    function add()
    {
        $role = Role::all();
        return view('admin.user.add', compact('role'));
    }
    function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();
        return view('admin.user.edit', compact(['user', 'role']));
    }
    function store(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);

        $this->customValidate($data);

        $file = $request->file('avatar');

        if ($file) {
            $filename = $file->hashName();
            $file->storeAs("/public/avatar", $filename);
            $data['avatar'] = $filename;
        } else {
            $data['avatar'] = "default.png";
        }

        unset($data['confirm_password']);

        $user = User::updateOrCreate($data);
        $user->save();
        toast()->success('Thêm thành công!');

        return redirect()->route('admin.user');
    }
    function update(Request $request, $id = null)
    {

        $data = $request->all();
        unset($data['_token']);

        $this->customValidate($data, $id);

        $user = User::find($id);
        $file = $request->file('avatar');

        if ($file) {
            $filename = rand() . $file->getClientOriginalName();
            $file->storeAs('/public/avatar', $filename);
            $data['avatar'] = $filename;
            if($user->avatar != 'default.png'){
                Storage::delete('/public/avatar/' . $user->avatar);
            }
        } else {
            $data['avatar'] = $user->avatar;
        }

        if ($data['password'] != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }

        unset($data['confirm_password']);

        $user->update($data);
        toast()->success('Cập nhật thành công!');
        return redirect()->route('admin.user');
    }

    function delete($id)
    {
        User::find($id)->delete();
        return back();
    }
    function customValidate($data, $id = null)
    {
        $validator = Validator::make($data, [
            'fullname' => 'required',
            'email' => $id ? 'required|email' : 'required|email|unique:users', // Nếu cập nhật thì bỏ validate unique
            'password' => $id ? '' : 'required',
            'id_role' => 'required',
            'confirm_password' => $id ? '' : 'required|same:password',
        ], [], [
            'fullname' => 'Họ tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'id_role' => 'Chức vụ',
            'confirm_password' => 'Nhập lại mật khẩu',
        ])->validate();
        return $validator;
    }
}
