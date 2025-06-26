<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
class ApiPackageController extends Controller
{
    public function all(){
       try{
         $package = Package::all()->makeHidden(['created_at', 'updated_at']);
           return response()->json(['data'=>$package],200);
       }
       catch(\Exception $e){
           return response()->json(['error'=>$e->getMessage()],500);

       }
    }

    public function show($id){
        try{
            $package = Package::find($id)->makeHidden(['created_at', 'updated_at']);
            return response()->json(['data'=>$package],200);
        }
        catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
}
