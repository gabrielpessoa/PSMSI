<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id', 'produto_id', 'owner', 'amount',
    ];

    public function produto()
    {
        return $this->hasMany('App\Produtos', 'id', 'produto_id');
    }
}
