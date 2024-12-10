<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AsignacionUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@Tecnm.mx',
            'password' => Hash::make('12345'),
            'rol' => 'ADMIN'
        ]);



        $personal = Personal::get();

        foreach($personal as $persona){
            DB::table('users')->insert([
                'name' => $persona->RFC,
                'email' => $persona->id.'@gmail.com',
                'password' =>  Hash::make('12345678'),
                'rol' => 'DOCENTE',
                'personal_id' => $persona->id,
                'alumno_id' => null
            ]);
        }

        $alumnos = Alumno::get();

        foreach($alumnos as $alumno){
            DB::table('users')->insert([
                'name' => $alumno->noctrl,
                'email' => $alumno->id.'@tecnm.mx',
                'password' =>  Hash::make('12345678'),
                'rol' => 'ALUMNO',
                'personal_id' => null,
                'alumno_id' => $alumno->id
            ]);
        }

    DB::table('users')->insert([
        'name' => 'Coordinador',
        'email' => 'coordinador@Tecnm.mx',
        'password' => Hash::make('coordinador123'),
        'rol' => 'COORDINADOR'
    ]);
    }
}
