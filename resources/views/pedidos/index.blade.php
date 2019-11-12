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
<div class="row">
        <div class="col-sm-8">
            <h2 class="text-center">Meus pedidos</h2><br>
        </div>
        <div class="col-sm-4">
            <button type="button" data-toggle="modal" data-target="#confirm_"
            class="btn btn-outline-secondary">Fazer pedido</button>
        </div>
    </div>
    <form action="{{ action('PedidosController@create', auth()->user()->id) }}" id="create"
        method="PUT">
        <div class="modal fade" id="confirm_"role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h2>Realizar pedido</h2>
                    </div>
                    <div style="margin:10px;"">
                        <div class="form-group">
                            <label for="produto_id">Produto</label>
                            <select class="form-control" name="produto_id" required>
                                <option disabled selected>Selecione o produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->name }} (disponível: {{ $produto->amount }})</option>
                                @endforeach
                            </select>
                            <label for="amount">Quantidade:</label>
                            <input type="number" class="form-control" name="amount" value="0" min="0" max="999"
                            required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="owner" value="{{$produto->user_id}}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Solicitar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <table class="table table-striped table-dark" style="width:80%;margin:auto;">
        <tr>
            <th scope="col">Produto</th>
            <th scope="col">Descrição</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Data</th>
            <th></th>
        </tr>
        @foreach($pedidos as $pedido)
            <tr>
                @foreach($pedido->produto as $value)
                    <td>{{$value->name}}</td>
                    <td>{{$value->description}}</td>
                @endforeach
                <td>{{ $pedido->amount }}</td>
                <td>{{ $pedido->created_at }}</td>
                <td>
                    <form action="{{ action('PedidosController@destroy',$pedido->id) }}" id="delete"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm_{{ $pedido->id }}">Excluir</button>

                        <div class="modal fade" id="confirm_{{ $pedido->id }}" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h4 style="color:black;">
                                            Tem certeza que deseja excluir esse pedido?
                                        </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach    
    </table>
@endsection