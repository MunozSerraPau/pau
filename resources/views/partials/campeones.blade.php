<div class="row">
    @foreach($campeones as $campeon)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $campeon->name }}</h5>
                    <p class="card-text">{{ $campeon->description }}</p>
                    <p><strong>Recurso:</strong> {{ $campeon->resource }}</p>
                    <p><strong>Rol:</strong> {{ $campeon->role }}</p>
                    <p><strong>Creador:</strong> {{ $campeon->creator }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {!! $campeones->links() !!}
</div>