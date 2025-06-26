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

                            </div>
                          <hr>
                        <div class="card-body bg-light rounded shadow-sm">
                            <div class="row align-items-end g-3">

                                {{-- Search By Status --}}
                                <div class="col-md-4">
                                    <label for="search" class="form-label fw-semibold text-primary search">
                                        🔍 Search by Status
                                    </label>
                                    <select id="search" class="form-select form-select-sm border-primary search">
                                        <option value="">-- Select Status --</option>
                                        <option value="pending">Pending</option>
                                        <option value="under_review">Under Review</option>
                                        <option value="documents_required">Documents Required</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>

                                {{-- Search By Visa Info --}}
                                <div class="col-md-4">
                                    <label for="search_by_visa_info" class="form-label fw-semibold text-primary">
                                        🛂 Search by Visa Info
                                    </label>
                                    <input type="text" id="search_by_visa_info" class="form-control form-control-sm border-primary visa_info_search"
                                        placeholder="Enter visa info, name, or ID...">
                                </div>



                            </div>
                        </div>

                            <hr>
                            <div class="card-body bulk" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                      <h4 class="mb-0">Bulk Action</h4>
                                    </div>
                                    <div class="d-flex gap-2">
                                       <select id="bulkActionSelect" class="form-select form-select-sm" style="width: 180px;">
                                        <option value="">Select Action</option>
                                        <option value="pending">Mark as Pending</option>
                                        <option value="under_review">Mark as Under Review</option>
                                        <option value="documents_required">Mark as Documents Required</option>
                                        <option value="accepted">Mark as Accepted</option>
                                        <option value="rejected">Mark as Rejected</option>
                                        <option value="processing">Mark as Processing</option>
                                        <option value="completed">Mark as Completed</option>
                                    </select>

                                        <button type="button" class="btn btn-danger btn-sm bulkActionBtn" id="bulkActionBtn">
                                            <i class="fa fa-ban me-1"></i> Bulk Reject
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-hover align-middle text-center">
                                        <thead class="table-light">
                                            <tr>
                                                 <th><input type="checkbox" class="bulk_fade " id="select_all"></th>
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
                ajax: {
                    url:"{{ route('apply.all.data.reject') }}",
                    data:function(d){
                        d.status= $('#search').val()??'';
                        d.search_by_visa_info= $('#search_by_visa_info').val()??'';
                    }
            },
                columns: [
                      {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
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

            $('#search, #search_by_visa_info').on('change keyup', function() {
                table.draw();
            });

        });






        $('#select_all').on('click',function(){
            $(this).closest('table').find('td input[type="checkbox"]').prop('checked',this.checked);
        });


  $(document).on('change','#bulkActionSelect',function(){
          let selected = [];
          $('.record_checkbox:checked').each(function(){
              selected.push($(this).val());
          });
            let bulkstatus = $('#bulkActionSelect').val();
          if(selected.length < 0){
            toastr.success('Please select at least one record');
            return ;
          }

          $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
           });

           $.ajax({
               url:"{{ route('apply.bulk.action') }}",
               method:"POST",
               data:{id:selected,bulkstatus:bulkstatus},
               success:function(response){
                toastr.success(response.success);
                $('#example').DataTable().ajax.reload(null,false);
               }
           });
     });

/////////////////Bulk rejectd/////////////////////
     $(document).on('click','.bulkActionBtn',function(){
        let selected = [];
        $('.record_checkbox:checked').each(function(){
            selected.push($(this).val());
        });
        if(selected.length < 0){
            toastr.success('Please select at least one record');
            return ;
        }
        let bulkstatus ='rejected';
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
           });

           $.ajax({
               url:"{{ route('apply.bulk.action') }}",
               method:"POST",
               data:{id:selected,bulkstatus:bulkstatus},
               success:function(response){
                toastr.warning("Rejected Successfully");
                $('#example').DataTable().ajax.reload(null,false);
               }
           });
     });


     ///////////////////single rejectd/////////////////////

     $(document).on('click','.reject',function(){
        let selected=[];
        selected.push($(this).data('id'));
         let bulkstatus ='rejected';
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
           });

           $.ajax({
               url:"{{ route('apply.bulk.action') }}",
               method:"POST",
               data:{id:selected,bulkstatus:bulkstatus},
               success:function(response){
                toastr.warning("Rejected Successfully");
                $('#example').DataTable().ajax.reload(null,false);
               }
           });
     });






        ///use for displaying bulk part
       $('input[type="checkbox"]').on('click', function () {
            if ($('input[name="id[]"]:checked').length > 0) {
                $('.bulk').fadeIn();
            } else {
                $('.bulk').fadeOut();
            }
        });

        $(document).on('change', '.record_checkbox', function () {
            if ($('.record_checkbox:checked').length > 0) {
                $('.bulk').fadeIn();
            } else {
                $('.bulk').fadeOut();
            }
        });



   ////////////////////search start/////////////////////





    </script>
@endpush
