<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(
    [
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]
);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('briefing-logs', App\Http\Controllers\BriefingLogsController::class);
    Route::resource('daily-logs', App\Http\Controllers\DailyLogsController::class);
    Route::resource('tracker', App\Http\Controllers\IncidentReportController::class);
    Route::get('tracker/link/{id}', [App\Http\Controllers\IncidentReportController::class, 'link'])->name('traker.link');
    Route::get('tracker/close/{id}', [App\Http\Controllers\IncidentReportController::class, 'closereply'])->name('traker.closereply');
    Route::get('tracker/return/{id}', [App\Http\Controllers\IncidentReportController::class, 'returnHead'])->name('traker.returnHead');
    Route::get('tracker/void/{id}', [App\Http\Controllers\IncidentReportController::class, 'void'])->name('traker.void');
    Route::get('tracker/totalclose/{id}', [App\Http\Controllers\IncidentReportController::class, 'totalclose'])->name('traker.totalclose');
    Route::resource('blacklist', App\Http\Controllers\BlacklistController::class);

    Route::group(['prefix' => 'system-maintenance'], function () {
        Route::resource('area', App\Http\Controllers\Maintenance\AreaController::class);
        Route::resource('currency', App\Http\Controllers\Maintenance\CurrencyController::class);
        Route::resource('department', App\Http\Controllers\Maintenance\DepartmentController::class);
        Route::resource('group-section', App\Http\Controllers\Maintenance\GreoupSectionController::class);
        Route::resource('incident-title', App\Http\Controllers\Maintenance\IncidentTitleController::class);
        Route::resource('inspector', App\Http\Controllers\Maintenance\InspectorController::class);
        Route::resource('location', App\Http\Controllers\Maintenance\LocationController::class);
        Route::resource('origination', App\Http\Controllers\Maintenance\OriginationController::class);
        Route::resource('property', App\Http\Controllers\Maintenance\PropertyController::class);
        // Route::resource('report-status', App\Http\Controllers\Maintenance\ReportStatusController::class);
        Route::resource('report-type', App\Http\Controllers\Maintenance\ReportTypeController::class);
        Route::resource('result', App\Http\Controllers\Maintenance\ResultController::class);
    });

    Route::group(['prefix' => 'user-maintenance'], function () {
        Route::resource('user-designation', App\Http\Controllers\Users\UserDestinationController::class);
        Route::resource('user-level', App\Http\Controllers\Users\UserLevelController::class);
        Route::resource('roles', App\Http\Controllers\Users\RoleController::class);
        Route::resource('users', App\Http\Controllers\Users\UserController::class);
    });

    Route::group(['prefix' => 'blacklist-maintenance'], function () {
        Route::resource('blacklist-status', App\Http\Controllers\Blacklist\BlacklistStatusController::class);
        Route::resource('blacklist-type', App\Http\Controllers\Blacklist\BlacklistTypeController::class);
    });
});
