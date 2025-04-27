<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Llista Equips</title>
        
        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <x-header />

        <main class="container d-flex flex-column align-items-center my-5 floating-panel">
            <div class="container mt-5">
            <h1>Llistat d'e 'Equipos</h1>

            @foreach ($equipos as $equip)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h2>{{ $equip->nom_equip }}</h2>
                        <small>Creado el: {{ \Carbon\Carbon::parse($equip->data_creacio)->format('d/m/Y') }}</small>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($equip->campeons as $campeon)
                                <div class="col-md-2 text-center mb-3">
                                    <img src="https://ddragon.leagueoflegends.com/cdn/15.1.1/img/champion/{{ $campeon->imgCampio }}" alt="{{ $campeon->nameCampio }}" class="img-fluid mb-2" style="max-height: 100px;">
                                    <div>{{ $campeon->nameCampio }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach


            </div>
        </main>

        <x-footer />
    </body>
</html>