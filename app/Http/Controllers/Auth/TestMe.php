<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;

class TestMe extends Controller
{
    public function say() {
        return str_replace("_","+",Str::snake('MikeLowrey'));

        return 'Hello';
    }
}
