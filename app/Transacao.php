<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transacao extends Model {
    protected $table = "transacoes";

    protected $fillable = ["cartao_id", "valor" , "tipo"];

    public function cartao() {
        return $this->belongsTo(Cartao::class, 'cartao_id');
    }

    public static function validaRecarga() : bool{
        $cartao_id = Auth::user()->id;
        return Transacao::where('cartao_id', $cartao_id)
                ->where("tipo", 0)
                ->whereRaw("DATE_FORMAT(created_at, '%Y/%m/%d') = DATE_FORMAT(current_timestamp, '%Y/%m/%d')")
                ->count() == 0;
    }

    public static function recarga() : bool {
        $cartao_id = Auth::user()->id;
        if(self::validaRecarga()) {
            return Transacao::create([
                'cartao_id' => $cartao_id,
                'valor' => 5.5,
                'tipo' => 0
            ]) != null;
        }
        return false;
    }

    public static function getSaldo() : float{
        $cartao_id = Auth::user()->id;
        $saidas = Transacao::where('cartao_id', $cartao_id)
                ->where("tipo", 1)
                ->whereRaw("DATE_FORMAT(created_at, '%Y/%m/%d') = DATE_FORMAT(current_timestamp, '%Y/%m/%d')")
                ->sum('valor');
        return 5.5 - $saidas;
    }

    public static function compra(float $valor) : bool {
        $cartao_id = Auth::user()->id;
        return Transacao::create([
            'cartao_id' => $cartao_id,
            'valor' => $valor,
            'tipo' => 1
        ]) != null;
    }
}