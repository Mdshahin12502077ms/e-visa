<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VisaInfos;
use  Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Package;
 use App\Events\NotificationUser;
 use App\Models\User;
 use App\Models\NotificationSend;
class OrderController extends Controller
{
    public function index()
    {
        return view('Backend.Layouts.ApplyVisa.index');
    }

    public function AllApplyData(Request $request)
    {
                    if (request()->ajax()) {
                        //dd($request()->status);
                    $data = VisaInfos::with('order.package', 'order.user')
                    ->whereHas('order', function ($query) {
                        $query->whereColumn('visa_infos_id', 'visa_infos.id')
                            ->where('status', '!=', 'rejected');
                    });

                if ($request->search_by_visa_info) {
                    $data = $data->where(function ($q) use ($request) {
                        $q->where('full_name', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('pass_port_number', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('passport_from', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('passport_to_id', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('nationality', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('phone_number', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('email_address', 'like', '%' . $request->search_by_visa_info . '%');
                    });
                }

                if($request->status){
                    $data = $data->whereHas('order', function ($query) use ($request) {
                        $query->where('status', $request->status);
                    });
                }

                $data = $data->get();

            return datatables()->of($data)
              ->addColumn('checkbox', function($data){
                    return '<input type="checkbox" class="record_checkbox" name="id[]" value="' . $data->id . '">';
                })
                ->addIndexColumn()
                ->addColumn('email_or_phone', function ($data) {
                    return $data->email_address ?? '' . '<br>' . $data->phone_number ?? '';
                })
                ->addColumn('package', function ($data) {
                    return $data->package->title ?? '';
                })
                ->addColumn('subtotal', function ($data) {
                    return $data->order->sub_total ?? '';
                })
                ->addColumn('total', function ($data) {
                    return $data->order->total ?? '';
                })
                ->addColumn('status', function ($data) {
                    $status = $data->order->status ?? 'N/A';
                    $badgeClass = match ($status) {
                        'pending' => 'secondary',
                        'under_review' => 'info',
                        'documents_required' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'processing' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'dark',
                        default => 'light'
                    };

                    return '<span class="badge bg-' . $badgeClass . '">' . ucwords(str_replace('_', ' ', $status)) . '</span>';
                })
                ->addColumn('action', function ($data) {


                $btn = '
                <div class="d-flex align-items-center gap-1">
                    <a href="' . route('visainfo.edit', $data->id) . '" class="btn btn-sm btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                     <a href="' . route('visainfo.show', $data->id) . '" class="btn btn-sm btn-outline-info" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger reject" title="Delete" data-id='.$data->id.'>
                        Reject
                    </button>


                </div>';

                    return $btn;
                })



                ->rawColumns(['action', 'email_or_phone', 'package', 'subtotal', 'total', 'status','checkbox'])
                ->make(true);
        }
    }

    public function Bulkstatus(Request $request){

        $ids =$request->id;
        $status = $request->bulkstatus;
        foreach($ids as $id){
            $visa = VisaInfos::find($id);
            if($visa && $visa->order){
            $visa->order->status = $status;
            $visa->order->save();

             $title=$visa->order->status;
             $message="We received your application ! Our experts will review your application and will get back to you soon.";

             $user =$visa->order->user_id;

              $notification=new NotificationSend();
              $notification->title=$title;
              $notification->comment=$message;
              $notification->notified_to=$user;
              $notification->created_by=Auth::user()->id;
              $notification->save();
            
             event(new NotificationUser($message,$title,$user));

            }

        }
        return response()->json(['success'=>'Status Change Successfully and Notification Send Successfully']);
    }

    public function edit($id){
        $data = VisaInfos::with('order.package', 'order.user')->find($id);
        $packages = Package::all();
        return view('Backend.Layouts.ApplyVisa.edit',compact('data','packages'));
    }

    public function update(Request $request, $id){


            $VisaInfos = VisaInfos::find($id);
            $VisaInfos->passport_from = $request->passport_from;
            $VisaInfos->passport_to_id = $request->passport_to_id;
            $VisaInfos->full_name = $request->full_name;
            $VisaInfos->dob =$request->dob;
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

            $VisaInfos->save();

            // Save order if visa info saved
            $package = Package::find($request->package_id);

            $order = Order::where('visa_infos_id', $VisaInfos->id)->first();
            $order->traveller = $package->travaller;
            $order->processing_time = $package->processing_time;
            $order->sub_total = $request->sub_total;
            $order->total = $request->total;
            $order->gob_taxes = $request->gob_taxes;
            $order->visa_infos_id = $VisaInfos->id;
            $order->package_id = $request->package_id;
            $order->payment_status = 'paid';
            $order->save();
            toastr()->success('Visa Info Updated Successfully');
            return redirect()->back();


    }

    public function show($id){
        $data = VisaInfos::with('order.package', 'order.user')->find($id);
        return view('Backend.Layouts.ApplyVisa.show',compact('data'));
    }

    public function rejectApplyData(){
         return view('Backend.Layouts.ApplyVisa.RejectApplyVisa');
    }

    public function AllApplyRejectData(Request $request){
         if (request()->ajax()) {
                        //dd($request()->status);
                    $data = VisaInfos::with('order.package', 'order.user')
                    ->whereHas('order', function ($query) {
                        $query->whereColumn('visa_infos_id', 'visa_infos.id')
                            ->where('status','rejected');
                    });

                if ($request->search_by_visa_info) {
                    $data = $data->where(function ($q) use ($request) {
                        $q->where('full_name', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('pass_port_number', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('passport_from', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('passport_to_id', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('nationality', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('phone_number', 'like', '%' . $request->search_by_visa_info . '%')
                        ->orWhere('email_address', 'like', '%' . $request->search_by_visa_info . '%');
                    });
                }

                if($request->status){
                    $data = $data->whereHas('order', function ($query) use ($request) {
                        $query->where('status', $request->status);
                    });
                }

                $data = $data->get();

            return datatables()->of($data)
              ->addColumn('checkbox', function($data){
                    return '<input type="checkbox" class="record_checkbox" name="id[]" value="' . $data->id . '">';
                })
                ->addIndexColumn()
                ->addColumn('email_or_phone', function ($data) {
                    return $data->email_address ?? '' . '<br>' . $data->phone_number ?? '';
                })
                ->addColumn('package', function ($data) {
                    return $data->package->title ?? '';
                })
                ->addColumn('subtotal', function ($data) {
                    return $data->order->sub_total ?? '';
                })
                ->addColumn('total', function ($data) {
                    return $data->order->total ?? '';
                })
                ->addColumn('status', function ($data) {
                    $status = $data->order->status ?? 'N/A';
                    $badgeClass = match ($status) {
                        'pending' => 'secondary',
                        'under_review' => 'info',
                        'documents_required' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'processing' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'dark',
                        default => 'light'
                    };

                    return '<span class="badge bg-' . $badgeClass . '">' . ucwords(str_replace('_', ' ', $status)) . '</span>';
                })
                ->addColumn('action', function ($data) {


                $btn = '
                <div class="d-flex align-items-center gap-1">
                    <a href="' . route('visainfo.edit', $data->id) . '" class="btn btn-sm btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                     <a href="' . route('visainfo.show', $data->id) . '" class="btn btn-sm btn-outline-info" title="View">
                        <i class="fas fa-eye"></i>
                    </a>



                </div>';

                    return $btn;
                })



                ->rawColumns(['action', 'email_or_phone', 'package', 'subtotal', 'total', 'status','checkbox'])
                ->make(true);
        }
    }
}
