<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WelcomeMessageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LifeController;
use App\Http\Controllers\Admin\FeeStructureController;
use App\Http\Controllers\Admin\HostelFeeController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\SlideShowController;
use App\Http\Controllers\Admin\AchiverController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdmissionFormController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AllImageController;

Route::group(['prefix'  =>  'admin'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {


        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::group(['prefix'  =>   'galleries'], function() {
            Route::get('/', [GalleryController::class, 'index'])->name('admin.galleries.index');
            Route::get('/create', [GalleryController::class, 'create'])->name('admin.galleries.create');
            Route::post('/store', [GalleryController::class, 'store'])->name('admin.galleries.store');
            Route::get('/{id}/edit', [GalleryController::class, 'edit'])->name('admin.galleries.edit');
            Route::post('/update', [GalleryController::class, 'update'])->name('admin.galleries.update');
            Route::get('/{id}/delete', [GalleryController::class, 'delete'])->name('admin.galleries.delete');
            Route::get('/{id}/disable', [GalleryController::class, 'disable'])->name('admin.galleries.disable');

        });


        Route::group(['prefix'  =>   'achievers'], function() {
            Route::get('/', [AchiverController::class, 'index'])->name('admin.achievers.index');
            Route::get('/create', [AchiverController::class, 'create'])->name('admin.achievers.create');
            Route::post('/store', [AchiverController::class, 'store'])->name('admin.achievers.store');
            Route::get('/{id}/edit', [AchiverController::class, 'edit'])->name('admin.achievers.edit');
            Route::post('/update', [AchiverController::class, 'update'])->name('admin.achievers.update');
            Route::get('/{id}/delete', [AchiverController::class, 'delete'])->name('admin.achievers.delete');
            Route::get('/{id}/disable', [AchiverController::class, 'disable'])->name('admin.achievers.disable');

        });


        Route::group(['prefix'  =>   'events'], function() {
            Route::get('/', [EventController::class, 'index'])->name('admin.events.index');
            Route::get('/create', [EventController::class, 'create'])->name('admin.events.create');
            Route::post('/store', [EventController::class, 'store'])->name('admin.events.store');
            Route::get('/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
            Route::post('/update', [EventController::class, 'update'])->name('admin.events.update');
            Route::get('/{id}/delete', [EventController::class, 'delete'])->name('admin.events.delete');
            Route::get('/{id}/disable', [EventController::class, 'disable'])->name('admin.events.disable');

        });

        Route::group(['prefix'  =>   'images'], function() {
            Route::get('/', [ImageController::class, 'index'])->name('admin.images.index');
            Route::get('/create', [ImageController::class, 'create'])->name('admin.images.create');
            Route::post('/store', [ImageController::class, 'store'])->name('admin.images.store');
            Route::get('/{id}/edit', [ImageController::class, 'edit'])->name('admin.images.edit');
            Route::post('/update', [ImageController::class, 'update'])->name('admin.images.update');
            Route::get('/{id}/delete', [ImageController::class, 'delete'])->name('admin.images.delete');
            Route::get('/{id}/disable', [ImageController::class, 'disable'])->name('admin.images.disable');

        });


        Route::group(['prefix'  =>   'updateimages'], function() {
            Route::get('/', [AllImageController::class, 'index'])->name('admin.allimages.index');
            Route::get('/create', [AllImageController::class, 'create'])->name('admin.allimages.create');
            Route::post('/store', [AllImageController::class, 'store'])->name('admin.allimages.store');
            Route::get('/{id}/edit', [AllImageController::class, 'edit'])->name('admin.allimages.edit');
            Route::post('/update', [AllImageController::class, 'update'])->name('admin.allimages.update');
            Route::get('/{id}/delete', [AllImageController::class, 'delete'])->name('admin.allimages.delete');
            Route::get('/{id}/disable', [AllImageController::class, 'disable'])->name('admin.allimages.disable');

        });



        Route::group(['prefix'  =>   'abouts'], function() {
            Route::get('/', [AboutController::class, 'index'])->name('admin.abouts.index');
            Route::get('/create', [AboutController::class, 'create'])->name('admin.abouts.create');
            Route::post('/store', [AboutController::class, 'store'])->name('admin.abouts.store');
            Route::get('/{id}/edit', [AboutController::class, 'edit'])->name('admin.abouts.edit');
            Route::post('/update', [AboutController::class, 'update'])->name('admin.abouts.update');
            Route::get('/{id}/delete', [AboutController::class, 'delete'])->name('admin.abouts.delete');
            Route::get('/{id}/disable', [AboutController::class, 'disable'])->name('admin.abouts.disable');

        });
        Route::group(['prefix'  =>   'notices'], function() {
            Route::get('/', [NoticeController::class, 'index'])->name('admin.notices.index');
            Route::get('/create', [NoticeController::class, 'create'])->name('admin.notices.create');
            Route::post('/store', [NoticeController::class, 'store'])->name('admin.notices.store');
            Route::get('/{id}/edit', [NoticeController::class, 'edit'])->name('admin.notices.edit');
            Route::post('/update', [NoticeController::class, 'update'])->name('admin.notices.update');
            Route::get('/{id}/delete', [NoticeController::class, 'delete'])->name('admin.notices.delete');
            Route::get('/{id}/disable', [NoticeController::class, 'disable'])->name('admin.notices.disable');

        });
        Route::group(['prefix'  =>   'programs'], function() {
            Route::get('/', [ProgramController::class, 'index'])->name('admin.programs.index');
            Route::get('/create', [ProgramController::class, 'create'])->name('admin.programs.create');
            Route::post('/store', [ProgramController::class, 'store'])->name('admin.programs.store');
            Route::get('/{id}/edit', [ProgramController::class, 'edit'])->name('admin.programs.edit');
            Route::post('/update', [ProgramController::class, 'update'])->name('admin.programs.update');
            Route::get('/{id}/delete', [ProgramController::class, 'delete'])->name('admin.programs.delete');
            Route::get('/{id}/disable', [ProgramController::class, 'disable'])->name('admin.programs.disable');

        });
        Route::group(['prefix'  =>   'welcomes'], function() {
            Route::get('/', [WelcomeMessageController::class, 'index'])->name('admin.welcomes.index');
            Route::get('/create', [WelcomeMessageController::class, 'create'])->name('admin.welcomes.create');
            Route::post('/store', [WelcomeMessageController::class, 'store'])->name('admin.welcomes.store');
            Route::get('/{id}/edit', [WelcomeMessageController::class, 'edit'])->name('admin.welcomes.edit');
            Route::post('/update', [WelcomeMessageController::class, 'update'])->name('admin.welcomes.update');
            Route::post('/upload', [WelcomeMessageController::class, 'upload'])->name('admin.welcomes.upload');
            Route::get('/{id}/delete', [WelcomeMessageController::class, 'delete'])->name('admin.welcomes.delete');
            Route::get('/{id}/disable', [WelcomeMessageController::class, 'disable'])->name('admin.welcomes.disable');

        });

        Route::group(['prefix'  =>   'admissionforms'], function() {
            Route::get('/', [AdmissionFormController::class, 'index'])->name('admin.admissionforms.index');
            Route::get('/{id}/delete', [AdmissionFormController::class, 'delete'])->name('admin.admissionforms.delete');

        });

        Route::group(['prefix'  =>   'contacts'], function() {
            Route::get('/', [ContactController::class, 'index'])->name('admin.contacts.index');
            Route::get('/{id}/delete', [ContactController::class, 'delete'])->name('admin.contacts.delete');

        });

        Route::group(['prefix'  =>   'feestructures'], function() {
            Route::get('/', [FeeStructureController::class, 'index'])->name('admin.feestructures.index');
            Route::get('/create', [FeeStructureController::class, 'create'])->name('admin.feestructures.create');
            Route::post('/store', [FeeStructureController::class, 'store'])->name('admin.feestructures.store');
            Route::get('/{id}/edit', [FeeStructureController::class, 'edit'])->name('admin.feestructures.edit');
            Route::post('/update', [FeeStructureController::class, 'update'])->name('admin.feestructures.update');
            Route::get('/{id}/delete', [FeeStructureController::class, 'delete'])->name('admin.feestructures.delete');
            Route::get('/{id}/disable', [FeeStructureController::class, 'disable'])->name('admin.feestructures.disable');

        });
        Route::group(['prefix'  =>   'hostelfees'], function() {
            Route::get('/', [HostelFeeController::class, 'index'])->name('admin.hostelfees.index');
            Route::get('/create', [HostelFeeController::class, 'create'])->name('admin.hostelfees.create');
            Route::post('/store', [HostelFeeController::class, 'store'])->name('admin.hostelfees.store');
            Route::get('/{id}/edit', [HostelFeeController::class, 'edit'])->name('admin.hostelfees.edit');
            Route::post('/update', [HostelFeeController::class, 'update'])->name('admin.hostelfees.update');
            Route::get('/{id}/delete', [HostelFeeController::class, 'delete'])->name('admin.hostelfees.delete');
            Route::get('/{id}/disable', [HostelFeeController::class, 'disable'])->name('admin.hostelfees.disable');

        });


        Route::group(['prefix'  =>   'scholarships'], function() {
            Route::get('/', [ScholarshipController::class, 'index'])->name('admin.scholarships.index');
            Route::get('/create', [ScholarshipController::class, 'create'])->name('admin.scholarships.create');
            Route::post('/store', [ScholarshipController::class, 'store'])->name('admin.scholarships.store');
            Route::get('/{id}/edit', [ScholarshipController::class, 'edit'])->name('admin.scholarships.edit');
            Route::post('/update', [ScholarshipController::class, 'update'])->name('admin.scholarships.update');
            Route::get('/{id}/delete', [ScholarshipController::class, 'delete'])->name('admin.scholarships.delete');
            Route::get('/{id}/disable', [ScholarshipController::class, 'disable'])->name('admin.scholarships.disable');

        });

        Route::group(['prefix'  =>   'slideshows'], function() {
            Route::get('/', [SlideShowController::class, 'index'])->name('admin.slideshows.index');
            Route::get('/create', [SlideShowController::class, 'create'])->name('admin.slideshows.create');
            Route::post('/store', [SlideShowController::class, 'store'])->name('admin.slideshows.store');
            Route::get('/{id}/edit', [SlideShowController::class, 'edit'])->name('admin.slideshows.edit');
            Route::post('/update', [SlideShowController::class, 'update'])->name('admin.slideshows.update');
            Route::get('/{id}/delete', [SlideShowController::class, 'delete'])->name('admin.slideshows.delete');
            Route::get('/{id}/disable', [SlideShowController::class, 'disable'])->name('admin.slideshows.disable');

        });

        Route::group(['prefix'  =>   'lifes'], function() {
            Route::get('/', [LifeController::class, 'index'])->name('admin.lifes.index');
            Route::get('/create', [LifeController::class, 'create'])->name('admin.lifes.create');
            Route::post('/store', [LifeController::class, 'store'])->name('admin.lifes.store');
            Route::get('/{id}/edit', [LifeController::class, 'edit'])->name('admin.lifes.edit');
            Route::post('/update', [LifeController::class, 'update'])->name('admin.lifes.update');
            Route::get('/{id}/delete', [LifeController::class, 'delete'])->name('admin.lifes.delete');
            Route::get('/{id}/disable', [LifeController::class, 'disable'])->name('admin.lifes.disable');

        });


        Route::group(['prefix'  =>   'user'], function() {

            Route::get('/', 'Admin\UserController@index')->name('admin.users.index');
        });





    });


});
