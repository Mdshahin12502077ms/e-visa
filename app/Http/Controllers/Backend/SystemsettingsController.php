<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSettings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class SystemsettingsController extends Controller
{
    public function index()
    {
          $setting = SystemSettings::first();
        return view('Backend.Layouts.systemsettings.index',compact('setting'));
    }

    public function update(Request $request){
        $request->validate([
            'site_name' => 'required',
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'address' => 'required',
            'facebook_url' => 'required',
            'twitter_url' => 'required',
            'instagram_url' => 'required',
            'youtube_url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        $setting = SystemSettings::first();
        $setting->site_name = $request->site_name;

        if($request->file('site_logo')){
              $siteLogoPath = $this->uploadImage(
            $request->file('site_logo'),
            null,
            'uploads/logo',
            300,
            300,
            'logo'
        );
        // Then save to database/model
      $setting->site_logo = $siteLogoPath;
        }


        if($request->file('favicon')){
        $faviconPath = $this->uploadImage(
            $request->file('favicon'),
            null,
            'uploads/favicon',
            300,
            300,
            'favicon'
        );
        $setting->favicon = $faviconPath;
    }


        $setting->contact_email = $request->contact_email;
        $setting->contact_phone = $request->contact_phone;
        $setting->address = $request->address;
        $setting->facebook_url = $request->facebook_url;
        $setting->twitter_url = $request->twitter_url;
        $setting->instagram_url = $request->instagram_url;
        $setting->youtube_url = $request->youtube_url;
        $setting->meta_title = $request->meta_title;
        $setting->footer = $request->footer;
        $setting->meta_description = $request->meta_description;
        $setting->meta_keywords = $request->meta_keywords;
        $setting->save();
        toastr()->success('Settings Updated Successfully');
        return redirect()->back();
        }
}
