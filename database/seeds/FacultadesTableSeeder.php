<?php

use Illuminate\Database\Seeder;
use App\Facultad;

class FacultadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facultad::create([
            'nombre' => 'Administración y Finanzas',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Administración y Marketing',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Administración y Negocios Internacionales',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Administración y recursos humanos',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Arquitectura',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ciencias y Tecnología de la Comunicación',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Contabilidad',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Derecho',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Economía',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Enfermería',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería ambiental',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería civil',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería de minas',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería de Sistemas e Informática',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería eléctrica',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería electrónica',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería empresarial',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería industrial',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería mecánica',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Ingeniería mecatrónica',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Medicina Humana',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Odontología',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Psicología',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Tecnología Médica-Terapia física y rehabilitación',
            'institucion_id' => 1,
        ]);
        Facultad::create([
            'nombre' => 'Tecnología Médica-Laboratorio clínico y anatomía patológica',
            'institucion_id' => 1,
        ]);
    }
}
