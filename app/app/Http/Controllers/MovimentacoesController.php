<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movimentacoes;
use App\Models\Produtos;
use Illuminate\Support\Facades\Crypt;

class MovimentacoesController extends Controller
{
   public function store(Request $request)
    {
        $request->validate([
            'mov_data' => 'required|date',
            'mov_qtd' => 'required|integer|min:1',
            'mov_tipo' => 'required|in:COMPRA,VENDA,DEFEITO,PERDA,VENCIMENTO,USO_E_CONSUMO,DEVOLUCAO,OUTROS',
            'pro_id' => 'required|string',
        ]);

        try {

            $produtoId = Crypt::decryptString($request->pro_id);

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('erro', 'Produto inválido.');
        }

        Movimentacoes::create([
            'mov_data' => $request->mov_data,
            'mov_qtd' => $request->mov_qtd,
            'mov_tipo' => $request->mov_tipo,
            'pro_id' => $produtoId,
            'ven_id' => null
        ]);

        // return redirect()->back()->with('sucesso', 'Movimentação registrada com sucesso!');
        return redirect()
            ->route('movimentacoes-index')
            ->with('sucesso', 'Movimentação registrada com sucesso!');
    }

    public function listarMovimentacoes()
    {
        $movimentacoes = Movimentacoes::with('produto')->orderBy('mov_data', 'desc')->get();

        return view('welcome', ['movimentacoes' => $movimentacoes]);
    }
}
