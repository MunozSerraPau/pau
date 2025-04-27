@if ($campeones->count())
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
        @foreach ($campeones as $campeon)
            <div style="border: 1px solid #ccc; padding: 10px; background: white; flex-direction: column;" class="d-flex justify-content-between">
                <div>
                    <h4>{{ $campeon->name }}</h4>
                    <hr />
                    <p>{{ Str::limit($campeon->description, 100) }}</p>
                    
                    <p class="mb-0"><strong>Rol:</strong> {{ $campeon->role }}</p>
                    <p class="mb-0"><strong>Recurs:</strong> {{ $campeon->resource }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $campeones->links() }}
    </div>
@else
    <p>No s'han trobat campions.</p>
@endif
