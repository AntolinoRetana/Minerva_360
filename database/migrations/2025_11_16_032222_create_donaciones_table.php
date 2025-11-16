<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donante_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->decimal('monto', 10, 2)->default(0);
            $table->date('fecha');
            $table->enum('metodo_pago', ['Efectivo', 'Transferencia', 'Paypal']);
            $table->timestamps();

            $table->foreign('donante_id')
                ->references('id')->on('donantes')
                ->onDelete('cascade');

            $table->foreign('proyecto_id')
                ->references('id')->on('proyectos')
                ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('donaciones');
    }
};
