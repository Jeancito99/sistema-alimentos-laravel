<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Alimentos</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <div class="flex h-screen">
        <div class="w-64 bg-slate-800 text-white p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-wider mb-8 text-emerald-400">FastiFood AI</h2>
                <nav class="space-y-3">
                    <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded bg-slate-700 font-semibold text-white">📊 Dashboard</a>
                    <a href="{{ route('prediccion') }}" class="block py-2.5 px-4 rounded text-slate-300 hover:bg-slate-700 hover:text-white transition">🔍 Nuevo Análisis</a>
                </nav>
            </div>
            <p class="text-xs text-slate-500">v1.0 - SQLite Engine</p>
        </div>

        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold text-slate-800 mb-6">Panel de Control de Calidad</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-xs border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Analizados</p>
                    <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $total }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-xs border-l-4 border-emerald-500">
                    <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Estado: Consumible</p>
                    <p class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $consumibles }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-xs border-l-4 border-rose-500">
                    <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Estado: Desechar</p>
                    <p class="text-3xl font-extrabold text-rose-600 mt-1">{{ $desechar }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="bg-white p-6 rounded-xl shadow-xs lg:col-span-1 flex flex-col items-center">
                    <h3 class="text-lg font-bold text-slate-700 mb-4 self-start">Distribución de Estados</h3>
                    <div class="w-full max-w-[240px]">
                        <canvas id="estadoChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-xs lg:col-span-2">
                    <h3 class="text-lg font-bold text-slate-700 mb-4">Últimos Registros Guardados</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-500">
                            <thead class="bg-slate-50 text-slate-700 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="py-3 px-4">Fecha/Hora</th>
                                    <th class="py-3 px-4">Temp (°C)</th>
                                    <th class="py-3 px-4">Humedad (%)</th>
                                    <th class="py-3 px-4">Días Restantes</th>
                                    <th class="py-3 px-4">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($historial as $item)
                                <tr>
                                    <td class="py-3 px-4 text-xs">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="py-3 px-4 font-medium text-slate-700">{{ $item->temperatura }}°C</td>
                                    <td class="py-3 px-4">{{ $item->humedad }}%</td>
                                    <td class="py-3 px-4 text-center font-bold">{{ $item->dias_restantes }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $item->estado == 'Consumible' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $item->estado }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-400">No hay análisis registrados todavía.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('estadoChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Consumible', 'Desechar'],
                datasets: [{
                    data: [{{ $consumibles }}, {{ $desechar }}],
                    backgroundColor: ['#10b981', '#f43f5e'],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>