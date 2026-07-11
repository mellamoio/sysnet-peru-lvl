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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id(); // Equivale a BIGINT AUTO_INCREMENT
            $table->dateTime('fecha')->useCurrent();
            $table->foreignId('tipo_movimiento_id')->constrained('tipos_movimientos');
            $table->foreignId('usuario_id')->constrained('users');

            // Estos campos pueden ser nulos dependiendo del tipo de movimiento
            $table->foreignId('tecnico_id')->nullable()->constrained('tecnicos');
            $table->foreignId('cliente_id')->nullable()->constrained('clientes');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores');

            $table->string('numero_documento', 80)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
