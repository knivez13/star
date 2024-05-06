<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(
    [
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {


    Route::group(['prefix' => 'maintenance'], function () {
        Route::resource('area', App\Http\Controllers\Maintenance\AreaController::class);
        Route::resource('currency', App\Http\Controllers\Maintenance\CurrencyController::class);
        Route::resource('department', App\Http\Controllers\Maintenance\DepartmentController::class);
        Route::resource('group-section', App\Http\Controllers\Maintenance\GreoupSectionController::class);
        Route::resource('incident-title', App\Http\Controllers\Maintenance\IncidentTitleController::class);
        Route::resource('inspector', App\Http\Controllers\Maintenance\InspectorController::class);
        Route::resource('location', App\Http\Controllers\Maintenance\LocationController::class);
        Route::resource('origination', App\Http\Controllers\Maintenance\OriginationController::class);
        Route::resource('property', App\Http\Controllers\Maintenance\PropertyController::class);
        Route::resource('report-status', App\Http\Controllers\Maintenance\ReportStatusController::class);
        Route::resource('report-type', App\Http\Controllers\Maintenance\ReportTypeController::class);
        Route::resource('result', App\Http\Controllers\Maintenance\ResultController::class);
        Route::resource('user-designation', App\Http\Controllers\Maintenance\UserDestinationController::class);
        Route::resource('user-level', App\Http\Controllers\Maintenance\UserLevelController::class);
    });
});
