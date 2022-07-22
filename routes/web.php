<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FuelTestController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\VendorController;
 
Route::get('/', [HomeController::class, 'index'])->name('login_page'); 

Route::get('/fuel_test', [FuelTestController::class, 'create'])->name('fuel_test');

Route::get('/previous_records', [FuelTestController::class, 'show_previous_records'])->name('previous_records');

Route::get('/all_records', [FuelTestController::class, 'show_all_records'])->name('all_records');

Route::get('/edit', [FuelTestController::class, 'edit'])->name('edit_records');

Route::post('/record_success', [FuelTestController::class, 'store'])->name('record_success');

Route::post('/login', [AuthController::class, 'fuel_test_user_login'])->name('login');
    
Route::get('/logout', [AuthController::class, 'fuel_test_user_logout']);
 
Route::post('/update/{SampleNo}', [FuelTestController::class, 'update']); 

Route::post('/edit/{SampleNo}', [FuelTestController::class, 'edit']); 
 
Route::get('/generate_certificate/{SampleNo}', [PdfController::class, 'index']);

Route::get('/show_certificate/{SampleNo}', [PdfController::class, 'show']);
 
Route::get('/export', [FuelTestController::class, 'export']);

Route::get('/vendors', [VendorController::class, 'index'])->name('vendors');;

Route::get('/filter', [FuelTestController::class, 'filter'])->name('filter');;