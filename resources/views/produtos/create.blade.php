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
    <form  action=" {{ action('ProdutosController@store') }}" method="POST">
        @csrf
        <h2 class="text-center">Cadastro de produto</h2><br>
        <div style="width:70%;margin:auto;">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="name" placeholder="Nome do produto" 
                        minlength="2" maxlength="100" required >
                    </div>
                    <div class="col-sm-4">
                        <label>Quantidade</label>
                        <input type="number" class="form-control" name="amount" value="0" min="0" max="999"
                            required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 form-group">
                    <label>Descrição</label>
                    <textarea class="col-xs-12 col-sm-12 col-md-12 form-control" rows="3" name="description" maxlength="255" required ></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary">Inserir</button>
            </div>
        </div>
    </form>
@endsection