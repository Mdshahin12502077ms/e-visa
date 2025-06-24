<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use Yajra\DataTables\Facades\DataTables;
class RoleController extends Controller
{
    public function index(){
        return view('backend.Layouts.Role.index');
    }

    public function allRole(){

        if(request()->ajax()){
         $roles = RoleModel::all();
         return DataTables::of($roles)
         ->addIndexColumn()
                    ->addColumn('action', function($role){
                return '
                    <button type="button"
                            class="btn btn-success btn-sm editRoleBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#editRoleModal"
                            data-id="'.$role->id.'"
                            data-name="'.$role->name.'">
                        Edit
                    </button>
                    <a href="'.route('role.delete', $role->id).'" class="btn btn-danger btn-sm">Delete</a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = new RoleModel();
        $role->name = $request->name;
         $role->guard_name='web';
         $role->save();
        toastr()->success('Role Added Successfully');
        return redirect()->back();
    }


    public function update(Request $request){
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = RoleModel::find($request->id);

        $role->name = $request->name;
        $role->save();
        toastr()->success('Role Updated Successfully');
        return redirect()->back();

    }

    public function delete($id){
        $role = RoleModel::find($id);
        $role->delete();
        toastr()->success('Role Deleted Successfully');
        return redirect()->back();
    }


}
