<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-light">
    <x-header />

    <main class="container d-flex justify-content-center align-items-center my-5">
        <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%;">
            <h1>Iniciar Sessió</h1>
            @if (session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>Nickname:</label>
                <input type="text" name="nickname" value="{{ old('nickname', request()->cookie('nickname')) }}" required>
                <br>

                <label>Contrasenya:</label>
                <input type="password" name="password" required>
                <br>

                <label>
                    <input type="checkbox" name="remember_nickname"> Recorda’m
                </label>
                <br>

                @if(session('login_attempts', 0) >= 3)
                    <div class="g-recaptcha my-3" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                @endif

                <button type="submit">Entrar</button>
            </form>
            @if ($errors->any())
                <div style="color: red;">
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
            @endif
        </div>
    </main>

    <x-footer />
</body>
</html>

