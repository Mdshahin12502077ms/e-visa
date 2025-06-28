<?php

use App\Http\Controllers\Backend\AdminSettingsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileControllers;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\SystemsettingsController;
use App\Http\Controllers\Backend\DynamicPageController;
use App\Http\Controllers\Backend\SmtpController;
use App\Models\Smtp;
  use App\Http\Controllers\Backend\PackageController;
  use App\Http\Controllers\Backend\OrderController;
 use App\Http\Controllers\Backend\VisaInfosController;
use App\Http\Controllers\Backend\NotificationUserController;
use App\Http\Controllers\Backend\ChatController;


Route::middleware('admin')->group(function () {

    //Dashboard Controller
   Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard','index')->name('dashboard');
   });

   // Profile Controller
   Route::controller(ProfileControllers::class)->group(function(){
    Route::get('/profile','updateProfile')->name('profile');
    Route::post('/profile/update','update')->name('update.profile');
    Route::post('/profile/update/password','updatePassword')->name('profile.update.password');
   });

   //User Manage Controller
   Route::controller(UserController::class)->group(function(){
    Route::get('/user/manage','index')->name('user.index');
    Route::get('/user/get/all','allUser')->name('getUsers');
    Route::post('/user/manage/store','store')->name('user.store');
    Route::get('/user/manage/edit/{id}','edit')->name('user.edit');
    Route::post('/user/manage/update/{id}','update')->name('user.update');
    Route::get('/user/manage/delete/{id}','delete')->name('user.delete');
   });

    Route::controller(RoleController::class)->group(function(){
        Route::get('/role/manage','index')->name('role.index');
        Route::get('/role/get/all','allRole')->name('getRoles');
        Route::post('/role/manage/store','store')->name('roles.store');
        Route::get('/role/manage/edit/{id}','edit')->name('role.edit');
        Route::post('/role/manage/update','update')->name('roles.update');
        Route::get('/role/manage/delete/{id}','delete')->name('role.delete');
    });

    Route::controller(PermissionController::class)->group(function(){
        Route::get('/permission/manage','index')->name('permission.index');
        Route::get('/permission/get/all','allPermission')->name('getPermissions');
        Route::post('/permission/manage/store','store')->name('permission.store');
        Route::get('/permission/manage/edit/{id}','edit')->name('permission.edit');
        Route::post('/permission/manage/update','update')->name('permission.update');
        Route::get('/permission/manage/delete/{id}','delete')->name('permission.delete');
        Route::get('/permission/manage/assign','getPermission')->name('getPermission');
    });


   Route::controller(DynamicPageController::class)->group(function(){
    Route::get('/dynamic/page','index')->name('dynamic_page.index');
    Route::get('/dynamic/page/data','data')->name('dynamic_page.index.data');
    Route::get('/dynamic/page/edit/{id}','edit')->name('dynamic_page.edit');
    Route::post('/dynamic/page/update/{id}','update')->name('dynamic_page.update');
    Route::get('/dynamic/page/status/{id}','StatusChange')->name('dynamicpage.status');
   });



    Route::controller(AdminSettingsController::class)->group(function(){
        Route::get('/admin/settings','index')->name('admin.settings');
        Route::post('/admin/settings/update','update')->name('admin.settings.update');
    });

    Route::controller(SystemsettingsController::class)->group(function(){
        Route::get('/system/settings','index')->name('system.settings');
        Route::post('/system/settings/update','update')->name('system.settings.update');
    });


    Route::controller(SmtpController::class)->group(function(){
        Route::get('/Smtp/manage','index')->name('Smtp.index');
        Route::post('/Smtp/manage/store','store')->name('Smtp.store');
        Route::post('/Smtp/manage/update','update')->name('smtp.update');
    });

    Route::controller(PackageController::class)->group(function(){
        Route::get('/package/manage','index')->name('package.index');
        Route::get('/package/get/all','PackageData')->name('package.index.data');
        Route::get('/package/manage/edit','edit')->name('package.edit');

        Route::post('/package/manage/store','store')->name('package.store');
        Route::post('/package/manage/update','update')->name('package.update');
        Route::post('/package/manage/delete','delete')->name('package.delete');
        Route::post('/package/manage/status','status')->name('package.status');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/apply/manage','index')->name('apply.index');
        Route::get('/apply/get/all','AllApplyData')->name('apply.all.data');

        Route::get('/apply/manage/edit/{id}','edit')->name('visainfo.edit');
        Route::post('/apply/manage/update/{id}','update')->name('visainfo.update');
        Route::post('/apply/manage/delete','delete')->name('visainfo.delete');
        Route::get('/apply/manage/show/{id}','show')->name('visainfo.show');
        Route::post('/apply/manage/bulkstatus','Bulkstatus')->name('apply.bulk.action');
        Route::get('reject/apply/data','rejectApplyData')->name('reject.index');

       Route::get('/apply/get/all/reject','AllApplyRejectData')->name('apply.all.data.reject');
    });
    Route::controller(NotificationUserController::class)->group(function(){
       Route::get('/notification/user/show/','userNotification')->name('get.notification');
    });

    Route::controller(ChatController::class)->group(function(){
        Route::post('/chat/user/send/','SendMessege')->name('send.messege');
        Route::get('/chat/{friendId}','chatuser')->name('chat.user');
        Route::get('messege/notification','getNotification')->name('get.messege.notification');
        Route::get('/chat/fetch-messages/{conversationId}','chat')->name('chat.user.conversation');
    });
});
