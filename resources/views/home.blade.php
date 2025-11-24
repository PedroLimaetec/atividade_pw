<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo, {{ auth()->user()->name }}</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Sair</button>
    </form>
</body>
</html>