<!DOCTYPE html>
<html>
<head>
    <title>Editar Campio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <x-header />

    <main class="container d-flex flex-column align-items-center my-5">
        <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
            <h4 class="mb-4 text-center">Edita el teu campió</h4>

            <form action="{{ route('campeones.update', $campeon->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nom del Champion</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $campeon->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripció</label>
                    <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', $campeon->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="resource" class="form-label">Recurs del Champion</label>
                    <input type="text" class="form-control" name="resource" id="resource" value="{{ old('resource', $campeon->resource) }}" required>
                </div>

                <div class="mb-3">
                    <label>Rol:</label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="" disabled {{ old('role', $campeon->role) == '' ? 'selected' : '' }}>-----</option>
                        <option value="Tank" {{ old('role', $campeon->role) == 'Tank' ? 'selected' : '' }}>Tank</option>
                        <option value="Marksman" {{ old('role', $campeon->role) == 'Marksman' ? 'selected' : '' }}>Marksman</option>
                        <option value="Mage" {{ old('role', $campeon->role) == 'Mage' ? 'selected' : '' }}>Mage</option>
                        <option value="Fighter" {{ old('role', $campeon->role) == 'Fighter' ? 'selected' : '' }}>Fighter</option>
                        <option value="Assassin" {{ old('role', $campeon->role) == 'Assassin' ? 'selected' : '' }}>Assassin</option>
                        <option value="Controller" {{ old('role', $campeon->role) == 'Controller' ? 'selected' : '' }}>Controller</option>
                        <option value="Specialist" {{ old('role', $campeon->role) == 'Specialist' ? 'selected' : '' }}>Specialist</option>
                    </select><br>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary shadow">UPDATE Champion</button>
                </div>
            </form>
        </div>
    </main>

    <x-footer />
</body>

</html>