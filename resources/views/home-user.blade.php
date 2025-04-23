<!DOCTYPE html>
<html>
<head>
    <title>Home User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
    <body class="bg-light">
        <x-header />

        <main class="container d-flex flex-column align-items-center my-5 floating-panel">
            <div class="">
                <h1>Benvingut {{ Auth::user()->nom }}</h1>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Tancar sessió</button>
                </form>

                @php
                    $allowedValues = [9, 12, 15]; // Valores permitidos
                    $perPage = in_array(request('perPage'), $allowedValues) ? request('perPage') : 9; // Validar valor
                @endphp

                <form method="GET" action="{{ route('home') }}" class="mb-4" id="searchForm">
                    <label for="perPage">Campeones por página:</label>
                    <select name="perPage" id="perPage" onchange="this.form.submit()">
                        <option value="9" {{ $perPage == 9 ? 'selected' : '' }}>9</option>
                        <option value="12" {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                        <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                    </select>

                    <label for="order" class="ms-3">Ordenar por:</label>
                    <select name="order" id="order" onchange="this.form.submit()">
                        <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Ascendente</option>
                        <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Descendente</option>
                    </select>

                    <label for="search" class="ms-3">Buscar:</label>
                    <input type="text" id="search" name="search" class="form-control d-inline-block w-auto" 
                           placeholder="Buscar campeones..." value="{{ request('search') }}">
                </form>

                <div id="campeones-list">
                    <x-campeones-list :perPage="$perPage" :order="$order" />
                </div>

            </div>
        </main>

        <x-footer />

        <script>
            function fetchCampeones() {
                const query = $('#search').val();
                const perPage = $('#perPage').val();
                const order = $('#order').val();

                $.ajax({
                    url: "{{ route('campeones.user') }}",
                    method: 'GET',
                    data: { query, perPage, order },
                    success: function(data) {
                        $('#campeones-list').html(data);
                    }
                });
            }

            $('#search, #perPage, #order').on('input change', function() {
                fetchCampeones();
            });
        </script>
    </body>
</html>
