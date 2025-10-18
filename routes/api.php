<?php

use App\Http\Controllers\{
    UserController,
    AuthController,
    BlocoController,
    CondominioController,
    ApartamentoController,
    CidadeController,
    EnderecoController,
    EstadoController,
};
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/cadastrar', [UserController::class, 'create'])->middleware('admin');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'create'])->middleware('admin');
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });

    Route::prefix('estado')->group(function () {
        Route::get('/select', [EstadoController::class, 'select']);
    });

    Route::prefix('cidade')->group(function () {
        Route::get('/select/{codigo_uf}', [CidadeController::class, 'selectPorEstado']);
    });

    Route::prefix('endereco')->group(function () {
        Route::post('/', [EnderecoController::class, 'create']);
    });

    Route::prefix('condominio')->group(function() {
        Route::post('/', [CondominioController::class, 'create']);
        Route::get('/', [CondominioController::class, 'list']);
        Route::get('/buscar', [CondominioController::class, 'search']);

        Route::prefix('bloco')->group(function(){
            Route::post('/', [BlocoController::class, 'create']);
            Route::get('/', [BlocoController::class, 'list']);

            Route::prefix('apartamento')->group(function(){
                Route::post('/', [ApartamentoController::class, 'create']);
                Route::get('/', [ApartamentoController::class, 'list']);
                Route::put('/atualizar/{uuid}', [ApartamentoController::class, 'update']);
            });
        });
    });
});
