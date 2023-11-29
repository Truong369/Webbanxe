<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    function index(Request $request)
    {
        $order = null;
        if ($request->key) {
            $order = Order::where('fullName', 'like', '%' . $request->key . '%')
                ->orWhere('phone', 'like', '%' . $request->key . '%')
                ->get();
        } else {
            $order = Order::orderByDesc('id')->get();
        }

        return view('admin.order.index', compact('order'));
    }
    function edit($id = null)
    {
        $order = Order::find($id);
        $order_status = OrderStatus::all();
        return view('admin.order.edit', compact(['order', 'order_status']));
    }
    function detail($id = null)
    {
        $order = OrderDetail::where('id_order', $id)->get();
        return view('admin.order.detail', compact('order'));
    }
    function store(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);

        $validator = Validator::make($data, [
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fullName' => 'required',
            'id_status' => 'required',
        ], [], [
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'fullName' => 'Họ và tên',
            'id_status' => 'Trạng thái đơn hàng',
        ])->validate();

        if ($id) {
            $action = 'Cập nhật đơn hàng thành công!';
        }

        $order = Order::updateOrCreate(['id' => $id], $data);
        toast()->success($action);
        return redirect()->route('admin.order');
    }
    function delete($id = null)
    {
        $order_detail = OrderDetail::where('id_order', $id)->get();

        foreach ($order_detail as $item) {
            OrderDetail::destroy($item->id);
        }

        if (Order::destroy($id)) {
            toast()->success('Xóa đơn hàng thành công!');
            return back();
        } else {
            toast()->success('Xóa đơn hàng không thành công!');
            return back();
        }
    }
}
