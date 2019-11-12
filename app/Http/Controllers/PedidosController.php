<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;
use App\Produtos;

class PedidosController extends Controller
{
    public function index()
    {
        if(auth()->check())
        {
            $pedidos = Pedidos::where('user_id', auth()->user()->id)->get();
            $produtos = Produtos::where('user_id', '!=', auth()->user()->id)->get();
            return view('pedidos.index', ['pedidos' => $pedidos ,'produtos' => $produtos]);
        }
        return redirect()->route('login');
    }

    public function create(Request $request)
    {
        if(auth()->check())
        {
            $produto = Produtos::find($request->produto_id);
            $produto->amount -= $request->amount;
            if($produto->amount >= 0){
                Pedidos::create($request->all());
                $produto->update();
                return redirect()->route('pedidos.index')->with('success', 'Pedido feito com sucesso');
            }else{
                return redirect()->route('pedidos.index')->withErrors('Quantidade não disponível');

            }
        }
        return redirect()->route('login');
    }

    public function destroy($id)
    {
        if(auth()->check())
        {
            $pedido = Pedidos::find($id)->delete();
            return redirect()->route('pedidos.index')
                ->with('success','Pedido deletada com successo');
        }
        return redirect()->route('login');
    }
}
