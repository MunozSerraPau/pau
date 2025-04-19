<div class="row">
    @if (empty($campeones) || count($campeones) === 0)
        <p class="text-center bg-danger">No se encontraron campeones.</p>
    @else
        @foreach ($campeones as $campeon)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $campeon['name'] }}</h5>
                        <p class="card-text">{{ $campeon['description'] }}</p>
                        <p class="card-text"><strong>Rol:</strong> {{ $campeon['role'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="mt-4">
    {{ $campeones->links() }} <!-- Enlaces de paginación -->
</div>
