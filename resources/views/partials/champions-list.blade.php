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
                    
                    <p class="mb-0">{{ $campeon->creator }}</p>
                </div>

                <div>
                    <a href="{{ route('campeones.edit', $campeon->id) }}">Editar</a>

                    <form action="{{ route('campeones.destroy', $campeon->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Estàs segur que vols eliminar aquest campió?')">Eliminar</button>
                    </form>
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