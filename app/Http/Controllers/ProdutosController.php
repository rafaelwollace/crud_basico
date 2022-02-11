<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produtos::latest()->paginate(5);
    
        return view('produtos.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'tipo_produto' => 'required',
            'descricao' => 'required',
        ]);
    
        Produtos::create($request->all());
     
        return redirect()->route('produtos.index')
                        ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produtos  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produtos $produto)
    {
        return view('produtos.show',compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produtos  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtos $produto)
    {
        return view('produtos.edit',compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produtos  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produtos $produto)
    {
        $request->validate([
            'tipo_produto' => 'required',
            'descricao' => 'required',
        ]);
    
        $produto->update($request->all());
    
        return redirect()->route('produtos.index')
                        ->with('success','produtos updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produtos  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produtos $produto)
    {
        $produto->delete();
    
        return redirect()->route('produtos.index')
                        ->with('success','Produto Deletado com Sucesso!');
    }
}