@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <form action="{{ route('system.settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Site Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <!-- Site Info -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Site Name</label>
                                    <input type="text" name="site_name" class="form-control" value="{{ $setting->site_name }}">
                                    @if($errors->has('site_name'))
                                        <span class="text-danger">{{ $errors->first('site_name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Contact Email</label>
                                    <input type="email" name="contact_email" class="form-control" value="{{ $setting->contact_email }}">
                                    @if($errors->has('contact_email'))
                                        <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Contact Phone</label>
                                    <input type="text" name="contact_phone" class="form-control" value="{{ $setting->contact_phone }}">
                                    @if($errors->has('contact_phone'))
                                        <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control">{{ $setting->address }}</textarea>
                                    @if($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Logo Uploads -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Site Logo</label>
                                    <input type="file" name="site_logo" class="form-control">
                                    @if($setting->site_logo)
                                        <img src="{{ asset($setting->site_logo) }}" height="50" class="mt-2">
                                    @endif
                                    @if($errors->has('site_logo'))
                                        <span class="text-danger">{{ $errors->first('site_logo') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Favicon</label>
                                    <input type="file" name="favicon" class="form-control">
                                    @if($setting->favicon)
                                        <img src="{{ asset($setting->favicon) }}" height="30" class="mt-2">
                                    @endif
                                    @if($errors->has('favicon'))
                                        <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Facebook URL</label>
                                    <input type="url" name="facebook_url" class="form-control" value="{{ $setting->facebook_url }}">
                                    @if($errors->has('facebook_url'))
                                        <span class="text-danger">{{ $errors->first('facebook_url') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Twitter URL</label>
                                    <input type="url" name="twitter_url" class="form-control" value="{{ $setting->twitter_url }}">
                                    @if($errors->has('twitter_url'))
                                        <span class="text-danger">{{ $errors->first('twitter_url') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Instagram URL</label>
                                    <input type="url" name="instagram_url" class="form-control" value="{{ $setting->instagram_url }}">
                                    @if($errors->has('instagram_url'))
                                        <span class="text-danger">{{ $errors->first('instagram_url') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>YouTube URL</label>
                                    <input type="url" name="youtube_url" class="form-control" value="{{ $setting->youtube_url }}">
                                    @if($errors->has('youtube_url'))
                                        <span class="text-danger">{{ $errors->first('youtube_url') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- SEO Settings -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ $setting->meta_title }}">
                                    @if($errors->has('meta_title'))
                                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control">{{ $setting->meta_description }}</textarea>
                                    @if($errors->has('meta_description'))
                                        <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" value="{{ $setting->meta_keywords }}">
                                    @if($errors->has('meta_keywords'))
                                        <span class="text-danger">{{ $errors->first('meta_keywords') }}</span>
                                    @endif
                                </div>


                                 <div class="mb-3">
                                    <label>Meta Keywords</label>
                                    <input type="text" name="footer" class="form-control" value="{{ $setting->footer }}">
                                    @if($errors->has('footer'))
                                        <span class="text-danger">{{ $errors->first('footer') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div> <!-- row end -->
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success">Update Settings</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
