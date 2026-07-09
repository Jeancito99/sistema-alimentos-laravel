<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Prediction; // Importamos el modelo

class PredictionController extends Controller
{
    public function showForm()
    {
        return view('prediccion');
    }

    // NUEVO: Método para renderizar el Dashboard
    public function dashboard()
    {
        // 1. Obtener métricas clave de SQLite
        $total = Prediction::count();
        $consumibles = Prediction::where('estado', 'Consumible')->count();
        $desechar = Prediction::where('estado', 'Desechar')->count();
        
        // 2. Obtener los últimos 10 registros para la tabla
        $historial = Prediction::latest()->take(10)->get();

        return view('dashboard', compact('total', 'consumibles', 'desechar', 'historial'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg',
            'temp' => 'required|numeric',
            'hum' => 'required|numeric',
        ]);

        try {
            $response = Http::timeout(60)->attach(
                'file', file_get_contents($request->file('imagen')->getRealPath()),
                'alimento.jpg'
            )->post(env('IA_API_URL') . '/predict', [
                'temp' => $request->temp,
                'hum' => $request->hum
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // GUSTO SALVADO: Guardamos la predicción en SQLite automáticamente
                Prediction::create([
                    'temperatura' => $request->temp,
                    'humedad' => $request->hum,
                    'dias_restantes' => $data['dias_restantes'],
                    'estado' => $data['estado']
                ]);

                // CAMBIO AQUÍ: Redirecciona al dashboard con el mensaje de éxito
            return redirect()->route('dashboard')->with(
                'success',
                '¡Análisis completado! Resultado: ' . $data['dias_restantes'] . ' días (' . $data['estado'] . ').'
            );
                // return view('dashboard');
            }

            return back()->withErrors('Error al conectar con el servicio de IA');

        } catch (\Exception $e) {
            return back()->withErrors('No se pudo establecer conexión con el servicio de IA.');
        }
    }
}