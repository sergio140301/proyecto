<?php

namespace Database\Factories;

use App\Models\Carrera;
use App\Models\Reticula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materia>
 */
class MateriaFactory extends Factory
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

        // Definimos las materias para cada retícula
        // Retícula ISC (3 materias por semestre)
        $mat = [
            //sistemas
            [1, 'Cálculo Diferencial', 'CalcDif', 'CD', 1],
            [1, 'Fundamentos de Programación', 'FundProg', 'FP', 1],
            [1, 'Taller de Ética', 'TallEtica', 'TE', 1],
            [2, 'Cálculo Integral', 'CalcInt', 'CI', 1],
            [2, 'Programación Orientada a Objetos', 'ProgOO', 'POO', 1],
            [2, 'Contabilidad Financiera', 'ContabFin', 'CF', 1],
            [3, 'Estructura de Datos', 'EstDatos', 'ED', 1],
            [3, 'Matemáticas Discretas', 'MatDisc', 'MD', 1],
            [3, 'Taller de Administración', 'TallAdmin', 'TA', 1],
            [4, 'Métodos Numéricos', 'MetNum', 'MN', 1],
            [4, 'Fundamentos de Base de Datos', 'FundBD', 'FBD', 1],
            [4, 'Investigación de Operaciones', 'InvOp', 'IO', 1],
            [5, 'Fundamentos de Telecomunicaciones', 'FundTel', 'FT', 1],
            [5, 'Fundamentos de Ingeniería de Software', 'FundIS', 'FIS', 1],
            [5, 'Simulación', 'Simul', 'SIM', 1],
            [6, 'Redes de Computadoras', 'Redes', 'RC', 1],
            [6, 'Ingeniería de Software', 'IngSoft', 'IS', 1],
            [6, 'Sistemas Operativos', 'SisOp', 'SO', 1],
            [7, 'Conmutación y Enrutamiento', 'ConEnrut', 'CE', 1],
            [7, 'Tópicos Avanzados de Programación', 'TopProg', 'TAP', 1],
            [7, 'Desarrollo Sustentable', 'DesSus', 'DS', 1],
            [8, 'Administración de Redes', 'AdminRed', 'AR', 1],
            [8, 'Programación Web', 'ProgWeb', 'PW', 1],
            [8, 'Taller de Investigación I', 'TallInv1', 'TI1', 1],
            [9, 'Inteligencia Artificial', 'IA', 'IA', 1],
            [9, 'Taller de Investigación II', 'TallInv2', 'TI2', 1],
            [9, 'Residencia Profesional', 'ResProf', 'RP', 1],

            //industrial
            [1, 'Matemáticas I', 'MatI', 'MI', 7],
            [1, 'Química', 'Quim', 'Q', 7],
            [1, 'Desarrollo Sustentable', 'DesSus', 'DS', 7],
            [2, 'Matemáticas II', 'MatII', 'MII', 7],
            [2, 'Dibujo Industrial', 'DibInd', 'DI', 7],
            [2, 'Contabilidad Financiera', 'ContabFin', 'CF', 7],
            [3, 'Estadística', 'Estad', 'EST', 7],
            [3, 'Proceso de Manufactura', 'ProcMan', 'PM', 7],
            [3, 'Administración de Empresas', 'AdminEmp', 'AE', 7],
            [4, 'Investigación de Operaciones', 'InvOp', 'IO', 7],
            [4, 'Ingeniería de Métodos', 'IngMet', 'IM', 7],
            [4, 'Calidad', 'Calid', 'C', 7],
            [5, 'Logística', 'Logist', 'LG', 7],
            [5, 'Planeación y Control de la Producción', 'PlanProd', 'PCP', 7],
            [5, 'Taller de Investigación I', 'TallInv1', 'TI1', 7],
            [6, 'Ergonomía', 'Ergo', 'ER', 7],
            [6, 'Gestión de Calidad', 'GesCal', 'GC', 7],
            [6, 'Taller de Investigación II', 'TallInv2', 'TI2', 7],
            [7, 'Mercadotecnia', 'Merc', 'MKT', 7],
            [7, 'Proyectos de Inversión', 'ProyInv', 'PI', 7],
            [7, 'Desarrollo Emprendedor', 'DesEmp', 'DE', 7],
            [8, 'Producción Lean', 'ProdLean', 'PL', 7],
            [8, 'Sistemas de Manufactura', 'SisManu', 'SM', 7],
            [8, 'Residencia Profesional', 'ResProf', 'RP', 7],
            [9, 'Diseño de Instalaciones', 'DisInst', 'DI', 7],
            [9, 'Administración de la Cadena de Suministro', 'AdmCS', 'ACS', 7],
            [9, 'Sistemas Integrados de Manufactura', 'SisIM', 'SIM', 7]
        ];
        
    


        // Generar la materia según la retícula
        return [
            'idMateria' => fake()->unique()->bothify('M######'),  // ID único de materia
            'semestre' => $mat[$indice][0],
            'nombreMateria' => $mat[$indice][1],  // Nombre de la materia
            'nivel' => fake()->randomElement(['L', 'S']),  
            'nombreMediano' => $mat[$indice][2],  
            'nombreCorto' => $mat[$indice][3], 
            'modalidad' => fake()->randomElement(['E', 'M']),  
            'reticula_id' => $mat[$indice][4] 
        ];
    }
}
