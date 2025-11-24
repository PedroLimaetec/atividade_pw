<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrar</title>
    <style>
        :root {
            --bg: #f3f6fb;
            --card: #ffffff;
            --accent: #2563eb;
            --accent-600: #1e40af;
            --muted: #6b7280;
            --danger: #ef4444;
            --radius: 12px;
            --shadow: 0 6px 18px rgba(16, 24, 40, 0.08);
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(180deg, var(--bg), #ffffff);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .wrap {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px;
            box-sizing: border-box;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .logo {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-600));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.18);
        }

        h1 {
            margin: 0;
            font-size: 20px;
            color: #0f172a;
        }

        p.lead {
            margin: 6px 0 18px 0;
            color: var(--muted);
            font-size: 13px;
        }

        form .field {
            margin-bottom: 12px;
        }

        label {
            display: block;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #e6e9ef;
            background: #fbfdff;
            font-size: 15px;
            outline: none;
            transition: box-shadow .12s, border-color .12s, transform .06s;
            box-sizing: border-box;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.08);
            transform: translateY(-1px);
        }

        .actions {
            margin-top: 16px;
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
        }

        button.primary {
            background: linear-gradient(180deg, var(--accent), var(--accent-600));
            color: #fff;
            border: 0;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.12);
        }

        button.primary:active {
            transform: translateY(1px);
        }

        .error {
            background: #fff5f5;
            border: 1px solid rgba(239, 68, 68, 0.12);
            color: var(--danger);
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .small-muted {
            color: var(--muted);
            font-size: 13px;
        }

        .footer {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        @media (max-width:480px) {
            .card {
                padding: 20px;
                border-radius: 10px;
            }

            .logo {
                width: 38px;
                height: 38px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="card" role="main">
            <!-- Cabeçalho da carta: logo e título -->
            <div class="brand">
                <div class="logo">APP</div>

                <!-- Título e subtítulo que explicam a ação da página -->
                <div>
                    <h1>Entrar na sua conta</h1>
                    <p class="lead">Insira seu nome e senha para continuar</p>
                </div>
            </div>

            <!-- Mensagem de erro de autenticação vinda do servidor -->
            @if($errors->has('auth'))
            <div class="error">{{ $errors->first('auth') }}</div>
            @endif

            <!-- envia para a rota nomeada login.attempt -->
            <form method="POST" action="{{ route('login.attempt') }}" novalidate>
                @csrf
                <!-- usado como identificador no exemplo (poderia ser email) -->
                <div class="field">
                    <label for="name">Nome</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    <!-- Mensagem de validação para o campo name -->
                    @error('name') <div class="error" style="background:#fff6eb;border-color:rgba(245,158,11,0.08);color:#b45309;margin-top:8px">{{ $message }}</div> @enderror
                </div>

                <!-- tipo password para ocultar entrada -->
                <div class="field">
                    <label for="password">Senha</label>
                    <input id="password" type="password" name="password" required>
                    <!-- Mensagem de validação para o campo password -->
                    @error('password') <div class="error" style="background:#fff6eb;border-color:rgba(245,158,11,0.08);color:#b45309;margin-top:8px">{{ $message }}</div> @enderror
                </div>

                <!-- texto auxiliar e botão de enviar -->
                <div class="actions">
                    <!-- Texto auxiliar informativo -->
                    <div class="small-muted">Olá, essa é uma atividade de laravel sobre tokens de autentificação, middlewares e CRUD :)</div>

                    <!-- Botão principal que manda o formulário -->
                    <button type="submit" class="primary">Entrar</button>
                </div>
            </form>

            <!-- Rodapé pequeno com observação -->
            <div class="footer">
                <small>O formulário acaba por aqui mesmo :(</small>
            </div>
        </div>
    </div>
</body>

</html>