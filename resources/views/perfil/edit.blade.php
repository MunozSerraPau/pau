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
                <h2>Editar Perfil</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" value="{{ old('nom', $user->nom) }}">
                    </div>

                    <div class="mb-3">
                        <label for="cognoms" class="form-label">Cognoms</label>
                        <input type="text" class="form-control" name="cognoms" id="cognoms" value="{{ old('cognoms', $user->cognoms) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="correu" class="form-label">Correu</label>
                        <input type="email" class="form-control" name="correu" id="correu" value="{{ old('correu', $user->correu) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nom d'Usuari</label>
                        <input type="text" class="form-control" value="{{ old('nickname', $user->nickname) }}" disabled>
                    </div>

                    <button type="submit" class="btn btn-primary">Desar canvis</button>
                </form>
            </div>
        </main>

        <x-footer />
    </body>
</html>