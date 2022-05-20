<?php

use App\Http\Controllers\SesionController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', function () {
    return view('home');
});


Route::post('/sesion', [SesionController::class,'sesionValidate']);



Route::get('/usuario', function () {
    return view('home');
    
});

Route::get('/administrador', function () {
    return view('home');
    
});

Route::get('/administrador/create', function () {
     return view('home');
});


Route::get('/empleados', [UsuarioController::class,'getEmpleados']);
Route::get('/getRoles', [UsuarioController::class,'getRoles']);
Route::get('/getAreas', [UsuarioController::class,'getAreas']);


Route::post('/createEmpleado',[UsuarioController::class,'createEmpleado']);
Route::post('/deleteEmpleado',[UsuarioController::class,'deleteEmpleado']);
Route::post('/updateEmpleado',[UsuarioController::class,'updateEmpleado']);

