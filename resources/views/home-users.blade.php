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
                <h1 class="text-white text-center mb-5">Els teus campions</h1>

                @if (session('success'))
                    <div style="color: green">{{ session('success') }}</div>
                @endif

                <div style="text-align: center; margin-bottom: 50px;">
                    <a href="{{ route('campeones.create') }}" class="btn btn-primary">+ Crea un nou campió</a>
                </div>

                <div class="mb-5 d-flex" style="justify-content: space-around;">
                    <div>
                        <label class="text-white">Mostrar per pàgina:</label>
                        <select id="perPage">
                            <option value="9" selected>9</option>
                            <option value="12">12</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="text-white">Cercar per nom:</label>
                        <input type="text" id="search" placeholder="Escriu un nom">
                    </div>

                    <div>
                        <label class="text-white">Ordenar:</label>
                        <select id="order">
                            <option value="asc" selected>A-Z</option>
                            <option value="desc">Z-A</option>
                        </select>
                    </div>
                </div>

                <div id="champions-list">
                    {{-- Aquí cargaremos los campeones con AJAX --}}
                </div>
            </div>
        </main>

        <x-footer />

        
        <script>
            function loadCampeones(page = 1) {
                let perPage = document.getElementById('perPage').value;
                let order = document.getElementById('order').value;
                let search = document.getElementById('search').value;

                fetch(`/campeones/ajax?page=${page}&perPage=${perPage}&order=${order}&search=${search}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('champions-list').innerHTML = data.view;

                        document.querySelectorAll('.pagination a').forEach(link => {
                            link.addEventListener('click', function (e) {
                                e.preventDefault();
                                const url = new URL(this.href);
                                loadCampeones(url.searchParams.get('page'));
                            });
                        });
                    });
            }

            // Eventos
            document.addEventListener('DOMContentLoaded', function () {
                loadCampeones();

                document.getElementById('perPage').addEventListener('change', () => loadCampeones());
                document.getElementById('order').addEventListener('change', () => loadCampeones());
                document.getElementById('search').addEventListener('input', () => loadCampeones());
            });
        </script>
    </body>
</html>
