<?php

namespace App\Http\Controllers;

use App\Cartao;
use App\Transacao;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;


class CartaoController extends Controller
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

    public function saldo() {
        $saldo = Auth::user()->saldo;
        return response()->json(['saldo' => $saldo], 200);
    }

}
