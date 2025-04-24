<div class="row">
    @foreach ($campeones as $campeon)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $campeon->name }}</h5>
                    <p class="card-text">{{ $campeon->description }}</p>
                    <p class="card-text"><strong>Rol:</strong> {{ $campeon->role }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $campeones->links() }}
</div>
