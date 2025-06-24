<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        return view('Backend.Layouts.UserManage.index');
    }

    public function allUser()
    {

        if (request()->ajax()) {

        $user = User::select(['id', 'name', 'profile_image', 'last_name', 'phone', 'email','role']);

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('full_name', function ($user) {
                return $user->name . ' ' . $user->last_name;
            })
            ->addColumn('profile_image', function ($user) {
                return '<img src="' . asset($user->profile_image) . '" width="100" height="100" alt="">';
            })
            ->addColumn('action', function ($user) {
                return '
                            <a href="' . route('user.edit', $user->id) . '" class="btn btn-success btn-sm">Edit</a>
                            <a href="' . route('user.delete', $user->id) . '" class="btn btn-danger btn-sm">Delete</a>
                        ';
            })
            ->rawColumns(['full_name', 'profile_image', 'action'])
            ->make(true);
    }
}


//////////////////////////////////////////////store////////////////////////////////////
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);
         $user = new User();
         $user->name = $request->name;
         $user->last_name = $request->last_name;
         $user->phone = $request->phone;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $user->role = $request->role;
         $user->save();
         toastr()->success('User Added Successfully');
        return redirect()->back();
    }

    //////////////////////////////////////////////edit////////////////////////////////////
    public function edit($id){
        $user = User::find($id);
        return view('Backend.Layouts.UserManage.edit',compact('user'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
            'password' => 'confirmed',
        ]);
         $user = User::find($id);
         $user->name = $request->name;
         $user->last_name = $request->last_name;
         $user->phone = $request->phone;
         $user->email = $request->email;
         if($request->password){
            $user->password = Hash::make($request->password);
         }
         $user->role = $request->role;
         $user->save();
         toastr()->success('User Updated Successfully');
        return redirect()->back();
    }

    //////////////////////////////////////////////delete////////////////////////////////////
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        toastr()->success('User Deleted Successfully');
        return redirect()->back();
}
}
