<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        
        <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <x-header />

        <main class="container d-flex flex-column align-items-center my-5 floating-panel">
            <div class="">
                <h1>HOME</h1>
                <div class="form-row mb-3">
                    <div class="col">
                        <input type="text" id="search" class="form-control" placeholder="Buscar por nombre...">
                    </div>
                    <div class="col">
                        <select id="perPage" class="form-control">
                            <option value="9" selected>9 por página</option>
                            <option value="12">12 por página</option>
                            <option value="15">15 por página</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="sortOrder" class="form-control">
                            <option value="asc" selected>Orden Ascendente</option>
                            <option value="desc">Orden Descendente</option>
                        </select>
                    </div>
                </div>

                <div id="campeones-list">
                    <!-- Aquí se cargarán los campeones -->
                </div>
            </div>
        </main>

        <x-footer />

        <script>
            function fetchCampeones(page = 1) {
                let search = $('#search').val();
                let perPage = $('#perPage').val();
                let sortOrder = $('#sortOrder').val();

                $.ajax({
                    url: "{{ route('campeones.fetch') }}",
                    type: "GET",
                    data: {
                        search: search,
                        per_page: perPage,
                        sort: sortOrder,
                        page: page
                    },
                    success: function(data) {
                        $('#campeones-list').html(data);
                    }
                });
            }

            $(document).ready(function() {
                fetchCampeones();

                $('#search').on('keyup', function() {
                    fetchCampeones();
                });

                $('#perPage, #sortOrder').on('change', function() {
                    fetchCampeones();
                });

                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    fetchCampeones(page);
                });
            });
        </script>
    </body>
</html>
