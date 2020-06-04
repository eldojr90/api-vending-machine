<?php

namespace App\Http\Controllers;

use App\Cartao;
use App\Transacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;

class TransacaoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Transacao::recarga();
        Cartao::atualizaSaldo();
    }

    public function compra(Request $request) {
        $val = floatval($request->valor); 
        $saldo = Auth::user()->saldo;
        $msg = "Saldo insuficiente. Valor da Compra: ".number_format($val, 2, ',','.').". Saldo: ".number_format($saldo, 2, ',','.');
        
        if($val < 2 || $val > 5.5 ) {
            return response()->json(['msg' => 'Informe somente valores entre R$ 2,00 a R$ 5,50.'], 200);
        }

        if($saldo >= $val) {
            if(Transacao::compra($val) && Cartao::atualizaSaldo()) {
                $saldo = Auth::user()->saldo;
                $msg = "Compra realizada com sucesso. Saldo: ".number_format($saldo, 2, ',','.');
            }
        }

        return response()->json(['msg' => $msg], 200);
    }

}
