@extends('Backend.master')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row justify-content-center">
                    <div class="col-lg-12">

                        <!-- Card Start -->
                        <div class="card shadow-sm border-0">
                            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                <h5 class="mb-0 text-white">All Apply Visa Manage</h5>
                                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addPackageModal">
                                    <i class="fa fa-plus me-1"></i> Add New
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-hover align-middle text-center">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Visa Bearer Name</th>

                                                <th>From</th>
                                                <th>To</th>
                                                <th>Passport Number</th>
                                                <th>Phone Number Or Email</th>
                                                <th>Package Name</th>
                                                <th>Subtotal</th>
                                                <th>Grand Total</th>
                                                <th>Visa Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Card End -->

                    </div>
                </div>

            </div>
        </div>
    </div>





@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('apply.all.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },

                    {
                        data: 'passport_from',
                        name: 'passport_from'
                    },
                    {
                        data: 'passport_to_id',
                        name: 'passport_to_id'
                    },
                    {
                        data: 'pass_port_number',
                        name: 'pass_port_number'
                    },
                    {
                        data: 'email_or_phone',
                        name: 'email_or_phone',
                    },
                    {
                        data: 'package',
                        name: 'package',
                    },

                      {
                        data: 'subtotal',
                        name: 'subtotal',
                    },

                      {
                        data: 'total',
                        name: 'total',
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });


    </script>
@endpush
