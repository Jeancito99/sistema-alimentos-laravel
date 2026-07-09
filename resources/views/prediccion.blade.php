<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel AI - Predicción</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8 flex flex-col items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-slate-700 text-center">Analizar Alimento</h2>
        
        <form action="{{ route('post_prediccion') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" name="imagen" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
            <input type="number" step="0.1" name="temp" placeholder="Temperatura (°C)" required class="w-full px-3 py-2 border rounded-md focus:outline-emerald-500">
            <input type="number" step="0.1" name="hum" placeholder="Humedad (%)" required class="w-full px-3 py-2 border rounded-md focus:outline-emerald-500">
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-md transition">Predecir Vida Útil</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">📊 Ir al Dashboard</a>
        </div>

        @if($errors->any())
            <div class="mt-4 p-3 bg-rose-100 border-l-4 border-rose-500 text-rose-900 text-sm rounded-r">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 

        @if(session('success'))
            <div class="mt-4 p-3 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-900 text-sm rounded-r">
                {{ session('success') }}
            </div>
        @endif 
    </div>

</body>
</html>