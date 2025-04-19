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
            <div>
                <h1 class="text-center mb-5 text-white">INDEX</h1>
                <x-search-bar />
                <div class="mb-3">
                    <label for="perPage" class="form-label text-white">Campeones por página:</label>
                    <select id="perPage" class="form-select">
                        <option value="9" selected>9</option>
                        <option value="12">12</option>
                        <option value="15">15</option>
                    </select>
                </div>
                <div id="campeones-list">
                    <x-campeones-list :campeones="$campeones" /> <!-- Pasamos la variable completa -->
                </div>
            </div>
        </main>

        <script>
            const perPageSelect = document.getElementById('perPage');
            const searchInput = document.querySelector('input[name="query"]');

            function fetchCampeones() {
                const query = searchInput.value;
                const perPage = perPageSelect.value;

                fetch(`{{ route('campeones.search') }}?query=${query}&perPage=${perPage}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('campeones-list').innerHTML = html;
                });
            }

            perPageSelect.addEventListener('change', fetchCampeones);
            searchInput.addEventListener('input', fetchCampeones);
        </script>

        <x-footer />
    </body>
</html>
