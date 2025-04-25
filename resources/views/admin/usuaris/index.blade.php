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
                <h2>Administració d'Usuaris</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Nickname</th>
                            <th>Nom</th>
                            <th>Cognoms</th>
                            <th>Correu</th>
                            <th>Administrador</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuaris as $usuari)
                        <tr>
                            <td>{{ $usuari->nickname }}</td>
                            <td>{{ $usuari->nom }}</td>
                            <td>{{ $usuari->cognoms }}</td>
                            <td>{{ $usuari->correu }}</td>
                            <td>{{ $usuari->administrador ? 'Sí' : 'No' }}</td>
                            <td>
                                @if(!$usuari->administrador)
                                <form action="{{ route('admin.usuaris.destroy', $usuari->nickname) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar aquest usuari?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                @else
                                <span class="text-muted">Protegit</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

        <x-footer />
    </body>
</html>