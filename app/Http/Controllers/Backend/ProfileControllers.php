<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ProfileControllers extends Controller
{
    public function updateProfile(){

        return view('Backend.Layouts.Profile.updateprofile');
    }

    public function update(Request $request){

            // dd($request->all());
                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                ]);


                if($request->new_password){

                    if(!Hash::check($request->old_password,auth()->user()->password)){

                    toastr()->warning('Your Old Password Does not Match');
                    return redirect()->back();
                    }
                    if ($request->new_password != $request->confirm_password) {
                            toastr()->error('New password and confirm password do not match');
                            return redirect()->back();
                        }


                    $request->validate([
                        'old_password' => 'required',
                        'new_password' => 'required|confirmed',
                    ]);
                    $user = User::find(auth()->user()->id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    toastr()->success('Password Updated Successfully');
                    return redirect()->back();
                }


                $user = Auth::user();

                $user->name = $request->name;
                $user->last_name= $request->last_name;
                $user->phone = $request->phone;
                // $user->address = $request->address;
                $user->email = $request->email;
                if($request->hasfile('cover_image')){
                    if($user->cover_image && file_exists($user->cover_image)){
                        $cover_old_image = $user->cover_image;
                        unlink($cover_old_image);
                    }
                    $file = $request->file('cover_image');
                    $extension = $file->Extension();
                    $filename = time().'_'.Str::random(10).'.'.$extension;
                    $path='uploads/profile/';
                    $file->move($path,$filename);
                    $user->cover_image = $path.$filename;
                }

                if($request->hasfile('profile_image')){
                    if($user->profile_image && file_exists($user->profile_image)){
                        $profile_old_image = $user->profile_image;
                        unlink($profile_old_image);
                    }
                    $file = $request->file('profile_image');
                    $extension = $file->Extension();
                $filename = time().'_'.Str::random(10).'.'.$extension;
                $path='uploads/profile/';
                $file->move($path,$filename);
                $user->profile_image = $path.$filename;
                }
                $user->save();
                toastr()->success('Profile Updated Successfully');
                return redirect()->back();

    }
}
