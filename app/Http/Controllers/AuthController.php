<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Mostra o formulário de login.
     *
     * - Se o usuário já estiver autenticado (Auth::check()), redireciona para a rota 'home'.
     * - Caso contrário, retorna a view 'login'.
     */
    public function showLogin()
    {
        // Verifica se já existe sessão autenticada
        if (Auth::check()) {
            // Redireciona para a home caso já esteja logado
            return redirect()->route('home');
        }

        // Exibe o formulário de login
        return view('login');
    }

    /**
     * Processa a tentativa de login.
     *
     * - Recebe um LoginRequest (validação centralizada).
     * - Tenta autenticar com as credenciais name + password.
     * - Em caso de sucesso, regenera a sessão (proteção contra session fixation)
     *   e redireciona para a URL pretendida (intended) ou para 'home'.
     * - Em caso de falha, volta para o formulário com erro de autenticação e mantém apenas
     *   o campo 'name' preenchido.
     */
    public function login(LoginRequest $request)
    {
        // Pega apenas os campos necessários para autenticar
        $credentials = $request->only('name', 'password');

        // Tenta autenticar com o guard padrão (web).
        // O Hash do password é verificado automaticamente pelo provider do Laravel.
        if (Auth::attempt($credentials)) {
            // Regenera a sessão para prevenir session fixation attacks
            $request->session()->regenerate();

            // Redireciona para a URL originalmente requisitada ou para a home
            return redirect()->intended(route('home'));
        }

        // Em caso de credenciais inválidas, retorna com erro (campo 'auth')
        // e mantém apenas o campo 'name' no old() do formulário
        return back()
            ->withErrors(['auth' => 'Credenciais inválidas'])
            ->onlyInput('name');
    }

    /**
     * Logout.
     *
     * - Desloga o usuário com Auth::logout().
     * - Invalida a sessão atual e regenera o token CSRF.
     * - Redireciona para a página de login.
     */
    public function logout(Request $request)
    {
        // Desloga o usuário
        Auth::logout();

        // Invalida os dados da sessão atual
        $request->session()->invalidate();

        // Gera um novo token CSRF para a próxima sessão
        $request->session()->regenerateToken();

        // Redireciona para a página de login
        return redirect()->route('login');
    }
}