<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cartao extends Model {
    protected $table = "cartoes";

    protected $fillable = ['token', 'saldo'];

    public function transacoes(){
        return $this->hasMany(Transacao::class, 'cartao_id');
    }

    public static function atualizaSaldo() : bool {
        $novoSaldo = Transacao::getSaldo();
        $cartao = Auth::user();
        $cartao->saldo = $novoSaldo;
        return $cartao->save();
    }

    
}