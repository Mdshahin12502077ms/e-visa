<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  App\Models\Smtp;
use App\Models\SystemSettings;
use App\models\NotificationSend;
use Config;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


      $systemsetting = SystemSettings::first();
      
      if($systemsetting){
         view::share('systemsetting',$systemsetting);
      }
      
    //   $notification = NotificationSend::with('user')->where('not')->get();





        $mailsetting = Smtp::first();
        if ($mailsetting) {
             $data=[
                'driver' => $mailsetting->mail_mailer,
                 'host' => $mailsetting->mail_host,
                 'port' => $mailsetting->mail_port,
                 'encryption' => $mailsetting->mail_encryption,
                 'username' => $mailsetting->mail_username,
                 'password' => $mailsetting->mail_password,
                 'from' => ['address' => $mailsetting->mail_from_address,
                  'name' => $mailsetting->app_name],
             ];
             Config::set('app.name',$mailsetting->app_name);
             Config::set('mail',$data);
        }
    }
}
