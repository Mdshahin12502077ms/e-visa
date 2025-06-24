<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smtp;
class SmtpController extends Controller
{
    public function index(){
        $smtp = Smtp::first();
        return view('Backend.Layouts.Smtp.index',compact('smtp'));
    }

    public function update(Request $request){
       $request->validate([
            'app_name' => 'required',
            'mail_mailer' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
        ]);
        $smtp = Smtp::first();
        if(!$smtp){
            $smtp = new Smtp();
        }
        $smtp->app_name = $request->app_name;
        $smtp->mail_mailer = $request->mail_mailer;
        $smtp->mail_host = $request->mail_host;
        $smtp->mail_port = $request->mail_port;
        $smtp->mail_username = $request->mail_username;
        $smtp->mail_password = $request->mail_password;
        $smtp->mail_encryption = $request->mail_encryption;
        $smtp->mail_from_address = $request->mail_from_address;
        $smtp->save();
        toastr()->success('SMTP Updated Successfully');
        return redirect()->back();
    }
}
