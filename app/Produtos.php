<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';
    
    protected $fillable = [
        'name', 'description', 'amount', 'user_id',
    ];

    public function pedidos()
    {
        return $this->hasMany('App\Pedidos', 'produto_id', 'id');
    }
}
