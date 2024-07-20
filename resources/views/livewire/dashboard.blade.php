
<div wire:poll>
    <h1>Real-Time Dashboard</h1>
    <div>
        <h2>Metrics</h2>
        <ul>
            @foreach($metrics as $metric)
                <li>{{ $metric['name'] }}: {{ $metric['value'] }}</li>
            @endforeach
        </ul>
    </div>
</div>

