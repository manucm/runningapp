<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Contracts\Auth\Guard;

class UserProfileComposer
{
    public function __construct(Guard $auth) {
    //  dd(Auth::user());
    }

    public function compose(View $view ) {
        $user = Auth::user();
        $view->with('usuarioConectado', $user);
    }
}
