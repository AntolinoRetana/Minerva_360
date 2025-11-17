<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyectos = [
            [
                'nombre' => 'Centro de Computación',
                'descripcion' => 'Construcción de un moderno centro de computación equipado con 50 computadoras de última generación para estudiantes de ingeniería.',
                'carrera' => 'Ingeniería en Sistemas',
                'ubicacion' => 'Edificio A - Planta 2',
                'meta' => 25000.00,
                'progreso' => 15000.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Laboratorio de Química',
                'descripcion' => 'Renovación completa del laboratorio de química con equipamiento moderno y materiales de seguridad.',
                'carrera' => 'Ingeniería Química',
                'ubicacion' => 'Edificio C - Planta 1',
                'meta' => 30000.00,
                'progreso' => 8500.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Biblioteca Digital',
                'descripcion' => 'Implementación de una biblioteca digital con acceso a miles de libros electrónicos y revistas científicas.',
                'carrera' => 'Todas las carreras',
                'ubicacion' => 'Biblioteca Central',
                'meta' => 15000.00,
                'progreso' => 15000.00,
                'estado' => 'Completado',
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(1),
            ],
            [
                'nombre' => 'Auditorio Universitario',
                'descripcion' => 'Remodelación del auditorio principal con sistema de sonido profesional y asientos nuevos para 500 personas.',
                'carrera' => 'Todas las carreras',
                'ubicacion' => 'Edificio Principal',
                'meta' => 50000.00,
                'progreso' => 22000.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Canchas Deportivas',
                'descripcion' => 'Construcción de nuevas canchas de fútbol y baloncesto con iluminación nocturna para actividades deportivas.',
                'carrera' => 'Todas las carreras',
                'ubicacion' => 'Área Deportiva',
                'meta' => 35000.00,
                'progreso' => 12000.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Sala de Dibujo Técnico',
                'descripcion' => 'Equipamiento de sala con mesas de dibujo, software CAD y materiales para estudiantes de arquitectura.',
                'carrera' => 'Arquitectura',
                'ubicacion' => 'Edificio B - Planta 3',
                'meta' => 18000.00,
                'progreso' => 6500.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Centro de Emprendimiento',
                'descripcion' => 'Creación de un espacio para incubadora de empresas con mentorías y recursos para estudiantes emprendedores.',
                'carrera' => 'Administración de Empresas',
                'ubicacion' => 'Edificio D - Planta 1',
                'meta' => 20000.00,
                'progreso' => 20000.00,
                'estado' => 'Completado',
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'nombre' => 'Laboratorio de Robótica',
                'descripcion' => 'Implementación de un laboratorio especializado en robótica con brazos mecánicos, sensores y kits de Arduino.',
                'carrera' => 'Ingeniería Mecatrónica',
                'ubicacion' => 'Edificio A - Planta 3',
                'meta' => 28000.00,
                'progreso' => 10500.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Cafetería Estudiantil',
                'descripcion' => 'Renovación completa de la cafetería con mobiliario nuevo, área de descanso y opciones de comida saludable.',
                'carrera' => 'Todas las carreras',
                'ubicacion' => 'Planta Baja',
                'meta' => 40000.00,
                'progreso' => 18000.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Programa de Becas',
                'descripcion' => 'Fondo para otorgar becas académicas a estudiantes de escasos recursos con excelencia académica.',
                'carrera' => 'Todas las carreras',
                'ubicacion' => 'Administración',
                'meta' => 60000.00,
                'progreso' => 35000.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Clínica Odontológica',
                'descripcion' => 'Equipamiento de clínica odontológica con 10 unidades dentales para prácticas de estudiantes.',
                'carrera' => 'Odontología',
                'ubicacion' => 'Edificio de Ciencias de la Salud',
                'meta' => 45000.00,
                'progreso' => 22000.00,
                'estado' => 'Activo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Red WiFi Universitaria',
                'descripcion' => 'Ampliación de la red WiFi a todos los espacios del campus con conexión de alta velocidad.',
                'carrera' => 'Todas las carreras',
                'ubicacion' => 'Todo el campus',
                'meta' => 12000.00,
                'progreso' => 12000.00,
                'estado' => 'Completado',
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
        ];

        DB::table('proyectos')->insert($proyectos);
    }
}
