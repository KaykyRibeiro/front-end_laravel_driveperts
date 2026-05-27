<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\MovimentacoesController;


// Route::get('/dashboard/Movimentacoes', function () {
//     return view('welcome');
// })->name('dashboard/Movimentacoes');

Route::get('/dashboard/Movimentacoes', [MovimentacoesController::class, 'listarMovimentacoes'])
    ->name('movimentacoes-index');

Route::get('/produto/buscar', [ProdutoController::class, 'buscar'])->name('produto-buscar');

Route::post('/movimentacoes-store', [MovimentacoesController::class, 'store'])->name('movimentacoes-store');