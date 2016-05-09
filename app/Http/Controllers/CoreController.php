<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

class CoreController extends Controller
{
    public function index() {
        return view('core.welcome', ['name' => 'Martin']);
    }
}