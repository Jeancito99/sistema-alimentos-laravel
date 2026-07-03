<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PredictionController extends Controller
{
    public function showForm() {
        return view('prediccion');
    }

    public function process(Request $request) {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg',
            'temp' => 'required|numeric',
            'hum' => 'required|numeric',
        ]);

        // Enviar datos a FastAPI
        $response = Http::attach(
            'file', 
            file_get_contents($request->file('imagen')->getRealPath()), 
            'alimento.jpg'
        )->post(env('IA_API_URL') . '/predict', [
            'temp' => $request->temp,
            'hum' => $request->hum
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Resultado: ' . $response->json()['dias_restantes'] . ' días. Estado: ' . $response->json()['estado']);
        }

        return back()->withErrors('Error al conectar con el servicio de IA');
    }
}
