<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <x-header />

    <main class="container d-flex justify-content-center align-items-center my-5">
        <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%;">
            <h1>Nova contrasenya</h1>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <label>Nova contrasenya:</label>
                <input type="password" name="password" required>

                <label>Repeteix contrasenya:</label>
                <input type="password" name="password_confirmation" required>

                <button type="submit">Canviar</button>
            </form>

            @if ($errors->any())
                <p>{{ $errors->first() }}</p>
            @endif

        </div>
    </main>

    <x-footer />
</body>
</html>
