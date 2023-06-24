<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LifeController;
use App\Http\Controllers\WelcomeMessageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdmissionFormController;
use App\Http\Controllers\AchivementController;




require 'admin.php';



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
// Route::get('/', 'HomeController@index')->name('index');
Route::get('/', [HomeController::class ,'index'])->name('index');
Route::get('/aboutus', [AboutController::class ,'index'])->name('about');
Route::get('/lifeatadvanceacademy', [LifeController::class ,'index'])->name('life');
Route::get('/welcomemessage', [WelcomeMessageController::class ,'index'])->name('welcomemessage');
Route::get('/{id}/course', [CourseController::class ,'index'])->name('course');
Route::get('/scholarship', [ScholarshipController::class ,'index'])->name('scholarship');
Route::get('/notice', [NoticeController::class ,'index'])->name('notice');
Route::get('/event', [EventController::class ,'index'])->name('event');
Route::get('/event/{id}', [EventController::class ,'eventById'])->name('single.event');
Route::get('/contactus', [ContactController::class ,'index'])->name('contact');
Route::post('/message/store', [ContactController::class ,'store'])->name('contact.store');
Route::get('/gallery', [GalleryController::class ,'index'])->name('gallery');
Route::get('/gallery/{id}', [GalleryController::class ,'singleGallery'])->name('single.gallery');

Route::get('/admission', [AdmissionFormController::class ,'index'])->name('admission');
Route::post('/admission/store', [AdmissionFormController::class ,'store'])->name('admission.store');

Route::get('/achievement', [AchivementController::class ,'index'])->name('achievement');

// Route::get('/', function () {
//     return view('index');
// });
// Route::get('/aboutus', function () {
//     return view('aboutus');
// });

// Route::get('/life', function () {
//     return view('life');
// });

// Route::get('/welcomemessage', function () {
//     return view('welcomemessage');
// });

// Route::get('/scholorship', function () {
//     return view('scholorship');
// });

// Route::get('/course', function () {
//     return view('course');
// });
