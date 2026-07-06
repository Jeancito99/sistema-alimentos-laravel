<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PredictionController extends Controller
{
    public function showForm()
    {
        return view('prediccion');
    }

    public function process(Request $request)
    {
        
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg',
            'temp' => 'required|numeric',
            'hum' => 'required|numeric',
        ]);

     
        // Enviar datos a FastAPI
        $response = Http::timeout(60)->attach(
            'file',file_get_contents($request->file('imagen')->getRealPath()),
            'alimento.jpg'
        )->post(env('IA_API_URL') . '/predict', [
                    'temp' => $request->temp,
                    'hum' => $request->hum
                ]);

        $data = $response->json();
        if ($response->successful() && $data) {
            return back()->with(
                'success',
                'Resultado: ' . $data['dias_restantes'] . ' días. Estado: ' . $data['estado']
            );
        }
        return back()->withErrors('Error al conectar con el servicio de IA');
    }
   
}
