@extends('Backend.master')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title and Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">👤 Edit User</h2>
                <a class="btn btn-info btn-lg shadow-sm px-4" href="{{ route('user.index') }}">
                    <i class="ri-arrow-go-back-line me-1"></i> Back to Users
                </a>
            </div>

            <div class="card border-0 shadow-lg">
            <!-- Edit User Form -->
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4 px-4 py-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-user-line"></i></span>
                            <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" placeholder="Enter first name">
                        </div>
                        @if($errors->has('name'))
                            <div><span class="text-danger">{{ $message }}</span></div>
                        @endif
                    </div>

                    {{--  <div class="col-md-6">
                        <label class="form-label fw-semibold">Profile Picture</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-user-line"></i></span>
                    </div>  --}}

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-user-line"></i></span>
                            <input name="last_name" type="text" class="form-control" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter last name">
                        </div>
                    @if($errors->has('last_name'))
                      <div><span class="text-danger">{{ $errors->first('last_name') }}</span></div>
                    @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-phone-line"></i></span>
                            <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                        </div>
                       @if($errors->has('phone'))
                        <div> <span class="text-danger">{{ $errors->first('phone') }}</span></div>
                       @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-mail-line"></i></span>
                            <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter email">
                        </div>
                      @if($errors->has('email'))
                       <div> <span class="text-danger">{{ $errors->first('email') }}</span></div>
                      @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select">
                            <option value="" disabled>Select Role</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="employee" {{ old('role', $user->role) === 'employee' ? 'selected' : '' }}>Employee</option>
                            <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        </select>
                       @if($errors->has('role'))
                        <div><span class="text-danger">{{ $errors->first('role') }}</span></div>
                       @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password <small class="text-muted">(leave blank if unchanged)</small></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-lock-password-line"></i></span>
                            <input name="password" type="password" class="form-control" placeholder="Enter new password">
                        </div>
                      @if($errors->has('password'))
                      <div><span class="text-danger">{{ $errors->first('password') }}</span></div>
                      @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-lock-unlock-line"></i></span>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm new password">
                        </div>
                       @if($errors->has('password_confirmation'))
                        <div><span class="text-danger">{{ $errors->first('password_confirmation') }}</span></div>
                       @endif
                    </div>
                </div>

                <div class="px-4 py-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Update User</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

