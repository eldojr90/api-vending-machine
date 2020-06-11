<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config\Controller;

class CartaoController extends Controller
{
    public function saldo() {
        $saldo = Auth::user()->saldo;
        return response()->json(['saldo' => $saldo], 200);
    }

}
