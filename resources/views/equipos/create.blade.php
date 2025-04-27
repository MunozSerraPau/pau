<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar Perfil</title>
        
        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <x-header />

        <main class="container d-flex flex-column align-items-center my-5 floating-panel">
            <div class="container mt-5">
            <h1 class="mb-4">Selecciona 5 campeones (API)</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first('champions') }}
                </div>
            @endif

            <form method="POST" action="{{ route('equipos.store') }}">
                @csrf
                <div class="row">
                    @foreach($champions as $champion)
                        @include('equipos.partials.champion-card', ['champion' => $champion])
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Crear equipo</button>
                </div>
            </form>
            </div>
        </main>
        <x-footer />

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const checkboxes = document.querySelectorAll('input[type="checkbox"][name="champions[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        const checked = document.querySelectorAll('input[type="checkbox"][name="champions[]"]:checked').length;
                        if (checked > 5) {
                            this.checked = false;
                            alert('Solo puedes seleccionar un máximo de 5 campeones.');
                        }
                    });
                });
            });
        </script>

    </body>
</html>