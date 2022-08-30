<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\checkloginController;
use App\Http\Controllers\adminPanelController;
use App\Http\Controllers\agentPanelController;
use App\Mail\signedUp;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    if(session('role')==null){
        return redirect('/login');
    }
    else if(session('role')=='Admin'){
        return redirect('/adminpanel');
    }
    else if(session('role')=='Agent'){
        return redirect('/agentpanel');
    }
    else{
        dd("Oops!!!! Something went wrong");
    }
});

Route::get("/logout",function(){
    if(session()->has('role'))
    {
        session()->pull('role',null);
        session()->pull('username',null);
    }

    return redirect('login');
});


Route::middleware('adminPages')->group(function(){

    Route::view('addagent','addagent');
    Route::view('/adminpanel','adminpanel');
    Route::get('/adminpanel',[adminPanelController::class,'agentlist']);
    Route::view('/editagent/{id}/{name}/','editagent');
    Route::post('/edit',[adminPanelController::class,'editAgent']);
    Route::post('addagent',[adminPanelController::class,'addagent']);
    Route::get('deleteagent/{id}',[adminPanelController::class,'deleteAgent']);

});

Route::get('/adminpanel/{search}',[adminPanelController::class,'agentlist']);

Route::middleware('unauthorized')->group(function(){

    Route::view('forgotpass','forgotpass');
    Route::get('changepassword/{id}/{otp}',[checkloginController::class,'checkOtp']);
    Route::view('changepass','changePass');
    Route::post('setpass',[checkloginController::class,'setNewPassword']);
    Route::post('changepass',[checkloginController::class,'changepass']);

    Route::get('/login', function(){
        App::setlocale(session('lang'));
        return view('login');
    });

    Route::post('checkuser',[checkloginController::class,'checkUser']);
});

Route::post('language',[checkloginController::class,'setLanguage']);
Route::post('resetpassword',[agentPanelController::class,'reset']);
Route::view('/agentResetPass','agentResetPass');

Route::middleware('agentPages')->group(function(){

    Route::get('/loadchat/{id}',[agentPanelController::class,'loadChat']);   // API
    Route::post('/savechat',[agentPanelController::class,'saveChat']);    // send button
    Route::get('/showchat',function(){                     // Blade page
        return view('agentpanel');           
    });
    Route::get('agentpanel-list',[agentPanelController::class,'viewAgents']);
 
    Route::view('/agentpanel','agentpanel');
    Route::post('create',[agentPanelController::class,'createfile']);
    Route::post('deletechat',[agentPanelController::class,'DeleteChat']);
    Route::post('restorechat',[agentPanelController::class,'RestoreChat']);
});

Route::post('toAgentPanel',[adminPanelController::class,'toAgentPanel']);




