<form action="{{ route('prediccion.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="imagen" required>
    <input type="number" step="0.1" name="temp" placeholder="Temperatura (°C)" required>
    <input type="number" step="0.1" name="hum" placeholder="Humedad (%)" required>
    <button type="submit">Predecir Vida Útil</button>
</form>

@if(session('success'))
    <div class="alert alert-info">{{ session('success') }}</div>
@endif