<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderStatusController extends Controller
{
    function index($id = null)
    {
        $order_status = OrderStatus::orderByDesc('id')->get();
        $order_status_edit = null;
        if ($id) {
            $order_status_edit = OrderStatus::find($id);
        }
        return view('admin.order_status.index', compact(['order_status', 'order_status_edit']));
    }
    function store(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);
        
        Validator::make(
            $data,
            ['name' => 'required', 'color' => 'required'],
            [],
            ['name' => 'Tên trạng thái', 'color' => 'Màu']
        )->validate();

        if (!$id) {
            $action = 'Thêm trạng thái thành công!';
        } else {
            $action = 'Cập nhật trạng thái thành công!';
        }

        OrderStatus::updateOrCreate(['id' => $id], $data);
        toast()->success($action);

        return back();
    }
    function delete($id = null)
    {
        $order_status = OrderStatus::find($id);

        if ($order_status->order) {
            toast()->error('Xóa trạng thái không thành công!');
            return back();
        } else {
            OrderStatus::destroy($id);
            toast()->success('Xóa trạng thái thành công!');
            return back();
        }
    }
}
