<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WelcomeMessageController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LifeController;
use App\Http\Controllers\Admin\FeeStructureController;
use App\Http\Controllers\Admin\HostelFeeController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\SlideShowController;
use App\Http\Controllers\Admin\AchiverController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MetaKeyWordController;
use App\Http\Controllers\Admin\SendNoteController;
use App\Http\Controllers\Admin\FAQController;

Route::group(['prefix'  =>  'admin'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        // Route::get('/', function () {
        //     return view('admin.dashboard.index');
        // })->name('admin.dashboard');

        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');
        // Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/update', [DashboardController::class, 'update'])->name('admin.update');
        Route::post('/application', [DashboardController::class, 'application'])->name('admin.application');

        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');
            Route::get('/{id}/disable', 'Admin\CategoryController@disable')->name('admin.categories.disable');

        });

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



        Route::group(['prefix'  =>   'abouts'], function() {
            Route::get('/', [AboutController::class, 'index'])->name('admin.abouts.index');
            Route::get('/create', [AboutController::class, 'create'])->name('admin.abouts.create');
            Route::post('/store', [AboutController::class, 'store'])->name('admin.abouts.store');
            Route::get('/{id}/edit', [AboutController::class, 'edit'])->name('admin.abouts.edit');
            Route::post('/update', [AboutController::class, 'update'])->name('admin.abouts.update');
            Route::get('/{id}/delete', [AboutController::class, 'delete'])->name('admin.abouts.delete');
            Route::get('/{id}/disable', [AboutController::class, 'disable'])->name('admin.abouts.disable');

        });

        Route::group(['prefix'  =>   'authors'], function() {
            Route::get('/', [AuthorController::class, 'index'])->name('admin.authors.index');
            Route::get('/create', [AuthorController::class, 'create'])->name('admin.authors.create');
            Route::post('/store', [AuthorController::class, 'store'])->name('admin.authors.store');
            Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('admin.authors.edit');
            Route::post('/update', [AuthorController::class, 'update'])->name('admin.authors.update');
            Route::get('/{id}/delete', [AuthorController::class, 'delete'])->name('admin.authors.delete');
            Route::get('/{id}/disable', [AuthorController::class, 'disable'])->name('admin.authors.disable');

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

        Route::group(['prefix'  =>   'sendnotes'], function() {
            Route::get('/', [SendNoteController::class, 'index'])->name('admin.sendnotes.index');
            Route::get('/{id}/delete', [SendNoteController::class, 'delete'])->name('admin.sendnotes.delete');

        });


        Route::group(['prefix'  =>   'chapters'], function() {
            Route::get('/', [ChapterController::class, 'index'])->name('admin.chapters.index');
            Route::get('/create', [ChapterController::class, 'create'])->name('admin.chapters.create');
            Route::post('/store', [ChapterController::class, 'store'])->name('admin.chapters.store');
            Route::get('/{id}/edit', [ChapterController::class, 'edit'])->name('admin.chapters.edit');
            Route::post('/update', [ChapterController::class, 'update'])->name('admin.chapters.update');
            Route::get('/{id}/delete', [ChapterController::class, 'delete'])->name('admin.chapters.delete');
            Route::get('/{id}/disable', [ChapterController::class, 'disable'])->name('admin.chapters.disable');
            Route::get('/{id}/copy', [ChapterController::class, 'copy'])->name('admin.chapters.copy');
            Route::post('/copychapter', [ChapterController::class, 'copyChapter'])->name('admin.chapters.copychapter');

        });
        Route::group(['prefix'  =>   'pdfs'], function() {
            Route::get('/', [PdfController::class, 'index'])->name('admin.pdfs.index');
            Route::get('/create', [PdfController::class, 'create'])->name('admin.pdfs.create');
            Route::post('/store', [PdfController::class, 'store'])->name('admin.pdfs.store');
            Route::get('/{id}/edit', [PdfController::class, 'edit'])->name('admin.pdfs.edit');
            Route::post('/update', [PdfController::class, 'update'])->name('admin.pdfs.update');
            Route::get('/{id}/delete', [PdfController::class, 'delete'])->name('admin.pdfs.delete');
            Route::get('/{id}/disable', [PdfController::class, 'disable'])->name('admin.pdfs.disable');
            Route::get('/{id}/getcopy', [PdfController::class, 'edit'])->name('admin.pdfs.getcopy');
            Route::post('/copy', [PdfController::class, 'copy'])->name('admin.pdfs.copy');
            Route::get('/delete', [PdfController::class, 'deletepdf'])->name('admin.pdfs.deletepdf');

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



        Route::group(['prefix'  =>   'creators'], function() {
            Route::get('/', [CreatorController::class, 'index'])->name('admin.creators.index');
            Route::get('/create', [CreatorController::class, 'create'])->name('admin.creators.create');
            Route::post('/store', [CreatorController::class, 'store'])->name('admin.creators.store');
            Route::get('/{id}/edit', [CreatorController::class, 'edit'])->name('admin.creators.edit');
            Route::post('/update', [CreatorController::class, 'update'])->name('admin.creators.update');
            Route::get('/{id}/delete', [CreatorController::class, 'delete'])->name('admin.creators.delete');
            Route::get('/{id}/disable', [CreatorController::class, 'disable'])->name('admin.creators.disable');

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
        Route::group(['prefix'  =>   'categories'], function() {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('/update', [CategoryController::class, 'update'])->name('admin.categories.update');
            Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('admin.categories.delete');
            Route::get('/{id}/disable', [CategoryController::class, 'disable'])->name('admin.categories.disable');

        });
        Route::group(['prefix'  =>   'advertisements'], function() {
            Route::get('/', [AdvertisementController::class, 'index'])->name('admin.advertisements.index');
            Route::get('/create', [AdvertisementController::class, 'create'])->name('admin.advertisements.create');
            Route::post('/store', [AdvertisementController::class, 'store'])->name('admin.advertisements.store');
            Route::get('/{id}/edit', [AdvertisementController::class, 'edit'])->name('admin.advertisements.edit');
            Route::post('/update', [AdvertisementController::class, 'update'])->name('admin.advertisements.update');
            Route::get('/{id}/delete', [AdvertisementController::class, 'delete'])->name('admin.advertisements.delete');
            Route::get('/{id}/disable', [AdvertisementController::class, 'disable'])->name('admin.advertisements.disable');

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



        Route::group(['prefix'  =>   'levels'], function() {
            Route::get('/', [LevelController::class, 'index'])->name('admin.levels.index');
            Route::get('/create', [LevelController::class, 'create'])->name('admin.levels.create');
            Route::post('/store', [LevelController::class, 'store'])->name('admin.levels.store');
            Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('admin.levels.edit');
            Route::post('/update', [LevelController::class, 'update'])->name('admin.levels.update');
            Route::get('/{id}/delete', [LevelController::class, 'delete'])->name('admin.levels.delete');
            Route::get('/{id}/disable', [LevelController::class, 'disable'])->name('admin.levels.disable');

        });
        Route::group(['prefix'  =>   'facts'], function() {
            Route::get('/', [FactController::class, 'index'])->name('admin.facts.index');
            Route::get('/create', [FactController::class, 'create'])->name('admin.facts.create');
            Route::post('/store', [FactController::class, 'store'])->name('admin.facts.store');
            Route::get('/{id}/edit', [FactController::class, 'edit'])->name('admin.facts.edit');
            Route::post('/update', [FactController::class, 'update'])->name('admin.facts.update');
            Route::get('/{id}/delete', [FactController::class, 'delete'])->name('admin.facts.delete');
            Route::get('/{id}/disable', [FactController::class, 'disable'])->name('admin.facts.disable');

        });

        Route::group(['prefix'  =>   'faqs'], function() {
            Route::get('/', [FAQController::class, 'index'])->name('admin.faqs.index');
            Route::get('/create', [FAQController::class, 'create'])->name('admin.faqs.create');
            Route::post('/store', [FAQController::class, 'store'])->name('admin.faqs.store');
            Route::get('/{id}/edit', [FAQController::class, 'edit'])->name('admin.faqs.edit');
            Route::post('/update', [FAQController::class, 'update'])->name('admin.faqs.update');
            Route::get('/{id}/delete', [FAQController::class, 'delete'])->name('admin.faqs.delete');
            Route::get('/{id}/disable', [FAQController::class, 'disable'])->name('admin.faqs.disable');

        });

        Route::group(['prefix'  =>   'feedbacks'], function() {
            Route::get('/', [FeedbackController::class, 'getUserFeedback'])->name('admin.feedbacks.index');
            Route::get('/{id}/disable', [FeedbackController::class, 'disable'])->name('admin.feedbacks.disable');
            Route::get('/{id}/delete', [FeedbackController::class, 'delete'])->name('admin.feedbacks.delete');


        });


        Route::group(['prefix'  =>   'metakeywords'], function() {
            Route::get('/', [MetaKeyWordController::class, 'index'])->name('admin.metakeywords.index');
            Route::get('/create', [MetaKeyWordController::class, 'create'])->name('admin.metakeywords.create');
            Route::post('/store', [MetaKeyWordController::class, 'store'])->name('admin.metakeywords.store');
            Route::get('/{id}/edit', [MetaKeyWordController::class, 'edit'])->name('admin.metakeywords.edit');
            Route::post('/update', [MetaKeyWordController::class, 'update'])->name('admin.metakeywords.update');
            Route::get('/{id}/delete', [MetaKeyWordController::class, 'delete'])->name('admin.metakeywords.delete');
            Route::get('/{id}/disable', [MetaKeyWordController::class, 'disable'])->name('admin.metakeywords.disable');

        });



        Route::group(['prefix'  =>   'comments'], function() {

            Route::get('/', [CommentController::class, 'index'])->name('admin.comments.index');
            Route::get('/{id}/delete', [CommentController::class, 'delete'])->name('admin.comments.delete');
            Route::get('/{id}/disable', [CommentController::class, 'disable'])->name('admin.comments.disable');

        });


        Route::group(['prefix'  =>   'user'], function() {

            Route::get('/', 'Admin\UserController@index')->name('admin.users.index');
        });





    });


});

Route::group(['prefix'  =>   'comments'], function() {

    Route::post('/store', [CommentController::class, 'store'])->name('comments.store');

});

Route::get('/getkey', [MetaKeyWordController::class, 'displaykey'])->name('meta.key');
