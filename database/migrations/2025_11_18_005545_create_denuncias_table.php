<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id(); // id autoincrementable
            $table->string('titulo', 100);
            $table->string('imagen', 255);
            $table->string('descripcion', 255);
            $table->string('ubicacion', 150);
            $table->string('estado', 20); // pendiente, en proceso, resuelto
            $table->string('ciudadano', 100);
            $table->string('telefono_ciudadano', 15);
            $table->timestamp('fecha_registro')->useCurrent(); 
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
