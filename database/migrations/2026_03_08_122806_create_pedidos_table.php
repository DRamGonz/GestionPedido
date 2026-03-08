<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            // foreignId crea cliente_id + la restricción de clave foránea
            // cascadeOnDelete: si eliminas un cliente, sus pedidos se borran también
            $table->foreignId('cliente_id')
                   ->constrained('clientes')
                   ->cascadeOnDelete();
            $table->date('fecha');
            $table->decimal('total', 10, 2)->default(0);
            $table->string('estado')->default('pendiente');
            // Estados posibles: pendiente, en_proceso, completado, cancelado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
