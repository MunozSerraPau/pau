<div class="mb-4">
    <form method="GET" action="{{ route('campeones.search') }}" class="d-flex">
        <input type="text" name="query" class="form-control me-2" placeholder="Buscar campeón..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>
