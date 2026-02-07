<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\BinaryController;
use App\Http\Controllers\User\IncomeController;
use App\Http\Controllers\User\RankIncomeController;
use App\Http\Controllers\User\TreeController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\User\KycController;

/*
|--------------------------------------------------------------------------
| USER PROFILE (BEFORE REGISTRATION COMPLETE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('data', [UserController::class, 'userData'])->name('data');
    Route::post('data-submit', [UserController::class, 'userDataSubmit'])->name('data.submit');

});
Route::get('binary-income-print', [BinaryController::class, 'binaryIncomePrint'])->name('user.binary.income.print');


Route::get('binary-income-pdf', [BinaryController::class, 'binaryIncomePdf'])->name('user.binary.income.pdf');


Route::post('/user/kyc/submit', [KycController::class, 'submit']) ->name('user.kyc.submit');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED & VERIFIED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'check.status', 'registration.complete'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

    /* =========================
       DASHBOARD
    ========================== */
    Route::get('dashboard', [UserController::class, 'home'])->name('home');

    /* =========================
       BINARY TREE
    ========================== */
    Route::get('tree', [TreeController::class, 'index'])->name('tree');
    Route::get('tree/user/{username}', [TreeController::class, 'showUserTree'])->name('tree.show');
    Route::get('tree/data', [TreeController::class, 'getTreeData'])->name('tree.data');
    Route::get('tree/children', [TreeController::class, 'getChildren'])->name('tree.children');
    Route::get('tree/details', [TreeController::class, 'getUserDetails'])->name('tree.details');
    Route::get('other/tree/search', [TreeController::class, 'search'])->name('other.tree.search');

    /* =========================
       BINARY / MLM INCOME
    ========================== */
    Route::get('binary-summery', [UserController::class, 'binarySummery'])
        ->name('binary.summery');
    Route::get('binary-summery-history', [UserController::class, 'binarySummeryHistory'])
        ->name('binary.summeryhistory');
    Route::get('summery-history', [UserController::class, 'SummeryHistory'])
        ->name('summery.history');

    Route::get('binary-history', [BinaryController::class, 'history'])
        ->name('binary.history');

    Route::get('matrix-income', [BinaryController::class, 'matrixIncome'])
        ->name('matrix.income');

    /* =========================
       OTHER INCOMES
    ========================== */
    Route::get('my-income', [IncomeController::class, 'myIncome'])->name('my.income');
    Route::get('salary-income', [IncomeController::class, 'salary'])->name('salary.income');
    Route::get('franchise-income', [IncomeController::class, 'franchise'])->name('franchise.income');
    Route::get('retail-income', [IncomeController::class, 'retail'])->name('retail.income');
    Route::get('global-matching-income', [IncomeController::class, 'globalMatching'])
        ->name('global.matching.income');

    Route::get('rank-income', [RankIncomeController::class, 'index'])
        ->name('rank.income');

    /* =========================
       BALANCE TRANSFER
    ========================== */
    Route::get('balance-transfer', [UserController::class, 'indexTransfer'])
        ->name('balance.transfer');

    Route::post('balance-transfer', [UserController::class, 'balanceTransfer'])
        ->name('balance.transfer.submit');

    /* =========================
       WELCOME LETTER
    ========================== */
    Route::get('welcome-letter', [UserController::class, 'welcomeLetter'])
        ->name('welcome.letter');

    Route::get('welcome-letter/pdf', [UserController::class, 'welcomeLetterPdf'])
        ->name('welcome.letter.pdf');
});

/*
|--------------------------------------------------------------------------
| CRON & SYSTEM ROUTES
|--------------------------------------------------------------------------
*/
Route::get('cron', [CronController::class, 'cron'])->name('cron');
Route::get('cronnow', [CronController::class, 'cron_now'])->name('cronnow');

Route::get('clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Cache cleared';
});

/*
|--------------------------------------------------------------------------
| SUPPORT TICKETS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('ticket')
    ->name('ticket.')
    ->controller(TicketController::class)
    ->group(function () {

    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{id}', 'replyTicket')->name('reply');
    Route::post('close/{id}', 'closeTicket')->name('close');
    Route::get('download/{attachment_id}', 'ticketDownload')->name('download');
});

/*
|--------------------------------------------------------------------------
| PUBLIC / SITE ROUTES
|--------------------------------------------------------------------------
*/
Route::controller(SiteController::class)->group(function () {

    Route::get('/', 'index')->name('home');

    Route::get('contact', 'contact')->name('contact');
    Route::post('contact', 'contactSubmit');

    Route::get('change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('cookie/accept', 'cookieAccept')->name('cookie.accept');

    Route::get('products/{catId?}', 'products')->name('products');
    Route::get('product/{id}/{slug}', 'productDetails')->name('product.details');

    Route::get('blog', 'blog')->name('blog');
    Route::get('blog/{slug}', 'blogDetails')->name('blog.details');

    Route::get('faq', 'faq')->name('faq');

    Route::post('check/referral', 'checkUsername')->name('check.referral');
    Route::post('get/user/position', 'userPosition')->name('get.user.position');

    Route::get('policy/{slug}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')
        ->withoutMiddleware('maintenance')
        ->name('placeholder.image');

    Route::get('maintenance-mode', 'maintenance')
        ->withoutMiddleware('maintenance')
        ->name('maintenance');

    Route::get('{slug}', 'pages')->name('pages');
});
