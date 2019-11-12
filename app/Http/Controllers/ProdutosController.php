<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;

class ProdutosController extends Controller
{
    public function index()
    {
        if(auth()->check())
        {
            $produtos = Produtos::all();   
            return view('produtos.index', ['produtos' => $produtos]);
        }
        return redirect()->route('login');
    }

    public function create()
    {
        if(auth()->check())
        {
            return view('produtos.create');
        }
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        if(auth()->check())
        {
            $request->validate([
                'name' => 'required|max:100|min:2',
                'amount' => 'required|numeric|max:999|min:0',
                'description' => 'required|max:255',
                'user_id' => 'required',
            ]);
            Produtos::create($request->all());
            return redirect()->route('meusProdutos')->with('success', 'Produto inserido com sucesso');
        }
        return redirect()->route('login');
    }

    public function edit($id)
    {
        if(auth()->check())
        {
            $produto = Produtos::find($id);
            return view('produtos.edit', ['produto'=> $produto]);
        }
    }
    
    public function update(Request $request, $id)
    {
        if(auth()->check())
        {
            $produto = Produtos::find($id);
            $request->validate([
                'name' => 'required|max:100|min:2',
                'amount' => 'required|max:999|min:0|numeric',
                'description' => 'required|max:255',
                'user_id' => 'required|numeric',
                ]);
                $produto->update($request->all());
                return redirect()->route('meusProdutos')->with('success', 'Produto atualizado com sucesso');
            }
        }
        
        public function destroy($id)
        {
            if(auth()->check())
            {
                Produtos::find($id)->delete();
                return redirect()->route('meusProdutos')
                ->with('success','Produto excluído com successo');
            }   
            return redirect()->route('login');
        }

        public function meusProdutos()
        {
            if(auth()->check())
            {
                $produtos = Produtos::where('user_id', auth()->user()->id)->get();
                return view('produtos.view', ['produtos' => $produtos]);
            }
        }
    }
    