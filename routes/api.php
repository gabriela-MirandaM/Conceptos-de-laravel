<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;

//http://127.0.0.1:8000/api/ususarios/index
/**
 * show, get
 * store, post
 * filter,get /{id}
 * update, put
 * destroy, delete
 */

Route::prefix('usuarios')->group(function(){
    Route::get('/index',[UsuarioController::class,'index']);
    Route::post('/create',[UsuarioController::class,'store']);
    Route::put('/update/{id}',[UsuarioController::class,'update']);
    Route::delete('/delete/{id}',[UsuarioController::class,'destroy']);
    Route::get('/show/{id}',[UsuarioController::class,'show']);
    Route::get('/filtro',[UsuarioController::class,'filter']);
});

