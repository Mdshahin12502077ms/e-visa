<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
class PermissionController extends Controller
{
    public function index()
    {
        return view('Backend.Layouts.Permission.index');
    }

        public function getPermission(){
            if(request()->ajax()){
                $permission = Permission::all();
                return DataTables::of($permission)
            ->addIndexColumn()
                        ->addColumn('action', function($permission){
                    return '
                        <button type="button"
                                class="btn btn-success btn-sm editRoleBtn"
                                data-bs-toggle="modal"
                                data-bs-target="#editRoleModal"
                                data-id="'.$permission->id.'"
                                data-name="'.$permission->name.'"
                                data-group_name="'.$permission->group_name.'"
                                >
                            Edit
                        </button>
                        <a href="'.route('permission.delete', $permission->id).'" class="btn btn-danger btn-sm">Delete</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }

        public function store(Request $request){
            $request->validate([
                'name' => 'required|unique:permissions,name',
                'group_name' => 'required',
            ]);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->save();
            toastr()->success('Permission Added Successfully');
            return redirect()->back();
        }

     public function update(Request $request){

            $request->validate([
                'name' => 'required|unique:permissions,name,'.$request->id,
                'group_name' => 'required',
            ]);

            $permission = Permission::find($request->id);
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->save();
            toastr()->success('Permission Updated Successfully');
            return redirect()->back();
     }

     public function delete($id){

            $permission = Permission::find($id);
            $permission->delete();
            toastr()->success('Permission Deleted Successfully');
            return redirect()->back();
        }
}
