<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    function index($id = null)
    {
        $roles = Role::all();
        $role = null;
        if($id){
            $role = Role::find($id);
        }
        return view('admin.role.index', compact(['roles', 'role']));
    }
    function store(Request $request, $id = null)
    {
        $data = $request->all();
        unset($data['_token']);
        $validator = Validator::make($data, ['name' => 'required'], [], ['name' => 'Tên role'])->validate();

        if ($id) {
            $action = 'Cập nhật role thành công!';
        } else {
            $action = 'Thêm role thành công!';
        }

        $role = Role::updateOrCreate(['id' => $id], $data);
        $role->save();
        toast()->success($action);
        return back();
    }
    function delete($id)
    {
        Role::destroy($id);
        return back();
    }
}
