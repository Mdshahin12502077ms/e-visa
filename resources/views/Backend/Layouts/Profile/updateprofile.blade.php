@extends('Backend.master')
@section('content')
      <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg profile-setting-img">
                          <img
                            src="{{ Auth::user()->cover_image ? asset(Auth::user()->cover_image) : asset('Backend/assets/images/profile-bg.jpg') }}"
                            class="profile-wid-img"
                            alt="Profile Cover">
                            <div class="overlay-content">
                                <div class="text-end p-3">
                                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                        <input id="profile-foreground-img-file-input" name="cover_image" type="file" class="profile-foreground-img-file-input">
                                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card mt-n5">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            {{--  @dd(Auth::user()->profile_image)  --}}
                                         <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('Backend/assets/images/users/avatar-1.jpg') }}"
                                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                                alt="user-profile-image">

                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" name="profile_image" type="file" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1">{{ Auth::user()->name }}</h5>

                                    </div>
                                </div>
                            </div>
                            <!--end card-->

                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i> Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i> Change Password
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="name" placeholder="Enter your firstname" value="{{ Auth::user()->name??'' }}">
                                                        </div>
                                                        @if($errors->has('name'))
                                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                                        @endif
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="lastnameInput" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="last_name" id="lastnameInput" placeholder="Enter your lastname" value="{{ Auth::user()->last_name??'' }}">
                                                        </div>

                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" name="phone" id="phonenumberInput" placeholder="Enter your phone number" value="{{ Auth::user()->phone??'' }}">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" name="email" id="emailInput" placeholder="Enter your email" value="{{ Auth::user()->email??'' }}">
                                                        </div>
                                                        @if($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                        @endif
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Updates</button>
                                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->

                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="changePassword" role="tabpanel">

                                                <div class="row g-2">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                            <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password" name="old_password">
                                                        </div>
                                                        @if($errors->has('old_password'))
                                                        <div class="alert alert-danger">{{ $errors->first('old_password') }}</div>
                                                        @endif
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                                            <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password" name="new_password">
                                                        </div>
                                                        @if($errors->has('new_password'))
                                                        <div class="alert alert-danger">{{ $errors->first('new_password') }}</div>
                                                        @endif
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                            <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password" name="confirm_password">
                                                        </div>
                                                        @if($errors->has('confirm_password'))
                                                        <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
                                                        @endif
                                                    </div>
                                                    {{--  <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                        </div>
                                                    </div>  --}}
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->


                                        </div>
                                        <!--end tab-pane-->


                                        <!--end tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </form>
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->


        </div>
@endsection
