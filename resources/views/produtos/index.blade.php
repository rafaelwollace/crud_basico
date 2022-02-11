@extends('layouts.master')

@section('content')

<div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sistema Cadastro de Produtos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href=""> Cadastrar Produto</a>
            </div>
            <br />
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Descrição</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->tipo_produto }}</td>
            <td>{{ \Str::limit($value->descricao, 100) }}</td>
            <td>
                <form action="{{ route('produtos.destroy', $value->id) }}" method="POST">   
                    <a class="btn btn-info" href="{{ route('produtos.show', $value->id) }}">Show</a>    
                    <a class="btn btn-primary" href="{{ route('produtos.edit', $value->id) }}">Edit</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  

@stop