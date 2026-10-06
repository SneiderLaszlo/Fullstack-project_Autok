<?php

use App\Http\Controllers\Car_MakerController;
use App\Http\Controllers\Car_ModelController;
use App\Models\Car_Maker;
use App\Models\Car_Model;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'makerCount' => Car_Maker::count(),
        'modelCount' => Car_Model::count(),
        'latest' => Car_Model::with('car_maker')->latest('id')->take(6)->get(),
    ]);
})->name('home');

Route::get('/car_makers', [Car_MakerController::class, 'index'])->name('car_makers.index');
Route::get('/car_makers/create', [Car_MakerController::class, 'create'])->name('car_makers.create');
Route::post('/car_makers', [Car_MakerController::class, 'store'])->name('car_makers.store');
Route::get('/car_makers/{car_maker}/edit', [Car_MakerController::class, 'edit'])->name('car_makers.edit');
Route::patch('/car_makers/{car_maker}', [Car_MakerController::class, 'update'])->name('car_makers.update');
Route::delete('/car_makers/{car_maker}', [Car_MakerController::class, 'destroy'])->name('car_makers.destroy');

Route::get('/car_models', [Car_ModelController::class, 'index'])->name('car_models.index');
Route::get('/car_models/create', [Car_ModelController::class, 'create'])->name('car_models.create');
Route::post('/car_models', [Car_ModelController::class, 'store'])->name('car_models.store');
Route::get('/car_models/{car_model}/edit', [Car_ModelController::class, 'edit'])->name('car_models.edit');
Route::patch('/car_models/{car_model}', [Car_ModelController::class, 'update'])->name('car_models.update');
Route::delete('/car_models/{car_model}', [Car_ModelController::class, 'destroy'])->name('car_models.destroy');
