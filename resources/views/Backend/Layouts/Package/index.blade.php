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
                                <h5 class="mb-0 text-white">All Dynamic Pages</h5>
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
                                                <th>Package Title</th>

                                                <th>Validity</th>
                                                <th>Max Stay</th>
                                                <th>Entry Type</th>
                                                <th>Service Fee</th>
                                                <th>Govt Fee</th>
                                                <th>Processing Time</th>
                                                <th>Status</th>
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

    create modal
    <!-- Add Package Modal -->
    <div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addPackage">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" id="addPackageModalLabel ">Add New Package</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="validity" class="form-label">Validity (Days)</label>
                                <input type="number" name="validity" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="maximum_stay_per_entry" class="form-label">Max Stay Per Entry (Days)</label>
                                <input type="number" name="maximum_stay_per_entry" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="entries_type" class="form-label">Entries Type</label>
                                <select name="entries_type" class="form-select">
                                    <option value="single" selected>Single</option>
                                    <option value="multiple">Multiple</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="service_fee" class="form-label">Service Fee</label>
                                <input type="number" name="service_fee" class="form-control" step="0.01">
                            </div>

                            <div class="col-md-6">
                                <label for="goverment_fee" class="form-label">Government Fee</label>
                                <input type="number" name="goverment_fee" class="form-control" step="0.01">
                            </div>

                            <div class="col-md-6">
                                <label for="processing_time" class="form-label">Processing Time</label>
                                <input type="text" name="processing_time" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-success create">Save Package</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Package Modal -->
    <div class="modal fade" id="editPackageModal" tabindex="-1" aria-labelledby="editPackageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editPackageForm">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" id="addPackageModalLabel ">Edit Package</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit-title" class="form-label">Title</label>
                                <input type="text" name="titleedit" id="edit-title" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-validity" class="form-label">Validity (Days)</label>
                                <input type="number" name="validityedit" id="edit-validity" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-maximum_stay_per_entry" class="form-label">Max Stay Per Entry
                                    (Days)</label>
                                <input type="number" name="maximum_stay_per_entryedit" id="edit-maximum_stay_per_entry"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-entries_type" class="form-label">Entries Type</label>
                                <select name="entries_typeedit" id="edit-entries_type" class="form-select">
                                    <option value="single">Single</option>
                                    <option value="multiple">Multiple</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="edit-service_fee" class="form-label">Service Fee</label>
                                <input type="number" name="service_feeedit" id="edit-service_fee" class="form-control"
                                    step="0.01">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-goverment_fee" class="form-label">Government Fee</label>
                                <input type="number" name="goverment_feeedit" id="edit-goverment_fee"
                                    class="form-control" step="0.01">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-processing_time" class="form-label">Processing Time</label>
                                <input type="text" name="processing_timeedit" id="edit-processing_time"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-status" class="form-label">Status</label>
                                <select name="statusedit" id="edit-status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a type="submit" class="btn btn-warning update">Update Package</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
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
                ajax: "{{ route('package.index.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'validity',
                        name: 'validity'
                    },
                    {
                        data: 'maximum_stay_per_entry',
                        name: 'maximum_stay_per_entry'
                    },
                    {
                        data: 'entries_type',
                        name: 'entries_type'
                    },
                    {
                        data: 'service_fee',
                        name: 'service_fee'
                    },
                    {
                        data: 'goverment_fee',
                        name: 'goverment_fee'
                    },
                    {
                        data: 'processing_time',
                        name: 'processing_time'
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

        $(document).on('click', '.create', function() {
            let title = $('input[name="title"]').val().trim();
            let validity = $('input[name="validity"]').val().trim();
            let maximum_stay_per_entry = $('input[name="maximum_stay_per_entry"]').val().trim();
            let entries_type = $('select[name="entries_type"]').val();
            let service_fee = $('input[name="service_fee"]').val().trim();
            let goverment_fee = $('input[name="goverment_fee"]').val().trim();
            let processing_time = $('input[name="processing_time"]').val().trim();
            let status = $('select[name="status"]').val();

            $('.text-danger').remove();

            let hasError = false;

            if (title === '') {
                $('input[name="title"]').after('<span class="text-danger">Please enter title</span>');
                hasError = true;
            }
            if (validity === '') {
                $('input[name="validity"]').after('<span class="text-danger">Please enter validity</span>');
                hasError = true;
            }
            if (maximum_stay_per_entry === '') {
                $('input[name="maximum_stay_per_entry"]').after(
                    '<span class="text-danger">Please enter maximum stay per entry</span>');
                hasError = true;
            }
            if (entries_type === '') {
                $('select[name="entries_type"]').after('<span class="text-danger">Please select entry type</span>');
                hasError = true;
            }
            if (service_fee === '') {
                $('input[name="service_fee"]').after('<span class="text-danger">Please enter service fee</span>');
                hasError = true;
            }
            if (goverment_fee === '') {
                $('input[name="goverment_fee"]').after(
                    '<span class="text-danger">Please enter government fee</span>');
                hasError = true;
            }
            if (processing_time === '') {
                $('input[name="processing_time"]').after(
                    '<span class="text-danger">Please enter processing time</span>');
                hasError = true;
            }
            if (status === '') {
                $('select[name="status"]').after('<span class="text-danger">Please select status</span>');
                hasError = true;
            }

            if (hasError) {
                return false;
            }
            let formData = new FormData($('#addPackage')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('package.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 200) {
                        console.log(response);
                        toastr.success("Package Added Successfully");
                        $("#addPackage")[0].reset();
                        $('#addPackageModal').modal('hide');
                        $('#example').DataTable().ajax.reload();

                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            let input = $('[name="' + key + '"]');
                            input.after('<span class="text-danger">' + value[0] + '</span>');
                        });
                    } else {
                        toastr.error("Something went wrong");
                    }
                }
            });

        });

        //data parse modal

        $(document).on('click', '.editPackageBtn', function() {
            $('#edit-id').val($(this).data('id'));
            $('#edit-title').val($(this).data('title'));
            $('#edit-validity').val($(this).data('validity'));
            $('#edit-maximum_stay_per_entry').val($(this).data('maximum_stay_per_entry'));
            $('#edit-entries_type').val($(this).data('entries_type'));
            $('#edit-service_fee').val($(this).data('service_fee'));
            $('#edit-goverment_fee').val($(this).data('goverment_fee'));
            $('#edit-processing_time').val($(this).data('processing_time'));
            $('#edit-status').val($(this).data('status'));
            $('#editPackageModal').modal('show');
        });


        $(document).on('click', '.update', function() {

            let title = $('input[name="titleedit"]').val().trim();
            let validity = $('input[name="validityedit"]').val().trim();
            let maximum_stay_per_entry = $('input[name="maximum_stay_per_entryedit"]').val().trim();
            let entries_type = $('select[name="entries_typeedit"]').val();
            let service_fee = $('input[name="service_feeedit"]').val().trim();
            let goverment_fee = $('input[name="goverment_feeedit"]').val().trim();
            let processing_time = $('input[name="processing_timeedit"]').val().trim();
            let status = $('select[name="statusedit"]').val();

            $('.text-danger').remove();

            let hasError = false;

            if (title === '') {
                $('input[name="titleedit"]').after('<span class="text-danger">Please enter title</span>');
                hasError = true;
            }
            if (validity === '') {
                $('input[name="validityedit"]').after('<span class="text-danger">Please enter validity</span>');
                hasError = true;
            }
            if (maximum_stay_per_entry === '') {
                $('input[name="maximum_stay_per_entryedit"]').after(
                    '<span class="text-danger">Please enter maximum stay per entry</span>');
                hasError = true;
            }
            if (entries_type === '') {
                $('select[name="entries_typeedit"]').after(
                    '<span class="text-danger">Please select entry type</span>');
                hasError = true;
            }
            if (service_fee === '') {
                $('input[name="service_feeedit"]').after(
                    '<span class="text-danger">Please enter service fee</span>');
                hasError = true;
            }
            if (goverment_fee === '') {
                $('input[name="goverment_feeedit"]').after(
                    '<span class="text-danger">Please enter government fee</span>');
                hasError = true;
            }
            if (processing_time === '') {
                $('input[name="processing_timeedit"]').after(
                    '<span class="text-danger">Please enter processing time</span>');
                hasError = true;
            }
            if (status === '') {
                $('select[name="statusedit"]').after('<span class="text-danger">Please select status</span>');
                hasError = true;
            }

            if (hasError) {
                return false;
            }

            let formData = new FormData($('#editPackageForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('package.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 200) {
                        console.log(response);
                        toastr.success("Package Updated Successfully");
                        $("#editPackageForm")[0].reset();
                        $('#editPackageModal').modal('hide');
                        $('#example').DataTable().ajax.reload();

                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            let input = $('[name="' + key + '"]');
                            input.after('<span class="text-danger">' + value[0] + '</span>');
                        });
                    } else {
                        toastr.error("Something went wrong");
                    }
                }
            });

        });


        $(document).on('click', '.delete', function() {
            let package_id = $(this).data('id');
            console.log(package_id);
            $.ajaxSetup({
                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url: "{{ route('package.delete') }}",
                type: "POST",
                data: { package_id: package_id },
                success: function(response) {
                    if (response.status === 200) {
                        toastr.success("Package Deleted Successfully");
                        $('#example').DataTable().ajax.reload();
                    }
                     else{
                        toastr.error("Something went wrong");
                     }
                }
        });
    });


    $(document).on('click', '.status', function() {
       let package_id = $(this).data('id');
            console.log(package_id);
            $.ajaxSetup({
                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url: "{{ route('package.status') }}",
                type: "POST",
                data: { package_id: package_id },
                success: function(response) {
                    if (response.status === 200) {
                        toastr.success("Package Deleted Successfully");
                        $('#example').DataTable().ajax.reload();
                    }
                     else{
                        toastr.error("Something went wrong");
                     }
                }
        });

    })
    </script>
@endpush
