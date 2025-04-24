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
        <div class="bg-white rounded p-4 shadow" style="width: 400px;">
            <h3 class="mb-4 text-center fw-bold">Afegir Champion</h3>

            <form action="{{ route('campeones.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nom del Champion</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripcio</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="resource" class="form-label">Recurs of Champion</label>
                    <input type="text" id="resource" name="resource" class="form-control" value="{{ old('resource') }}" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="" disabled selected>-----</option>
                        <option value="Tank" {{ old('role') == 'Tank' ? 'selected' : '' }}>Tank</option>
                        <option value="Marksman" {{ old('role') == 'Marksman' ? 'selected' : '' }}>Marksman</option>
                        <option value="Mage" {{ old('role') == 'Mage' ? 'selected' : '' }}>Mage</option>
                        <option value="Fighter" {{ old('role') == 'Fighter' ? 'selected' : '' }}>Fighter</option>
                        <option value="Assassin" {{ old('role') == 'Assassin' ? 'selected' : '' }}>Assassin</option>
                        <option value="Controller" {{ old('role') == 'Controller' ? 'selected' : '' }}>Controller</option>
                        <option value="Specialist" {{ old('role') == 'Specialist' ? 'selected' : '' }}>Specialist</option>
                    </select>
                </div>

                <button type="submit" class="btn w-100 shadow-sm" style="background-color: #b4a7d6;">Crear Champion</button>
            </form>
        </div>
    </main>

    <x-footer />
</body>

</html>