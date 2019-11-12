@extends('layouts.app')

@section('content')
    <h2 class="text-center">Todos produtos</h2><br>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <table class="table table-striped table-dark" style="width:80%;margin:auto;">
        <tr>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Descrição</th>
        </tr>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->name }}</td>
                <td>{{ $produto->amount }}</td>
                <td>{{ $produto->description }}</td>
            </tr>
        @endforeach    
    </table>

@endsection