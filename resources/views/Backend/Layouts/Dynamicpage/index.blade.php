@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Card Start -->
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white">All Dynamic Pages</h5>
                        </div>

                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Page Title</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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


    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dynamic_page.index.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        });
    </script>
@endpush
