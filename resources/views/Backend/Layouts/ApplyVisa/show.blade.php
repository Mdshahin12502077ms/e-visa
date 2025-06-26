@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            {{-- Header Card --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded-3 px-4 py-3">
                    <h4 class="mb-0 text-white">📄 Application Details</h4>
                    <span class="badge bg-light text-primary fs-6">#ID: {{ $data->id }}</span>
                </div>
            </div>

            {{-- Personal Info --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-primary fw-bold">🧍 Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><strong>Full Name:</strong> {{ $data->full_name }}</div>
                        <div class="col-md-6"><strong>Passport From:</strong> {{ $data->passport_from }}</div>
                        <div class="col-md-6"><strong>Passport To ID:</strong> {{ $data->passport_to_id }}</div>
                        <div class="col-md-6"><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($data->dob)->format('d M, Y') }}</div>
                        <div class="col-md-6"><strong>Nationality:</strong> {{ $data->nationality }}</div>
                        <div class="col-md-6"><strong>Passport Number:</strong> {{ $data->pass_port_number }}</div>
                        <div class="col-md-6"><strong>Email Address:</strong> {{ $data->email_address }}</div>
                        <div class="col-md-6"><strong>Phone Number:</strong> {{ $data->phone_number }}</div>
                        <div class="col-md-6"><strong>Package Name:</strong> {{ $data->package->title ?? 'N/A' }}</div>
                        <div class="col-md-6"><strong>Face Verified:</strong> {{ ucfirst($data->face_verified_at) }}</div>
                    </div>
                </div>
            </div>

            {{-- Document Uploads --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-success fw-bold">📎 Document Uploads</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NID Front</label>
                            <div class="border rounded p-2 bg-white text-center">
                                <img src="{{ asset($data->nid_front_end) }}" alt="NID Front" class="img-thumbnail mb-2" width="120px">
                                <div>
                                    <a href="{{ asset($data->nid_front_end) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">🔍 View</a>
                                    <a href="{{ asset($data->nid_front_end) }}" download class="btn btn-sm btn-outline-secondary">⬇️ Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NID Back</label>
                            <div class="border rounded p-2 bg-white text-center">
                                <img src="{{ asset($data->nid_back_end) }}" alt="NID Back" class="img-thumbnail mb-2" width="120px">
                                <div>
                                    <a href="{{ asset($data->nid_back_end) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">🔍 View</a>
                                    <a href="{{ asset($data->nid_back_end) }}" download class="btn btn-sm btn-outline-secondary">⬇️ Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Info --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-warning fw-bold">💰 Payment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4"><strong>GOB Taxes:</strong> ৳ {{ number_format($data->order->gob_taxes ?? 0, 2) }}</div>
                        <div class="col-md-4"><strong>Sub Total:</strong> ৳ {{ number_format($data->order->sub_total ?? 0, 2) }}</div>
                        <div class="col-md-4"><strong>Total:</strong> ৳ {{ number_format($data->order->total ?? 0, 2) }}</div>
                        <div class="col-md-4"><strong>Package:</strong> {{ $data->package->title ?? 'N/A' }}</div>
                        <div class="col-md-4"><strong>Traveller(s):</strong> {{ $data->order->traveller ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            {{-- Created By --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-info fw-bold">👤 Created By</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4"><strong>Name:</strong> {{ $data->user->name ?? 'N/A' }}</div>
                        <div class="col-md-4"><strong>Email:</strong> {{ $data->user->email ?? 'N/A' }}</div>
                        <div class="col-md-4"><strong>Phone:</strong> {{ $data->user->phone ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
