<?php

namespace App\Http\Controllers\Config;

use App\Cartao;
use App\Transacao;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class Controller extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->boot();
    }

    protected function boot() 
    {
        if(Auth::user()) {
            Transacao::recarga();
            Cartao::atualizaSaldo();
        }
    }

}
