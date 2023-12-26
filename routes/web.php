<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ClubController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\KlasemenController;

Route::get('/club/create', [ClubController::class, 'create'])->name('club.create');
Route::post('/club/store', [ClubController::class, 'store'])->name('club.store');

Route::get('/match/create', [MatchController::class, 'create'])->name('match.create');
Route::post('/match/store', [MatchController::class, 'store'])->name('match.store');

Route::get('/', [KlasemenController::class, 'index'])->name('klasemen.index');

