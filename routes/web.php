<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactCRUDController;

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

Route::get('crud-datatable', [ContactCRUDController::class, 'index']);
Route::post('store-contact', [ContactCRUDController::class, 'store']);
Route::patch('edit-contact', [ContactCRUDController::class, 'edit']);
Route::delete('delete-contact', [ContactCRUDController::class, 'destroy']);

