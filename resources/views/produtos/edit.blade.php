@extends('layouts.app')

@section('content')
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
    <form  action=" {{ action('ProdutosController@update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h2>Atualizar produto</h2><br>
        <div class="form-group">
            <div class="row">
                <div class="col-sm">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Nome do produto" 
                    minlength="2" maxlength="100" value="{{ $produto->name }}" required >
                </div>
                <div class="col-sm">
                    <label>Quantidade</label>
                    <input type="number" class="form-control" name="amount" value="{{ $produto->amount }}" min="0" max="999"
                        required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea class="form-control" rows="3" name="description" maxlength="255" required >{{ $produto->description }}</textarea>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-primary">Alterar</button>
        </div>
    </form>
@endsection