<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index()
    {
        return view("admin.login");
    }
    function store_login(Request $request)
    {
        unset($request['_token']);

        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required'
        ], [], [
            'email' => 'Email',
            'password' => 'Password'
        ])->validate();

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            alert()->success('Đăng nhập thành công!');
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back();
        }
    }
    function register()
    {
        return view('admin.register');
    }
    function store_register(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);


        $validator = Validator::make($data, [
            'fullName' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [], [
            'fullName' => 'Họ tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Nhập lại mật khẩu',
        ])->validate();

        unset($data['confirm_password']);

        $data['id_role'] = 1;

        $user = User::updateOrCreate($data);
        $user->password = Hash::make($request->password);
        $user->save();
        alert()->success('Đăng ký thành công!');
        return redirect()->route('admin.login');
    }
    function dashboard()
    {
        // Danh mục sản phẩm
        $product_category = Category::count();
        // Đơn hàng hôm nay
        $order = Order::where('created_at', '>=', Carbon::today())->count();
        // Sản phẩm
        $product = Product::count();
        // Tổng doanh thu hôm nay
        $total_order_today = DB::table('orders')->where('created_at', '>=', Carbon::today())->sum('orders.total');
        // Khách hàng
        $customer = Customer::count();
        // Sản phẩm bán chạy
        $top_product = DB::table('products')->join('order_details', 'products.id', '=', 'order_details.id_product')
            ->selectRaw('image,id_product,name,id_order, sum(quantity) as quantity')
            ->groupBy('id_product')
            ->orderBy('quantity', 'desc')
            ->take(5)
            ->get();

        $userOnline = Customer::where('status', 1)
        ->count();

        $monthArr = [
            1 => 'Tháng 1',
            2 => 'Tháng 2',
            3 => 'Tháng 3',
            4 => 'Tháng 4',
            5 => 'Tháng 5',
            6 => 'Tháng 6',
            7 => 'Tháng 7',
            8 => 'Tháng 8',
            9 => 'Tháng 9',
            10 => 'Tháng 10',
            11 => 'Tháng 11',
            12 => 'Tháng 12'
        ];
        $totalRevenue = Order::selectRaw("month(created_at) as month, SUM(total) as total_revenue")
            ->groupBy('month')
            ->get();
        
        $labels = [];
        $revenueData = [];

        foreach ($totalRevenue as $item) {
            $month = $monthArr[$item->month]; 
            $labels[] = $month;
            $revenueData[] = $item->total_revenue;
        }

        return view("admin.dashboard", compact(
            [
                'product_category',
                'total_order_today',
                'order',
                'product',
                'customer',
                'top_product',
                'labels',
                'revenueData',
                'userOnline'
            ]
        ));
    }
    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
