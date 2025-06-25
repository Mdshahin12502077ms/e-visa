<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VisaInfos;

class OrderController extends Controller
{
    public function index()
    {
        return view('Backend.Layouts.ApplyVisa.index');
    }

    public function AllApplyData()
    {
        if (request()->ajax()) {
            $data = VisaInfos::with('order.package', 'order.user')
                ->whereHas('order', function ($query) {
                    $query->where('status', 'pending');
                })
                ->get();

            return datatables()->of($data)
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
                    $statuses = [
                        'pending',
                        'under_review',
                        'documents_required',
                        'accepted',
                        'rejected',
                        'processing',
                        'completed',
                        'cancelled'
                    ];

                    $options = '';
                    foreach ($statuses as $status) {
                        $selected = ($data->order && $data->order->status == $status) ? 'selected' : '';
                        $label = ucwords(str_replace('_', ' ', $status));
                        $options .= "<option value='{$status}' {$selected}>{$label}</option>";
                    }

                    $select = "<select class='form-select form-select-sm order-status-change' data-id='{$data->id}' style='min-width: 120px; padding: 2px 6px; font-size: 12px;'>{$options}</select>";

                $btn = '
                <div class="d-flex align-items-center gap-1">
                    <a href="' . route('visainfo.edit', $data->id) . '" class="btn btn-sm btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="' . route('visainfo.delete', $data->id) . '" class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a href="' . route('visainfo.show', $data->id) . '" class="btn btn-sm btn-outline-info" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    ' . $select . '
                </div>';

                    return $btn;
                })



                ->rawColumns(['action', 'email_or_phone', 'package', 'subtotal', 'total', 'status'])
                ->make(true);
        }
    }
}
