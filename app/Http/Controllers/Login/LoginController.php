<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('login.login');
    }
    

    public function login(Request $request)
    {
        // Lógica de autenticação
    }

    public function register(Request $request)
    {
        return view('login.register');
    }

    public function logout(Request $request)
    {
        // Lógica de logout
    }
}