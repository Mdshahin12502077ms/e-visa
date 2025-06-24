@extends('Backend.master')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Title and Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Permission Management</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionModal">
                    <i class="ri-add-line"></i> Add New Permission
                </button>
            </div>

            <!-- Roles DataTable -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="rolesTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                 <th>Group Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <!-- You can add Edit/Delete here -->
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @endforeach  --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Role Modal -->
            <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRoleModalLabel">Add New Permission</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="roleName" class="form-label">Permission Name</label>
                                    <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter Permission name">
                                    @error('name')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                 <div class="mb-3">
                                    <label for="roleName" class="form-label">Group/Module Name</label>
                                    <input type="text" class="form-control" id="roleName" name="group_name" placeholder="Enter Module name">
                                    @error('group_name')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Create Permission</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="editRoleForm" action="{{ route('permission.update') }}" method="POST">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Permission</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="permission_id" name="id" hidden>
                                    <label for="role_name" class="form-label">Permission Name</label>

                                    <input type="text" class="form-control" id="permission_name" name="name">
                                </div>
                                 <div class="mb-3">

                                    <label for="group_name" class="form-label">Group Name</label>

                                    <input type="text" class="form-control" id="group_name" name="group_name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Permission</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>



@if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('addRoleModal'));
                myModal.show();
            });
        </script>
        @endif

   <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#rolesTable').DataTable({
            processing: true,
            serverSide: true,
             ajax:"{{ route('getPermission') }}",
             columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'name',name:'name'},
                {data:'group_name',name:'group_name'},
                {data:'action',name:'action',orderable:false,searchable:false},
             ]
        });
    });

    $(document).on('click','.editRoleBtn',function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        let group_name = $(this).data('group_name');
         $('#permission_id').val(id);
         $('#permission_name').val(name);
         $('#group_name').val(group_name);
    })
</script>
@endsection
