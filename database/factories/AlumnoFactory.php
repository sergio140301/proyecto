<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $indice = -1;

        $indice++;

       
        $alumnos = [
            // Carrera 1: Ingeniería en Sistemas Computacionales (carrera_id = 1)
            ['18430001', 'Juan', 'Pérez', 'López', 'M', 'L18430001@piedrasnegras.tecnm.mx', 1],
            ['18430002', 'Ana', 'Martínez', 'Hernández', 'F', 'L18430002@piedrasnegras.tecnm.mx', 1],
            ['18430003', 'Carlos', 'Sánchez', 'Ramírez', 'M', 'L18430003@piedrasnegras.tecnm.mx', 1],
            ['18430004', 'María', 'López', 'Vega', 'F', 'L18430004@piedrasnegras.tecnm.mx', 1],
            ['18430005', 'Luis', 'Gómez', 'Jiménez', 'M', 'L18430005@piedrasnegras.tecnm.mx', 1],
        
            // Carrera 2: Ingeniería Electrónica (carrera_id = 2)
            ['18430006', 'Roberto', 'Díaz', 'Núñez', 'M', 'L18430006@piedrasnegras.tecnm.mx', 2],
            ['18430007', 'Gabriela', 'Pineda', 'Torres', 'F', 'L18430007@piedrasnegras.tecnm.mx', 2],
            ['18430008', 'Oscar', 'Fernández', 'Mendoza', 'M', 'L18430008@piedrasnegras.tecnm.mx', 2],
            ['18430009', 'Carla', 'Morales', 'Ríos', 'F', 'L18430009@piedrasnegras.tecnm.mx', 2],
            ['18430010', 'Jorge', 'García', 'Ortega', 'M', 'L18430010@piedrasnegras.tecnm.mx', 2],
        
            // Carrera 6: Gestión Empresarial (carrera_id = 6)
            ['18430011', 'Adriana', 'Hernández', 'Cruz', 'F', 'L18430011@piedrasnegras.tecnm.mx', 6],
            ['18430012', 'Ricardo', 'Guzmán', 'Castillo', 'M', 'L18430012@piedrasnegras.tecnm.mx', 6],
            ['18430013', 'Patricia', 'Vargas', 'Luna', 'F', 'L18430013@piedrasnegras.tecnm.mx', 6],
            ['18430014', 'Sergio', 'Luna', 'Santos', 'M', 'L18430014@piedrasnegras.tecnm.mx', 6],
            ['18430015', 'Claudia', 'Silva', 'Montes', 'F', 'L18430015@piedrasnegras.tecnm.mx', 6],
        
            // Carrera 7: Ingeniería Industrial (carrera_id = 7)
            ['18430016', 'Hugo', 'Zavala', 'Pérez', 'M', 'L18430016@piedrasnegras.tecnm.mx', 7],
            ['18430017', 'Mónica', 'Reyes', 'González', 'F', 'L18430017@piedrasnegras.tecnm.mx', 7],
            ['18430018', 'Raúl', 'Ramos', 'Duarte', 'M', 'L18430018@piedrasnegras.tecnm.mx', 7],
            ['18430019', 'Teresa', 'Campos', 'Sosa', 'F', 'L18430019@piedrasnegras.tecnm.mx', 7],
            ['18430020', 'Fernando', 'Navarro', 'Flores', 'M', 'L18430020@piedrasnegras.tecnm.mx', 7]
        ];

        return [
            'noctrl' => $alumnos[$indice][0], 
            'nombre' => $alumnos[$indice][1],
            'apellidop' => $alumnos[$indice][2],
            'apellidom' => $alumnos[$indice][3], 
            'sexo' => $alumnos[$indice][4], 
            'email' => $alumnos[$indice][5],
            'carrera_id' => $alumnos[$indice][6],
        ];
    }
}
