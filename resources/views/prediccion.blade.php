<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
</head>
<body>
   <form action="{{ route('post_prediccion') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="imagen" required>
    <input type="number" step="0.1" name="temp" placeholder="Temperatura (°C)" required>
    <input type="number" step="0.1" name="hum" placeholder="Humedad (%)" required>
    <button type="submit">Predecir Vida Útil</button>
</form>

@if(session('success'))
    <div class="alert alert-info">{{ session('success') }}</div>
@endif 
</body>
</html>

