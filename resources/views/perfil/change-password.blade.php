<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar Perfil</title>
        
        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <x-header />

        <main class="container d-flex flex-column align-items-center my-5 floating-panel">
            <div class="container mt-5">

                <h2>Canviar Contrasenya</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('perfil.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Contraseña Actual -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contrasenya Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>

                    <!-- Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nova Contrasenya</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>

                    <!-- Confirmar Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirmar Nova Contrasenya</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Contrasenya</button>
                </form>
            </div>
        </main>

        <x-footer />
    </body>
</html>