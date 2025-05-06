<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DepartamentoController;

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

Route::prefix('paises')->group(function(){
    Route::get('/index',[PaisController::class,'index']);
    Route::post('/create',[PaisController::class,'store']);
    Route::put('/update/{id}',[PaisController::class,'update']);
    Route::delete('/delete/{id}',[PaisController::class,'destroy']);
    Route::get('/show/{id}',[PaisController::class,'show']);
    Route::get('/filtro',[PaisController::class,'filter']);
});

Route::prefix('departamentos')->group(function(){
    Route::get('/index',[DepartamentoController::class,'index']);
    Route::post('/create',[DepartamentoController::class,'store']);
    Route::put('/update/{id}',[DepartamentoController::class,'update']);
    Route::delete('/delete/{id}',[DepartamentoController::class,'destroy']);
    Route::get('/show/{id}',[DepartamentoController::class,'show']);
    Route::get('/filtro',[DepartamentoController::class,'filter']);
    Route::put('/enable/{id}',[DepartamentoController::class,'enable']);
    Route::put('/sidable/{id}',[DepartamentoController::class,'desable']);
});
