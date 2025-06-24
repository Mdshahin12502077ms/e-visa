<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
class Packagecontroller extends Controller
{
    public function index()
    {
        return view('Backend.Layouts.Package.index');
    }

    public function PackageData(){
          
           if(request()->ajax()){

            $data = Package::all();
          
            return datatables()->of($data)
            ->addIndexColumn()
           ->addColumn('action', function ($data) {
                  $editBtn = '<a href="javascript:void(0)" class="edit btn btn-secondary btn-sm editPackageBtn"
                    data-id="'.$data->id.'"
                    data-title="'.$data->title.'"
                    data-validity="'.$data->validity.'"
                    data-maximum_stay_per_entry="'.$data->maximum_stay_per_entry.'"
                    data-entries_type="'.$data->entries_type.'"
                    data-service_fee="'.$data->service_fee.'"
                    data-goverment_fee="'.$data->goverment_fee.'"
                    data-processing_time="'.$data->processing_time.'"
                    data-status="'.$data->status.'">
                    <i class="fa fa-edit"></i>
                    </a>';
                    $deleteBtn = '<a  data-id="'.$data->id.'"  class="delete btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>';

                    // Status button with icon based on active/deactive status
                    if ($data->status == 'active') {
                        $statusBtn = '<a data-id="'.$data->id.'" class="btn btn-success btn-sm status" >
                                <i class="fa fa-check-circle"></i> Active
                              </a>';
                    } else {
                        $statusBtn = '<a class="btn btn-danger btn-sm status" data-id="'.$data->id.'" >
                                <i class="fa fa-times-circle"></i> Deactive
                              </a>';
                    }

                    return $editBtn . '  ' . $statusBtn.''.$deleteBtn;
                })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
   

    public function store(Request $request){
     
        $validator = Validator::make($request->all(), [
                  'title' => 'required',
            'validity' => 'required',
            'maximum_stay_per_entry' => 'required',
            'service_fee' => 'required',
            'goverment_fee' => 'required',
            'processing_time' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        } 

        
            $package = new Package();
            $package->title = $request->title;
            $package->validity = $request->validity;
            $package->maximum_stay_per_entry = $request->maximum_stay_per_entry;
            $package->service_fee = $request->service_fee;
            $package->goverment_fee = $request->goverment_fee;
            $package->processing_time = $request->processing_time;
            $package->status = $request->status;
            $package->save();

            return response()->json([
                'status' => 200,
                'message' => 'Package Added Successfully',
            ]);
        

    }

    public function update(Request $request){
        
        $validator = Validator::make($request->all(), [
            'titleedit' => 'required',
            'validityedit' => 'required',
            'maximum_stay_per_entryedit' => 'required',
            'service_feeedit' => 'required',
            'goverment_feeedit' => 'required',
            'processing_timeedit' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        }
        $package = Package::find($request->id);
        $package->title = $request->titleedit;
        $package->validity = $request->validityedit;
        $package->maximum_stay_per_entry = $request->maximum_stay_per_entryedit;
        $package->service_fee = $request->service_feeedit;
        $package->goverment_fee = $request->goverment_feeedit;
        $package->processing_time = $request->processing_timeedit;
        $package->status = $request->statusedit;
        $package->save();

        return response()->json([
            'status' => 200,
            'message' => 'Package Updated Successfully',
        ]);
    }

    public function destroy($id){
        $package = Package::find($id);
        $package->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Package Deleted Successfully',
        ]);
    }

    public function delete(Request $request){
        $id = $request->package_id;
        
        Package::where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Package Deleted Successfully',
        ]);
    }

    public function status(Request $request){
        $package = Package::find($request->package_id);
        if($package->status == 'active'){
            $package->status = 'inactive';
        }else{
            $package->status = 'active';
        }
        $package->save();
        return response()->json([
            'status' => 200,
            'message' => 'Package Status Updated Successfully',
        ]);
    }
}

