@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-primary text-white py-3 rounded-top-4">
                    <h4 class="mb-0 text-white">✍️ Edit Application Information</h4>
                </div>

                <div class="card-body mb-4">
                    <form action="{{ route('visainfo.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        {{-- Personal Information --}}
                        <h5 class="fw-semibold text-primary mb-3 mt-2">🧍 Personal Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Passport From</label>
                                <input type="text" name="passport_from" class="form-control" value="{{ $data->passport_from??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Passport To ID</label>
                                <input type="text" name="passport_to_id" class="form-control" value="{{ $data->passport_to_id??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="{{ $data->full_name??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="{{ $data->dob??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nationality</label>
                                <input type="text" name="nationality" class="form-control" value="{{ $data->nationality??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Passport Number</label>
                                <input type="text" name="pass_port_number" class="form-control" value="{{ $data->pass_port_number??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email_address" class="form-control" value="{{ $data->email_address??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $data->phone_number??'' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Package Name</label>
                               <select name="package_id" class="form-control">
                                     @foreach($packages as $package)
                                       <option value="{{$package->id}}" {{ $data->package_id == $package->id? 'selected' : '' }}>{{ $package->title }}</option>
                                       @endforeach

                               </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Face Verified</label>
                               <select name="face_verified_at" class="form-control">
                                       <option value="yes" {{ $data->face_verified_at == 'yes'? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ $data->face_verified_at == 'no'? 'selected' : '' }}>No</option>
                               </select>
                            </div>
                        </div>

                        {{-- Document Uploads --}}
                        <h5 class="fw-semibold text-success mt-4">📎 Document Uploads</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">NID Front</label>
                                <input type="file" name="nid_front_end" class="form-control">
                                <img class="mt-2"src="{{ asset($data->nid_front_end) }}" alt="" width="100px" height="100px">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NID Back</label>
                                <input type="file" name="nid_back_end" class="form-control">
                                <img class="mt-2"src="{{ asset($data->nid_back_end) }}" alt="" width="100px" height="100px">
                            </div>
                        </div>

                        {{-- Payment Info --}}
                        <h5 class="fw-semibold text-warning mt-4">💰 Payment Info</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">GOB Taxes</label>
                                <input type="number" name="gob_taxes" class="form-control" value="{{ $data->order->gob_taxes }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sub Total</label>
                                <input type="number" name="sub_total" class="form-control" value="{{ $data->order->sub_total }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total</label>
                                <input type="number" name="total" class="form-control" value="{{ $data->order->total }}">
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                                ✅ Update Information
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
