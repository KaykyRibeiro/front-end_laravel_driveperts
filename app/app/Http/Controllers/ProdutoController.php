<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Movimentacoes;
use Illuminate\Support\Facades\Crypt;

class ProdutoController extends Controller
{
    public function buscar(Request $request)
{
    $request->validate([
        'busca_produto' => 'nullable|string|max:30'
    ]);

    $produtosEncontrados = [];

    if ($request->filled('busca_produto')) {

        $busca = trim($request->busca_produto);

        $produtosEncontrados = Produtos::where('pro_status', 1)
            ->where(function ($query) use ($busca) {

                $query->where('pro_nome', 'like', "%{$busca}%")
                    ->orWhere('pro_cod', 'like', "%{$busca}%");

            })
            ->limit(10)
            ->get();
    }

    $movimentacoes = Movimentacoes::with('produto')
        ->orderBy('mov_data', 'desc')
        ->get();

    return view('welcome', [
        'produtosEncontrados' => $produtosEncontrados,
        'movimentacoes' => $movimentacoes
    ]);
}
}
