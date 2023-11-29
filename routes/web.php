<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductAttributesController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return view('test');
});
// Client
Route::prefix("/")->group(function () {
    // Trang chủ
    Route::get('/', [HomeController::class, 'index'])->name("home");
    // Tìm kiếm
    Route::get('/tim-kiem', [HomeController::class, 'search'])->name("home.search");
    // Đăng nhập client
    Route::get('/dang-nhap', [CustomerController::class, 'login'])->name("home.login");
    Route::post('/dang-nhap', [CustomerController::class, 'login_store'])->name("home.login.store");
    // Đăng ký client
    Route::get('/dang-ky', [CustomerController::class, 'register'])->name("home.register");
    Route::post('/dang-ky', [CustomerController::class, 'register_store'])->name("home.register.store");
    // Trang đăng xuất
    Route::get('/dang-xuat', [CustomerController::class, 'logout'])->name("home.logout");
    // Trang giới thiệu
    Route::get('/gioi-thieu', [HomeController::class, 'about'])->name("home.about");
    // Trang sản phẩm
    Route::get('/san-pham/{id?}', [HomeController::class, 'product'])->name("home.product");
    // Trang Chi tiết sản phẩm
    Route::get('/chi-tiet/{id?}', [HomeController::class, 'product_detail'])->name("home.product_detail");
    // Thông tin tài khoản
    Route::prefix('/tai-khoan')->middleware('customer')->group(function () {
        // Trang thông tin  
        Route::get('/thong-tin', [CustomerController::class, 'info'])->name("home.info");
        Route::get('/don-hang', [CustomerController::class, 'my_order'])->name("home.my_order");
        Route::get('/doi-mat-khau', [CustomerController::class, 'changePassword'])->name("home.changePassword");
        Route::post('/doi-mat-khau', [CustomerController::class, 'storeChangePassword'])->name("home.storeChangePassword");
    });
    // Đổi Avatar
    Route::post('/doi-avatar', [HomeController::class, 'changeAvatar'])->name("home.customer.changeAvatar")->middleware('customer');
    // Trang tin tức
    Route::get('/tin-tuc', [HomeController::class, 'news'])->name("home.news");
    // Trang chi tiết bài viết
    Route::get('/chi-tiet-bai-viet/{id?}', [HomeController::class, 'new_detail'])->name("home.new_detail");
    // Comment
    Route::post('/binh-luan', [CommentController::class, 'store'])->name('home.comment.store')->middleware('customer');
    // Xóa comment
    Route::get('/binh-luan/{id?}', [CommentController::class, 'delete'])->name('home.comment.delete')->middleware('customer');
    // Reply
    Route::post('/tra-loi', [ReplyController::class, 'store'])->name('home.reply.store')->middleware('customer');
    // Liên hệ
    Route::get('/lien-he', [HomeController::class, 'contact'])->name('home.contact');
    Route::post('/lien-he', [HomeController::class, 'contact_store'])->name('home.contact.store')->middleware('customer');
    // Thực đơn
    Route::get('/thuc-don', [HomeController::class, 'menu'])->name('home.menu');
    // Giỏ hàng
    Route::prefix('/gio-hang')->middleware('customer')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('home.giohang');
        Route::get('/add/{id?}', [CartController::class, 'add'])->name('home.giohang.add');
        Route::post('/update', [CartController::class, 'update'])->name('home.giohang.update');
        Route::get('/remove/{id?}', [CartController::class, 'remove'])->name('home.giohang.remove');
        Route::get('/clearAll', [CartController::class, 'clearAll'])->name('home.giohang.clearAll');
    });
    // Thanh toán
    Route::get('/thanh-toan', [HomeController::class, 'pay'])->name('home.thanhtoan');
    // Đặt hàng
    Route::post('/dat-hang', [HomeController::class, 'order'])->name('home.dathang');
});
// Admin
Route::prefix('admin')->group(function () {
    // Đăng nhập
    Route::get('/', [AdminController::class, 'index'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'store_login'])->name('admin.store_login');
    // Đăng ký admin
    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/store-register', [AdminController::class, 'store_register'])->name('admin.store_register');
    // Đăng xuât
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
    // Sản phẩm
    Route::prefix('products')->middleware('auth')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/add', [ProductController::class, 'add'])->name('admin.product.add');
        Route::get('/edit/{id?}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::get('/delete/{id?}', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::post('/update/{id?}', [ProductController::class, 'update'])->name('admin.product.update');

        Route::get('/product-category', [ProductController::class, 'product_category'])->name('admin.product.product_category');

        Route::get('/list', [ProductController::class, 'list']);
    });
    // Danh mục
    Route::prefix('categories')->middleware('auth')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category');
    });
    // Thuộc tính sản phẩm
    Route::prefix('attributes')->middleware('auth')->group(function () {
        Route::get('/add/{id?}', [ProductAttributesController::class, 'add'])->name('admin.attribute.add');
        Route::get('/update/{id?}', [ProductAttributesController::class, 'update'])->name('admin.attribute.update');
        Route::post('/store-update/{id?}', [ProductAttributesController::class, 'store_update'])->name('admin.attribute.store_update');
        Route::post('/store/{id?}', [ProductAttributesController::class, 'store'])->name('admin.attribute.store');
        Route::get('/delete/{id?}', [ProductAttributesController::class, 'delete'])->name('admin.attribute.delete');
    });
    // Hãng xe
    Route::prefix('brands')->middleware('auth')->group(function () {
        Route::get('/{id?}', [CarBrandController::class, 'index'])->name('admin.brand');
        Route::get('/add', [CarBrandController::class, 'add'])->name('admin.brand.add');
        Route::post('/store/{id?}', [CarBrandController::class, 'store'])->name('admin.brand.store');
        Route::get('/delete/{id?}', [CarBrandController::class, 'delete'])->name('admin.brand.delete');
    });
    // User
    Route::prefix('users')->middleware('auth', 'admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::get('/add', [UserController::class, 'add'])->name('admin.user.add');
        Route::get('/edit/{id?}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::post('/update/{id?}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/delete/{id?}', [UserController::class, 'delete'])->name('admin.user.delete');
    });
    // Role
    Route::prefix('roles')->middleware('auth', 'admin')->group(function () {
        Route::get('/{id?}', [RoleController::class, 'index'])->name('admin.role');
        Route::post('/store/{id?}', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    });
    // Khách hàng
    Route::prefix('customers')->middleware('auth')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customer');
        Route::get('/add', [CustomerController::class, 'add'])->name('admin.customer.add');
        Route::get('/edit/{id?}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::post('/store/{id?}', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::post('/update/{id?}', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::get('/delete/{id?}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
    });
    // Bài viết
    Route::prefix('posts')->middleware('auth')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.post');
        Route::get('/add', [PostController::class, 'add'])->name('admin.post.add');
        Route::get('/edit/{id?}', [PostController::class, 'edit'])->name('admin.post.edit');
        Route::get('/show/{id?}', [PostController::class, 'show'])->name('admin.post.show');
        Route::post('/store/{id?}', [PostController::class, 'store'])->name('admin.post.store');
        Route::get('/delete/{id?}', [PostController::class, 'delete'])->name('admin.post.delete');
    });
    // Bình luận
    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('admin.comment');
        Route::get('/edit/{id?}', [CommentController::class, 'edit'])->name('admin.comment.edit');
        Route::post('/store/{id?}', [CommentController::class, 'store'])->name('admin.comment.store');
        Route::get('/delete/{id?}', [CommentController::class, 'delete'])->name('admin.comment.delete');
    });
    // Banner
    Route::prefix('banners')->group(function () {
        Route::get('/{id?}', [BannerController::class, 'index'])->name('admin.banner');
        Route::get('/edit/{id?}', [BannerController::class, 'edit'])->name('admin.banner.edit');
        Route::post('/store/{id?}', [BannerController::class, 'store'])->name('admin.banner.store');
        Route::get('/delete/{id?}', [BannerController::class, 'delete'])->name('admin.banner.delete');
    });
    // Giới thiệu
    Route::prefix('abouts')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('admin.about');
        Route::get('/add', [AboutController::class, 'add'])->name('admin.about.add');
        Route::get('/edit/{id?}', [AboutController::class, 'edit'])->name('admin.about.edit');
        Route::post('/store/{id?}', [AboutController::class, 'store'])->name('admin.about.store');
        Route::get('/delete/{id?}', [AboutController::class, 'delete'])->name('admin.about.delete');
    });
    // Liên hệ
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contact');
        Route::get('/edit/{id?}', [ContactController::class, 'edit'])->name('admin.contact.edit');
        Route::post('/store/{id?}', [ContactController::class, 'store'])->name('admin.contact.store');
        Route::get('/delete/{id?}', [ContactController::class, 'delete'])->name('admin.contact.delete');
    });
    // Đơn hàng
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order');
        Route::get('/detail/{id?}', [OrderController::class, 'detail'])->name('admin.order.detail');
        Route::get('/edit/{id?}', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::post('/store/{id?}', [OrderController::class, 'store'])->name('admin.order.store');
        Route::get('/delete/{id?}', [OrderController::class, 'delete'])->name('admin.order.delete');
    });
    // Trạng thái đơn hàng
    Route::prefix('order-statuses')->group(function () {
        Route::get('/{id?}', [OrderStatusController::class, 'index'])->name('admin.order_status');
        Route::post('/store/{id?}', [OrderStatusController::class, 'store'])->name('admin.order_status.store');
        Route::get('/delete/{id?}', [OrderStatusController::class, 'delete'])->name('admin.order_status.delete');
    });
});
