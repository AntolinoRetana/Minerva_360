<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('carrera')->nullable();
            $table->string('ubicacion')->nullable();
            $table->decimal('meta', 10, 2)->default(0);
            $table->decimal('progreso', 10, 2)->default(0);
            $table->enum('estado', ['Activo', 'Completado'])->default('Activo');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('proyectos');
    }
};
