<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VisaInfos;
use  Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Package;
class ApiOrderController extends Controller
{


public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'passport_from' => 'required',
        'passport_to_id' => 'required',
        'full_name' => 'required',
        'dob' => 'required',
        'nationality' => 'required',
        'pass_port_number' => 'required',
        'email_address' => 'required|email',
        'phone_number' => 'required',
        'package_id' => 'required',
        'nid_front_end' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'nid_back_end' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'face_verified_at' => 'required',
        'gob_taxes' => 'required',
        'sub_total' => 'required',
        'total' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages(),
        ]);
    }

    try {
        DB::beginTransaction();

        if (Auth::check()) {
            $VisaInfos = new VisaInfos();
            $VisaInfos->passport_from = $request->passport_from;
            $VisaInfos->passport_to_id = $request->passport_to_id;
            $VisaInfos->full_name = $request->full_name;
            $VisaInfos->dob = \Carbon\Carbon::createFromFormat('d-m-Y', $request->dob)->format('Y-m-d');
            $VisaInfos->nationality = $request->nationality;
            $VisaInfos->pass_port_number = $request->pass_port_number;
            $VisaInfos->email_address = $request->email_address;
            $VisaInfos->phone_number = $request->phone_number;
            $VisaInfos->package_id = $request->package_id;

            if ($request->hasFile('nid_front_end')) {
                $VisaInfos->nid_front_end = $this->uploadImage(
                    $request->file('nid_front_end'),
                    null,
                    'uploads/logo',
                    300,
                    300,
                    'logo'
                );
            }

            if ($request->hasFile('nid_back_end')) {
                $VisaInfos->nid_back_end = $this->uploadImage(
                    $request->file('nid_back_end'),
                    null,
                    'uploads/logo',
                    300,
                    300,
                    'logo'
                );
            }

            $VisaInfos->face_verified_at = $request->face_verified_at;
            $VisaInfos->created_by = Auth::id();
            $VisaInfos->save();

            // Save order if visa info saved
            $package = Package::find($request->package_id);

            $order = new Order();
            $order->traveller = $package->travaller;
            $order->processing_time = $package->processing_time;
            $order->sub_total = $request->sub_total;
            $order->total = $request->total;
            $order->gob_taxes = $request->gob_taxes;
            $order->visa_infos_id = $VisaInfos->id;
            $order->user_id = Auth::id();
            $order->package_id = $request->package_id;
            $order->payment_status = 'paid';
            $order->save();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Order Created Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'You are not logged in',
            ]);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 500,
            'message' => 'Something went wrong',
            'error' => $e->getMessage(),
        ]);
    }
}

    public function userAPPlyVisa($id){
        try{
            $data = VisaInfos::with('order.package','order')->where('created_by',$id)->get();
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ]);
        }
    }







}





