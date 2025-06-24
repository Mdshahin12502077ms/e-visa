@extends('Backend.master')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title and Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">👤 User Management</h2>
                <button class="btn btn-info btn-lg shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="ri-user-add-line me-1"></i> Add
                </button>
            </div>

            <!-- User Table -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-title mb-0">User List</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-2" id="userTable">
                        <table id="data-table" class="table table-hover table-striped mb-0 align-middle text-center data-table ">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 5%;">SL</th>
                                    <th style="width: 15%;">Name</th>
                                      <th style="width: 15%;">Profile Image</th>
                                      <th style="width: 15%;">Phone</th>
                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 15%;">Role</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DataTables will load data here --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient text-white" style="background: linear-gradient(to right, #4f46e5, #6d28d9);">
                <h5 class="modal-title" id="addUserModalLabel"><i class="ri-user-add-line me-2"></i> Add New User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row g-4 px-4 py-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-user-line"></i></span>
                            <input name="name" type="text" class="form-control" placeholder="Enter First name">
                        </div>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                     <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-user-line"></i></span>
                            <input name="last_name" type="text" class="form-control" placeholder="Enter last name">
                        </div>
                        @if($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>

                     <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Phone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-phone-line"></i></span>
                            <input name="phone" type="text" class="form-control" placeholder="Enter phone number">
                        </div>
                        @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-mail-line"></i></span>
                            <input name="email" type="email" class="form-control" placeholder="Enter email address">
                        </div>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select">
                            <option value="" disabled selected>Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                            <option value="customer">Customer</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    @if($errors->has('role'))
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                    @endif

                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-lock-password-line"></i></span>
                            <input name="password" type="password" class="form-control" placeholder="Create password">
                        </div>
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-lock-unlock-line"></i></span>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                        </div>
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                    </div>
                </div>
                <div class="modal-footer px-4 py-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-gradient-primary px-4">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>


      <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('addUserModal'));
                myModal.show();
            });
        </script>
        @endif


<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getUsers') }}", // Route that returns JSON data for users
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'full_name', name: 'full_name' },
                { data: 'profile_image', name: 'profile_image', orderable: false, searchable: false },
                {data:'phone', name:'phone'},
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']],
            lengthMenu: [5, 10, 25, 50],
            language: {
                processing: `<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>`
            },
            responsive: true,
            {{--  pagingType: "simple_numbers",  --}}
        });
    });
</script>
@endsection
