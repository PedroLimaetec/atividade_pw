<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Meu App') }}</title>

    <!-- Estilos globais do layout (pode ser movido para um arquivo CSS separado) -->
    <style>
        :root{
            --bg:#f6f8fb;
            --card:#ffffff;
            --accent:#2563eb;
            --accent-600:#1e40af;
            --muted:#6b7280;
            --danger:#ef4444;
            --radius:12px;
            --shadow: 0 8px 30px rgba(15,23,42,0.06);
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        /* Reset e fundo da aplicação */
        html,body{ height:100%; margin:0; background:linear-gradient(180deg,var(--bg),#fff); -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; color:#0f172a; }

        /* Container central que limita a largura do conteúdo */
        .container{
            max-width:1100px;
            margin:28px auto;
            padding:0 16px;
            box-sizing:border-box;
        }

        /* Barra superior (appbar) com espaçamento entre elementos */
        header.appbar{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            margin-bottom:18px;
        }

        /* Área da marca: logo e nome do app */
        .brand{
            display:flex;
            align-items:center;
            gap:12px;
        }

        /* Caixa que serve como logo visual (iniciais) */
        .logo{
            width:44px;
            height:44px;
            border-radius:10px;
            background:linear-gradient(135deg,var(--accent),var(--accent-600));
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-weight:700;
            box-shadow: 0 6px 18px rgba(37,99,235,0.12);
        }

        /* Área de ações na barra (botões e logout) */
        nav.actions{ display:flex; align-items:center; gap:10px; }

        /* Estilos genéricos para botões links */
        a.btn{
            display:inline-block;
            padding:8px 12px;
            border-radius:10px;
            text-decoration:none;
            color:#fff;
            font-weight:600;
        }

        /* Variedades de botões */
        a.btn.primary{ background:linear-gradient(180deg,var(--accent),var(--accent-600)); }
        a.btn.positive{ background:linear-gradient(180deg,#10b981,#059669); }

        /* Botão de logout estilizado como texto clicável */
        button.logout{
            background:transparent;
            border:0;
            color:var(--accent);
            font-weight:600;
            cursor:pointer;
            padding:8px 10px;
            border-radius:8px;
        }

        /* Área principal com cartão branco para o conteúdo */
        main.card{
            background:var(--card);
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            padding:20px;
        }

        /* Estilos de mensagens flash */
        .flash-success{ padding:12px;border-radius:10px;background:#ecfdf5;color:#065f46;margin-bottom:14px; }
        .flash-error{ padding:12px;border-radius:10px;background:#fff5f5;color:#b91c1c;margin-bottom:14px; }

        /* Rodapé pequeno */
        footer.small{ text-align:center;color:var(--muted);font-size:13px;margin-top:18px }

        /* Ajustes visuais para a paginação gerada pelo Laravel */
        .pagination{ display:flex; gap:6px; list-style:none; padding:0; margin:0; }
        .pagination li a, .pagination li span{ padding:8px 10px; border-radius:8px; text-decoration:none; color:var(--muted); border:1px solid #eef2f6; display:inline-block; }
        .pagination li.active span{ background:var(--accent); color:#fff; border-color:var(--accent); }
    </style>
</head>
<body>
    <div class="container">
        <!-- Appbar / cabeçalho com marca e ações -->
        <header class="appbar">
            <div class="brand">
                <!-- Logo: exibe as primeiras 3 letras do nome do app em maiúsculas -->
                <div class="logo">{{ strtoupper(substr(config('app.name', 'APP'), 0, 3)) }}</div>

                <!-- Nome do app e subtítulo -->
                <div>
                    <div style="font-weight:700;font-size:16px">{{ config('app.name', 'Meu App') }}</div>
                    <div style="color:var(--muted);font-size:13px">Painel de controle</div>
                </div>
            </div>

            <!-- Nav de ações (exibido de forma diferente para auth/guest) -->
            <nav class="actions" aria-label="Ações">
                @auth
                    <!-- Quando o usuário está autenticado, mostramos o nome, botão novo e logout -->
                    <div style="color:var(--muted);font-size:14px;margin-right:6px">Olá, <strong>{{ auth()->user()->name }}</strong></div>

                    <!-- Link rápido para criar um novo produto -->
                    <a href="{{ route('products.create') }}" class="btn positive">Novo</a>

                    <!-- Form de logout (POST) com token CSRF -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="logout">Sair</button>
                    </form>
                @endauth

                @guest
                    <!-- Para visitantes, mostramos o botão de login -->
                    <a href="{{ route('login') }}" class="btn primary">Entrar</a>
                @endguest
            </nav>
        </header>

        <!-- Conteúdo principal em um cartão -->
        <main class="card" role="main">
            <!-- Exibe mensagens de sucesso/erro que vêm da sessão -->
            @if(session('success'))
                <div class="flash-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="flash-error">{{ session('error') }}</div>
            @endif

            <!-- Aqui as views filhas injetam seu conteúdo com @section('content') -->
            @yield('content')
        </main>

        <!-- Rodapé simples com informação do app -->
        <footer class="small">
            <div>Olá, essa é uma atividade de laravel sobre tokens de autentificação, middlewares e CRUD :)</div>
        </footer>
    </div>
</body>
</html>