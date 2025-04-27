<div class="col-md-3 mb-4">
    <div class="card h-100">
        <img src="https://ddragon.leagueoflegends.com/cdn/15.1.1/img/champion/{{ $champion['image']['full'] }}" 
             class="card-img-top" 
             alt="{{ $champion['name'] }}">

        <div class="card-body">
            <h5 class="card-title">{{ $champion['name'] }}</h5>
            <p class="card-text"><strong>Role:</strong>: {{ array_values($champion['tags'])[0] }}</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="champions[]" value="{{ $champion['id'] }}" id="champion-{{ $champion['id'] }}">
                <label class="form-check-label" for="champion-{{ $champion['id'] }}">
                    Seleccionar
                </label>
            </div>
        </div>
    </div>
</div>
