@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="page-title">SMTP Setting Update</h4>
                </div>
            </div>

            <!-- SMTP Setting Form -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('smtp.update') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>App Name <span class="text-danger">*</span></label>
                                    <input type="text" name="app_name" value="{{ old('app_name', $smtp->app_name ?? '') }}" class="form-control">
                                    @if($errors->has('app_name'))
                                    <span class="text-danger">{{ $errors->first('app_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mail Mailer <span class="text-danger">*</span></label>
                                    <input type="text" name="mail_mailer" value="{{ old('mail_mailer', $smtp->mail_mailer ?? 'smtp') }}" class="form-control">
                                        @if($errors->has('mail_mailer'))
                                            <span class="text-danger">{{ $errors->first('mail_mailer') }}</span>
                                            @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mail Host <span class="text-danger">*</span></label>
                                    <input type="text" name="mail_host" value="{{ old('mail_host', $smtp->mail_host ?? '') }}" class="form-control">
                                    @if($errors->has('mail_host'))
                                    <span class="text-danger">{{ $errors->first('mail_host') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mail Port <span class="text-danger">*</span></label>
                                    <input type="number" name="mail_port" value="{{ old('mail_port', $smtp->mail_port ?? '') }}" class="form-control">

                                    @if($errors->has('mail_port'))
                                    <span class="text-danger">{{ $errors->first('mail_port') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mail Username <span class="text-danger">*</span></label>
                                    <input type="text" name="mail_username" value="{{ old('mail_username', $smtp->mail_username ?? '') }}" class="form-control">
                                        @if($errors->has('mail_username'))
                                            <span class="text-danger">{{ $errors->first('mail_username') }}</span>
                                            @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mail Password <span class="text-danger">*</span></label>
                                    <input type="password" name="mail_password" value="{{ old('mail_password', $smtp->mail_password ?? '') }}" class="form-control">
                                    @if($errors->has('mail_password'))
                                    <span class="text-danger">{{ $errors->first('mail_password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mail Encryption <span class="text-danger">*</span></label>
                                    <input type="text" name="mail_encryption" value="{{ old('mail_encryption', $smtp->mail_encryption ?? '') }}" class="form-control">
                                    @if($errors->has('mail_encryption'))
                                    <span class="text-danger">{{ $errors->first('mail_encryption') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-4">
                                    <label>Mail From Address <span class="text-danger">*</span></label>
                                    <input type="email" name="mail_from_address" value="{{ old('mail_from_address', $smtp->mail_from_address ?? '') }}" class="form-control">
                                    @if($errors->has('mail_from_address'))
                                    <span class="text-danger">{{ $errors->first('mail_from_address') }}</span>
                                    @endif
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary w-md">Update Setting</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
