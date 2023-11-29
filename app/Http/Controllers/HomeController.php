<?php

namespace App\Http\Controllers;

use App\Helper\CartHelper;
use App\Models\About;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Post;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    // Trang chủ
    function index()
    {
        $firstCategory = Category::first();
        $new_product = Product::orderByDesc('id')->take(8)->get();
        $top_products = DB::table('products')
            ->join('order_details', 'products.id', '=', 'order_details.id_product')
            ->selectRaw('products.id,products.name,products.image,products.price')
            ->orderByDesc('quantity')
            ->take(8)
            ->get();

        return view('welcome', compact('new_product', 'firstCategory', 'top_products'));
    }
    // Tìm kiếm
    function search(Request $request)
    {
        $key = $request->key;
        $product = Product::where('name', 'like', '%' . $key . '%')->get();
        return view('search', compact(['product', 'key']));
    }
    // Giới thiệu
    function about()
    {
        $about = About::all();
        return view('about', compact('about'));
    }
    // Tin tức
    function news()
    {
        $post = Post::all();
        $post_new = Post::orderByDesc('id')->get();
        return view('news', compact(['post', 'post_new']));
    }
    // Chi tiết tin tức
    function new_detail($id = null)
    {
        $post = Post::find($id);
        // Lấy ra bài viết mới nhất
        $posts = Post::orderByDesc('id')->get();
        // Lấy ra comment   
        $comment = Comment::where('id_post', $post->id)->orderBy('id', 'desc')->get();
        // Tăng lượt xem khi click vào
        $post->update(['views' => $post->views + 1]);
        $post->save();

        return view('new_detail', compact(['post', 'posts', 'comment']));
    }
    // Sản phẩm
    function product($id = null)
    {
        if ($id) {
            $product = Product::where('categoryId', $id)->get();
            return view('product')->with(['product' => $product]);
        } else {
            $category =  Category::all();
            return view('product', compact('category'));
        }
    }
    // Liên hệ
    function contact()
    {
        return view('contact');
    }
    // Lưu liên hệ
    function contact_store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required|min:8|max:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'content' => 'required',
        ], [], [
            'firstName' => 'Tên',
            'lastName' => 'Họ',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'content' => 'Nội dung',
        ])->validate();

        // if (!Auth::guard('customer')->check()) {
        //     alert()->warning('Bạn chưa đăng nhập!', ' Vui lòng đăng nhập và thử lại sau.');
        // } else if ($validator->fails()) {
        //     $errors = $validator->errors()->first();
        //     toast($errors, 'warning');
        // } else {
        // }
        Contact::create($data);
        Alert::success('success', 'Cảm ơn bạn đã liên hệ cho chúng tôi!');
        return back();
    }
    // Danh mục sp
    function menu()
    {
        $category = Category::orderByDesc('id')->get();
        return view('menu', compact('category'));
    }
    // Chi tiết sp
    function product_detail($id = null)
    {
        $product = Product::find($id);
        return view('product_detail', compact('product'));
    }
    // Đổi avatar
    function changeAvatar(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $id = Auth::guard('customer')->user()->id;
        $old_customer = Customer::find($id);

        $file = $request->file('avatar');
        if ($file) {
            $filename = $file->hashName();
            $file->storeAs('/public/avatar', $filename);
            $data['avatar'] = $filename;
        } else {
            $data['avatar'] = $old_customer->avatar;
        }

        if ($file && $old_customer->avatar != 'default.png') {
            Storage::delete('/public/avatar/' . $old_customer->avatar);
        }

        $cus = Customer::updateOrCreate(['id' => $id], $data);
        $cus->save();
        toast()->success('Cập nhật avatar thành công!');

        return redirect()->route('home.info');
    }
    // Thanh toán
    function pay()
    {
        return view('pay');
    }
    // Đặt hàng
    function order(CartHelper $cart, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $validator = Validator::make($data, [
            'email' => 'required',
            'fullName' => 'required',
            'phone' => 'required|min:8|max:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ], [], [
            'email' => 'Email',
            'fullName' => 'Họ và tên',
            'phone' => 'Điện thoại',
        ])->validate();

        $order_status_first = OrderStatus::first()->id;

        $dt = [
            'fullName' => $data['fullName'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'note' => $data['note'],
            'total' => $cart->total_price,
            'id_status' => $order_status_first,
            'id_customer' => Auth::guard('customer')->user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        // Lưu vào database
        $order = Order::updateOrCreate($dt);

        if ($order) {
            foreach ($cart->items as $item) {
                $data_order = [
                    'id_order' => $order->id,
                    'id_product' => $item['id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ];
                $ctdh = OrderDetail::create($data_order);
                if($ctdh->product){
                    $ctdh->product->decrement('inStock', $item['quantity']);
                }
            }
            $cart->clearAll();
            alert()->success('Đặt hàng thành công!');
            return redirect()->route('home');
        } else {
            alert()->warning('Đặt hàng không thành công!');
        }
    }
}
