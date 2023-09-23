<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuridController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Ini API buat ngambil data murid
Route::get('/murid', [MuridController::class, 'semua']);

//Ini API buat ngambil data murid berdasar id
Route::get('/murid/{id}', [MuridController::class, 'show']);

//API buat nambah data
Route::post('/addMurid', [MuridController::class, 'store']);

//API buat edit
Route::put('/updateMurid/{id}', [MuridController::class, 'update']);

//API buat hapus. make {id} soal e di controller make "public function hapus($id)"
Route::delete('/hapusMurid/{id}', [MuridController::class, 'hapus']);