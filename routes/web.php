<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailGunController;

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

Route::get('/', [MailGunController::class, 'User'])->name('GetTemplate');
Route::post('/store/user', [MailGunController::class, 'Store'])->name('GetTemplate');


// Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);

// testing mail

Route::get('/send-mail-using-mailgun', [MailGunController::class, 'index'])->name('send.mail.using.mailgun.index');
Route::get('/get_template', [MailGunController::class, 'get_template'])->name('GetTemplate');
