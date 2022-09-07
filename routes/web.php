<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FuelTestController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\VendorController;
 
Route::get('/', [HomeController::class, 'index'])->name('login_page'); 

Route::get('/FuelTest', [FuelTestController::class, 'create'])->name('fuel_test');

Route::get('/PreviousRecords', [FuelTestController::class, 'show_previous_records'])->name('previous_records');

Route::get('/AllRecords', [FuelTestController::class, 'show_all_records'])->name('all_records');

Route::get('/edit', [FuelTestController::class, 'edit'])->name('edit_records');

Route::get('/RecordSuccess', [FuelTestController::class, 'store'])->name('record_success');

Route::post('/login', [AuthController::class, 'fuel_test_user_login'])->name('login');
    
Route::get('/logout', [AuthController::class, 'fuel_test_user_logout']);
 
Route::post('/update/{SampleNo}', [FuelTestController::class, 'update']); 

Route::get('/Edit/{SampleNo}', [FuelTestController::class, 'edit']); 
 
Route::post('/GenerateCertificate/{SampleNo}', [PdfController::class, 'index']);

Route::post('/ShowCertificate/{SampleNo}', [PdfController::class, 'show']);
 
Route::get('/export', [FuelTestController::class, 'export']);

Route::get('/Vendors', [VendorController::class, 'index'])->name('vendors');

Route::get('/filter', [FuelTestController::class, 'filter'])->name('filter');

Route::get('/FuelTestStats', [FuelTestController::class, 'show_stats'])->name('fuel_test_stats');