<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SingUp</title>

        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>
    <body class="bg-light">
        <x-header />   <!-- Incluye el header -->

        <main class="container d-flex justify-content-center align-items-center my-5">
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                <h1>Crear Compte</h1>

                @if ($errors->any())
                    <div style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <label>Nom:</label><br>
                    <input type="text" name="nom" value="{{ old('nom') }}" required>
                    <br>
                    <label>Cognoms:</label><br>
                    <input type="text" name="cognoms" value="{{ old('cognoms') }}" required>
                    <br>
                    <label>Correu electrònic:</label><br>
                    <input type="email" name="correu" value="{{ old('correu') }}" required>
                    <br>
                    <label>Nickname:</label><br>
                    <input type="text" name="nickname" value="{{ old('nickname') }}" required>
                    <br><br>
                    <label>Contrasenya:</label><br>
                    <input type="password" name="contrasenya" required>
                    <br>
                    <label>Confirma contrasenya:</label>
                    <input type="password" name="contrasenya_confirmation" required>
                    <br><br>
                    <label>Imatge de perfil (opcional):</label> <br>
                    <input type="file" name="imgPerfil" accept="image/*">
                    <br><br>
                    <button type="submit">Crear Compte</button>
                </form>

                <p><a href="{{ route('login') }}">Ja tens compte? Inicia sessió</a></p>
            </div>
        </main>

        <x-footer /> <!--Incluye el footer -->
    </body>
</html>