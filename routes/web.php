<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkinController;
use App\Http\Controllers\SkinImportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\PredictionHistoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/api/weapons/{weapon}/skins', [WelcomeController::class, 'getWeaponSkins'])->name('api.weapon.skins');
Route::post('/recommend', [RecommendationController::class, 'recommend'])->name('recommend');
Route::post('/recommend/raw', [RecommendationController::class, 'recommendRaw'])->name('recommend.raw');
Route::post('/recommend/save', [RecommendationController::class, 'save'])->name('recommend.save');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/predictions', [PredictionHistoryController::class, 'index'])->name('predictions.index');
    Route::patch('/predictions/{predictionHistory}/status', [PredictionHistoryController::class, 'updateStatus'])
        ->name('predictions.status.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Skin CRUD Routes
    Route::resource('skins', SkinController::class);
    Route::resource('weapons', WeaponController::class);

    // Skin Import Routes
    Route::get('/skins-import', [SkinImportController::class, 'showImportForm'])->name('skins.import.form');
    Route::post('/skins-import', [SkinImportController::class, 'import'])->name('skins.import');
    Route::get('/skins-import/template', [SkinImportController::class, 'downloadTemplate'])->name('skins.import.template');
});

require __DIR__ . '/auth.php';
