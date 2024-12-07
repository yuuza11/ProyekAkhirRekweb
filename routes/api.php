<?php 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route; 
/* 
|-------------------------------------------------------------------------- 
| API Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register API routes for your application. 
These 
| routes are loaded by the RouteServiceProvider within a group 
which 
| is assigned the "api" middleware group. Enjoy building your 
API! 
| 
*/ 
Route::post('/register', 
[\App\Http\Controllers\Api\AuthController::class, 'register']); 
Route::post('/login', 
[\App\Http\Controllers\Api\AuthController::class, 'login']); 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) { 
    return $request->user(); 
}); 

Route::middleware('auth:sanctum')->group(function () { 
    Route::post('/logout', 
[\App\Http\Controllers\Api\AuthController::class, 'logout']); 
});

// Routes untuk Mahasiswa
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mahasiswa/create', [\App\Http\Controllers\MahasiswaController::class, 'store']);
    Route::get('/mahasiswa/read', [\App\Http\Controllers\MahasiswaController::class, 'index']);
    Route::put('/mahasiswa/update/{id}', [\App\Http\Controllers\MahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/delete/{id}', [\App\Http\Controllers\MahasiswaController::class, 'destroy']);

    // Routes untuk Dosen
    Route::post('/dosen/create', [\App\Http\Controllers\DosenController::class, 'store']);
    Route::get('/dosen/read', [\App\Http\Controllers\DosenController::class, 'index']);
    Route::put('/dosen/update/{id}', [\App\Http\Controllers\DosenController::class, 'update']);
    Route::delete('/dosen/delete/{id}', [\App\Http\Controllers\DosenController::class, 'destroy']);

    // Routes untuk Matakuliah (Makul)
    Route::post('/makul/create', [\App\Http\Controllers\MakulController::class, 'store']);
    Route::get('/makul/read', [\App\Http\Controllers\MakulController::class, 'index']);
    Route::put('/makul/update/{id}', [\App\Http\Controllers\MakulController::class, 'update']);
    Route::delete('/makul/delete/{id}', [\App\Http\Controllers\MakulController::class, 'destroy']);
});