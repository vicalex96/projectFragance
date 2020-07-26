<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return view('welcome');
});

Route::get('/recomendador', function () {
    return view('recomendador');
});

Route::get('/evaluaciones', function () {
    return view('evaluacion');
});
Route::get('/evaluaciones/variables', 'evaluacionController@obtenerVariables');
Route::post('/evaluaciones/crear-formula', 'evaluacionController@crearFormula');
Route::post('/evaluaciones/crear-escala', 'evaluacionController@crearEscala');

Route::get('/gestionContrato', function () {
    return view('contrato');
});

Route::get('/pedidos', function () {
    return view('pedido');
});



Route::get('/proveedores/inicial','evaluacionController@obtenerListadoInicial');
Route::get('/proveedores/renovacion','evaluacionController@obtenerListadoRenovacion');

Route::apiResource('productores','productorController');
Route::apiResource('proveedores','proveedorController');

Route::apiResource('paises','paisController');

Route::apiResource('contratosOpetations','documentoController');


