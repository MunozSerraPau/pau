<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        
        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <x-header />

        <main class="container d-flex flex-column align-items-center my-5 floating-panel">
            <div class="">
                <h1>HOME</h1>
                <p>Esta es la página de Home.</p>
                
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
            document.getElementById('searchForm').addEventListener('submit', function (e) {
                e.preventDefault(); // Prevenir el envío del formulario
            });

            document.getElementById('search').addEventListener('input', function () {
                const search = this.value;
                const order = document.getElementById('order').value;
                const perPage = document.getElementById('perPage').value;

                fetch(`{{ route('search-campeones') }}?search=${search}&order=${order}&perPage=${perPage}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('campeones-list').innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
    </body>
</html>
