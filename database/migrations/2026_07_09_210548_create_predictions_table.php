<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Prediction;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('predictions', function (Blueprint $table) {
        $table->id();
        $table->float('temperatura');
        $table->float('humedad');
        $table->integer('dias_restantes');
        $table->string('estado');
        $table->timestamps();
    });
}
    /**
     * Método para renderizar el Dashboard
     */
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
