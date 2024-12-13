<?php

use App\Http\Controllers\MateriaAbiertaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptoController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ReticulaController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\FormAlumnoController;
use App\Http\Controllers\Grupo18283Controller;
use App\Http\Controllers\GrupoHorario18283Controller;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\HoraController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PersonalPlazaController;
use App\Http\Controllers\GrupoHorarioController;
use App\Http\Controllers\PeriodoTutoriaController;
use App\Http\Controllers\RendimientoController;
use App\Http\Controllers\TutoriaController;
use App\Http\Controllers\TutoriaTutorController;
use App\Http\Controllers\AsesoriaController;

use App\Http\Controllers\HorarioAlumnoController;


//rutas del pryecto tutorias

//VISTA COORDINADOR
Route::middleware('auth')->group(function () {
    Route::get('/tutorias', action: [TutoriaController::class, 'index'])->name('tutorias');

    Route::get('/tutorias.tablatutoriascoord', [TutoriaController::class, 'index'])->name('tutorias.tablatutoriascoord');
    Route::get('/tutorias.create', [TutoriaController::class, 'create'])->name('tutorias.create');
    Route::post('/tutorias.store', [TutoriaController::class, 'store'])->name('tutorias.store');
    Route::get('/tutorias/{iddocente}/{periodo}', [TutoriaController::class, 'show'])->name('tutorias.show');
    Route::get('/tutorias/reporte/{iddocente}/{periodo}', [TutoriaController::class, 'generaReporte'])->name('tutorias.reporte');


});

//VISTA TUTOR
Route::middleware('auth')->group(function () {
    Route::get('/tutoriastutor', action: [TutoriaTutorController::class, 'index'])->name('tutoriastutor');

    //tutorias
    Route::get('/tutoriastutor.tablatutor', [TutoriaTutorController::class, 'index'])->name('tutoriastutor.tablatutor');
    Route::get('/tutoriastutor/{noctrl}/{idperiodo}', [TutoriaTutorController::class, 'show'])->name('tutoriastutor.show');
    Route::get('/tutoriastutor/generar-excel', [TutoriaTutorController::class, 'generarExcel'])->name('tutoriastutor.generarExcel');

});

    //asesorias
    Route::middleware('auth')->group(function () {
        Route::get('/asesorias', [AsesoriaController::class, 'index'])->name('asesorias');

        Route::get('/asesorias.asesoriastutor', [AsesoriaController::class, 'index'])->name('asesorias.asesoriastutor');
        Route::post('/asesorias.store', [AsesoriaController::class, 'store'])->name('asesorias.store');
        Route::get('/asesorias/{id}/{noctrl}', [AsesoriaController::class, 'asignarAs'])->name('asesorias.asignarAs');
    });


//VISTA ALUMNOS
Route::middleware('auth')->group(function () {
    Route::get('/formalumnos.index', [FormAlumnoController::class, 'index'])->name('formalumnos.index');

    Route::resource('formalumnos', FormAlumnoController::class);

    Route::get('/formalumnos', [FormAlumnoController::class, 'index'])->name('formalumnos');
    Route::get('/generar-reporte', [FormAlumnoController::class, 'generaReporte'])->name('generar-reporte');

    Route::get('/formalumnos.asesoriasalumno', [FormAlumnoController::class, 'index2'])->name('formalumnos.asesoriasalumno');
    Route::get('/generar-reporte-asesoria', [FormAlumnoController::class, 'generaReporteAsesoria'])->name('generar-reporte-asesoria');
});


//VISTA ADMIN
Route::middleware('auth')->group(function () {
    Route::get('/periodotutorias.index', [PeriodoTutoriaController::class, 'index'])->name('periodotutorias.index');
    Route::resource('periodotutorias', PeriodoTutoriaController::class);
    Route::get('/periodotutorias', [PeriodoTutoriaController::class, 'index'])->name('periodotutorias');

    Route::get('/horarioalumnos', [HorarioAlumnoController::class, 'index'])->name('horarioalumnos');
    Route::post('/horarioalumnos.store', [HorarioAlumnoController::class, 'store'])->name('horarioalumnos.store');
});


//EXAMEN TABLA GRUPOS

Route::middleware('auth')->group(function () {
    Route::resource('grupos18283', Grupo18283Controller::class);
    Route::get('/grupos18283.index', [Grupo18283Controller::class, 'index'])->name('grupos18283.index');
    Route::get('/grupos18283.create', [Grupo18283Controller::class, 'create'])->name('grupos18283.create');
    Route::post('/grupos18283.store', [Grupo18283Controller::class, 'store'])->name('grupos18283.store');
    Route::get('/grupos18283.show/{grupo18283}', [Grupo18283Controller::class, 'show'])->name('grupos18283.show');
    Route::get('/grupos18283.edit/{grupo18283}', [Grupo18283Controller::class, 'edit'])->name('grupos18283.edit');
    Route::put('/grupos18283.update/{grupo18283}', [Grupo18283Controller::class, 'update'])->name('grupos18283.update');

    Route::post('/grupos18283/{grupoId}/horario/store', [Grupo18283Controller::class, 'storeHorario'])->name('grupos18283.storeHorario');
    Route::delete('/grupos18283/{grupoId}/horario/{dia}/{hora}', [Grupo18283Controller::class, 'destroyHorario'])->name('grupos18283.destroyHorario');

    Route::get('/grupos18283/eliminar/{grupo18283}', [Grupo18283Controller::class, 'eliminar'])->name('grupos18283.eliminar');
    Route::delete('/grupos18283/{grupo18283}', [Grupo18283Controller::class, 'destroy'])->name('grupos18283.destroy');
});


Route::resource('gruposhorarios18283', GrupoHorario18283Controller::class);

Route::middleware('auth')->group(function () {
    Route::get('/gruposhorarios18283.index', [GrupoHorario18283Controller::class, 'index'])->name('gruposhorarios18283.index');
    Route::get('/gruposhorarios18283.create', [GrupoHorario18283Controller::class, 'create'])->name('gruposhorarios18283.create');
    Route::post('/gruposhorarios18283.store', [GrupoHorario18283Controller::class, 'store'])->name('gruposhorarios18283.store');
    Route::get('/gruposhorarios18283.show/{grupoHorario18283}', [GrupoHorario18283Controller::class, 'show'])->name('gruposhorarios18283.show');
    Route::get('/gruposhorarios18283.edit/{grupoHorario18283}', [GrupoHorario18283Controller::class, 'edit'])->name('gruposhorarios18283.edit');
    Route::put('/gruposhorarios18283.update/{grupoHorario18283}', [GrupoHorario18283Controller::class, 'update'])->name('gruposhorarios18283.update');
    Route::get('/gruposhorarios18283/eliminar/{grupoHorario18283}', [GrupoHorario18283Controller::class, 'eliminar'])->name('gruposhorarios18283.eliminar');
    Route::delete('/gruposhorarios18283/{grupoHorario18283}', [GrupoHorario18283Controller::class, 'destroy'])->name('gruposhorarios18283.destroy');
});


//CATALOGO//
//rutas de catalogos
Route::middleware('auth')->group(function () {

    Route::get('/catalogos.otraVista', [CatalogoController::class, 'otraVista'])->name('catalogos.otraVista');
    Route::get('/catalogos/submenu', [CatalogoController::class, 'submenu'])->name('catalogos.submenu');

    Route::middleware('auth')->group(function () {
        Route::get('/catalogos/submenu', [CatalogoController::class, 'submenu'])->name('catalogos.submenu');
    });
});


//*SIN LLAVE FORANEA*
//PERIODOS
//RUTA DE PERIODOS + AUTH
Route::resource('periodos', PeriodoController::class);

Route::middleware('auth')->group(function () {
    Route::get('/periodos', [PeriodoController::class, 'index'])->name('periodos.index');
    Route::get('/periodos/create', [PeriodoController::class, 'create'])->name('periodos.create');
    Route::post('/periodos', [PeriodoController::class, 'store'])->name('periodos.store');
    Route::get('/periodos/{periodo}', [PeriodoController::class, 'show'])->name('periodos.show');
    Route::get('/periodos/{periodo}/edit', [PeriodoController::class, 'edit'])->name('periodos.edit');
    Route::put('/periodos/{periodo}', [PeriodoController::class, 'update'])->name('periodos.update');
    Route::get('/periodos/eliminar/{periodo}', [PeriodoController::class, 'eliminar'])->name('periodos.eliminar');
    Route::delete('/periodos/{periodo}', [PeriodoController::class, 'destroy'])->name('periodos.destroy');
});

//PLAZAS
Route::resource('plazas', PlazaController::class);

Route::middleware('auth')->group(function () {
    Route::get('/plazas', [PlazaController::class, 'index'])->name('plazas.index');
    Route::get('/plazas/create', [PlazaController::class, 'create'])->name('plazas.create');
    Route::post('/plazas', [PlazaController::class, 'store'])->name('plazas.store');
    Route::get('/plazas/{plaza}', [PlazaController::class, 'show'])->name('plazas.show');
    Route::get('/plazas/{plaza}/edit', [PlazaController::class, 'edit'])->name('plazas.edit');
    Route::put('/plazas/{plaza}', [PlazaController::class, 'update'])->name('plazas.update');
    Route::get('/plazas/eliminar/{plaza}', [PlazaController::class, 'eliminar'])->name('plazas.eliminar');
    Route::delete('/plazas/{plaza}', [PlazaController::class, 'destroy'])->name('plazas.destroy');
});

//PUESTOS
Route::resource('puestos', PuestoController::class);

Route::middleware('auth')->group(function () {
    Route::get('/puestos', [PuestoController::class, 'index'])->name('puestos.index');
    Route::get('/puestos/create', [PuestoController::class, 'create'])->name('puestos.create');
    Route::post('/puestos', [PuestoController::class, 'store'])->name('puestos.store');
    Route::get('/puestos/{puesto}', [PuestoController::class, 'show'])->name('puestos.show');
    Route::get('/puestos/{puesto}/edit', [PuestoController::class, 'edit'])->name('puestos.edit');
    Route::put('/puestos/{puesto}', [PuestoController::class, 'update'])->name('puestos.update');
    Route::get('/puestos/eliminar/{puesto}', [PuestoController::class, 'eliminar'])->name('puestos.eliminar');
    Route::delete('/puestos/{puesto}', [PuestoController::class, 'destroy'])->name('puestos.destroy');
});

//DEPTOS
Route::resource('deptos', DeptoController::class);

Route::middleware('auth')->group(function () {
    Route::get('/deptos', [DeptoController::class, 'index'])->name('deptos.index');
    Route::get('/deptos/create', [DeptoController::class, 'create'])->name('deptos.create');
    Route::post('/deptos', [DeptoController::class, 'store'])->name('deptos.store');
    Route::get('/deptos/{depto}', [DeptoController::class, 'show'])->name('deptos.show');
    Route::get('/deptos/{depto}/edit', [DeptoController::class, 'edit'])->name('deptos.edit');
    Route::put('/deptos/{depto}', [DeptoController::class, 'update'])->name('deptos.update');
    Route::get('/deptos/eliminar/{depto}', [DeptoController::class, 'eliminar'])->name('deptos.eliminar');
    Route::delete('/deptos/{depto}', [DeptoController::class, 'destroy'])->name('deptos.destroy');
});

//HORAS
Route::resource('horas', HoraController::class);

Route::middleware('auth')->group(function () {
    Route::get('/horas', [HoraController::class, 'index'])->name('horas.index');
    Route::get('/horas/create', [HoraController::class, 'create'])->name('horas.create');
    Route::post('/horas', [HoraController::class, 'store'])->name('horas.store');
    Route::get('/horas/{hora}', [HoraController::class, 'show'])->name('horas.show');
    Route::get('/horas/{hora}/edit', [HoraController::class, 'edit'])->name('horas.edit');
    Route::put('/horas/{hora}', [HoraController::class, 'update'])->name('horas.update');
    Route::get('/horas/eliminar/{hora}', [HoraController::class, 'eliminar'])->name('horas.eliminar');
    Route::delete('/horas/{hora}', [HoraController::class, 'destroy'])->name('horas.destroy');
});

//EDIFICIOS
///ruta de edifcio UNICA??
Route::resource('edificios', EdificioController::class);

Route::middleware('auth')->group(function () {
    Route::get('/edificios', [EdificioController::class, 'index'])->name('edificios.index');
    Route::get('/edificios/create', [EdificioController::class, 'create'])->name('edificios.create');
    Route::post('/edificios', [EdificioController::class, 'store'])->name('edificios.store');
    Route::get('/edificios/{edificio}', [EdificioController::class, 'show'])->name('edificios.show');
    Route::get('/edificios/{edificio}/edit', [EdificioController::class, 'edit'])->name('edificios.edit');
    Route::put('/edificios/{edificio}', [EdificioController::class, 'update'])->name('edificios.update');
    Route::get('/edificios/eliminar/{edificio}', [EdificioController::class, 'eliminar'])->name('edificios.eliminar');
    Route::delete('/edificios/{edificio}', [EdificioController::class, 'destroy'])->name('edificios.destroy');
});



//**1 LLAVE FORANEA */
//CARRERAS
// RUTA DE CARRERAS + AUTH
Route::resource('carreras', CarreraController::class);

Route::middleware('auth')->group(function () {
    Route::get('/carreras.index', [CarreraController::class, 'index'])->name('carreras.index');
    Route::get('/carreras.create', [CarreraController::class, 'create'])->name('carreras.create');
    Route::post('/carreras.store', [CarreraController::class, 'store'])->name('carreras.store');
    Route::get('/carreras.show/{carrera}', [CarreraController::class, 'show'])->name('carreras.show');
    Route::get('/carreras.edit/{carrera}', [CarreraController::class, 'edit'])->name('carreras.edit');
    Route::post('/carreras.update/{carrera}', [CarreraController::class, 'update'])->name('carreras.update');
    Route::get('/carreras/eliminar/{carrera}', [CarreraController::class, 'eliminar'])->name('carreras.eliminar');
    Route::delete('/carreras/{carrera}', [CarreraController::class, 'destroy'])->name('carreras.destroy');
});

//RETICULAS
Route::resource('reticulas', ReticulaController::class);

Route::middleware('auth')->group(function () {
    Route::get('/reticulas.index', [ReticulaController::class, 'index'])->name('reticulas.index');
    Route::get('/reticulas.create', [ReticulaController::class, 'create'])->name('reticulas.create');
    Route::post('/reticulas.store', [ReticulaController::class, 'store'])->name('reticulas.store');
    Route::get('/reticulas.show/{reticula}', [ReticulaController::class, 'show'])->name('reticulas.show');
    Route::get('/reticulas.edit/{reticula}', [ReticulaController::class, 'edit'])->name('reticulas.edit');
    Route::post('/reticulas.update/{reticula}', [ReticulaController::class, 'update'])->name('reticulas.update');
    Route::get('/reticulas/eliminar/{reticula}', [ReticulaController::class, 'eliminar'])->name('reticulas.eliminar');
    Route::delete('/reticulas/{reticula}', [ReticulaController::class, 'destroy'])->name('reticulas.destroy');
});

//MATERIAS
Route::resource('materias', MateriaController::class);

Route::middleware('auth')->group(function () {
    Route::get('/materias.index', [MateriaController::class, 'index'])->name('materias.index');
    Route::get('/materias.create', [MateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias.store', [MateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias.show/{materia}', [MateriaController::class, 'show'])->name('materias.show');
    Route::get('/materias.edit/{materia}', [MateriaController::class, 'edit'])->name('materias.edit');
    Route::post('/materias.update/{materia}', [MateriaController::class, 'update'])->name('materias.update');
    Route::get('/materias/eliminar/{materia}', [MateriaController::class, 'eliminar'])->name('materias.eliminar');
    Route::delete('/materias/{materia}', [MateriaController::class, 'destroy'])->name('materias.destroy');
});

//ALUMNOS
//RUTA DE ALUMNOS + AUTH
Route::resource('alumnos', AlumnoController::class);

Route::middleware('auth')->group(function () {
    Route::get('/catalogos/alumnos2', [AlumnoController::class, 'index'])->name('alumnos2.index');
    //Route::get('/alumnos.index', [AlumnoController::class, 'index'])->name('alumnos.index');
    Route::get('/alumnos.create', [AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('/alumnos.store', [AlumnoController::class, 'store'])->name('alumnos.store');
    Route::get('/alumnos.show/{alumno}', [AlumnoController::class, 'show'])->name('alumnos.show');
    Route::get('/alumnos.edit/{alumno}', [AlumnoController::class, 'edit'])->name('alumnos.edit');
    Route::post('/alumnos.update/{alumno}', [AlumnoController::class, 'update'])->name('alumnos.update');
    Route::get('/alumnos/eliminar/{alumno}', [AlumnoController::class, 'eliminar'])->name('alumnos.eliminar');
    Route::delete('/alumnos/{alumno}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');
});

//LUGARES
Route::resource('lugares', LugarController::class);

Route::middleware('auth')->group(function () {
    Route::get('/lugares.index', [LugarController::class, 'index'])->name('lugares.index');
    Route::get('/lugares.create', [LugarController::class, 'create'])->name('lugares.create');
    Route::post('/lugares.store', [LugarController::class, 'store'])->name('lugares.store');
    Route::get('/lugares.show/{lugar}', [LugarController::class, 'show'])->name('lugares.show');
    Route::get('/lugares.edit/{lugar}', [LugarController::class, 'edit'])->name('lugares.edit');
    Route::post('/lugares.update/{lugar}', [LugarController::class, 'update'])->name('lugares.update');
    Route::get('/lugares/eliminar/{lugar}', [LugarController::class, 'eliminar'])->name('lugares.eliminar');
    Route::delete('/lugares/{lugar}', [LugarController::class, 'destroy'])->name('lugares.destroy');
});


//**2 LLAVES FORANEAS */
//PERSONAL
Route::resource('personal', PersonalController::class);

Route::middleware('auth')->group(function () {
    Route::get('/personal.index', [PersonalController::class, 'index'])->name('personal.index');
    Route::get('/personal.create', [PersonalController::class, 'create'])->name('personal.create');
    Route::post('/personal.store', [PersonalController::class, 'store'])->name('personal.store');
    Route::get('/personal.show/{personal}', [PersonalController::class, 'show'])->name('personal.show');
    Route::get('/personal.edit/{personal}', [PersonalController::class, 'edit'])->name('personal.edit');
    Route::post('/personal.update/{personal}', [PersonalController::class, 'update'])->name('personal.update');
    Route::get('/personal/eliminar/{personal}', [PersonalController::class, 'eliminar'])->name('personal.eliminar');
    Route::delete('/personal/{personal}', [PersonalController::class, 'destroy'])->name('personal.destroy');
});


//*2 LLAVES FORANEAS  PERSONAL ID Y PLAZA ID/
//PERSONALPLAZAS
Route::resource('personalPlazas', PersonalPlazaController::class);

Route::middleware('auth')->group(function () {
    Route::get('/personalplazas.index', [PersonalPlazaController::class, 'index'])->name('personalplazas.index');
    Route::get('/personalplazas.create', [PersonalPlazaController::class, 'create'])->name('personalplazas.create');
    Route::post('/personalplazas.store', [PersonalPlazaController::class, 'store'])->name('personalplazas.store');
    Route::get('/personalplazas.show/{personalplaza}', [PersonalPlazaController::class, 'show'])->name('personalplazas.show');
    Route::get('/personalplazas.edit/{personalplaza}', [PersonalPlazaController::class, 'edit'])->name('personalplazas.edit');
    Route::post('/personalplazas.update/{personalplaza}', [PersonalPlazaController::class, 'update'])->name('personalplazas.update');

    Route::get('/personalplazas/eliminar/{personalplaza}', [PersonalPlazaController::class, 'eliminar'])->name('personalplazas.eliminar');
    Route::delete('/personalplazas/{personalplaza}', [PersonalPlazaController::class, 'destroy'])->name('personalplazas.destroy');
});





//rutas de materiasAbiertas

Route::middleware('auth')->group(function () {
    Route::get('/materiasabiertas.index', [MateriaAbiertaController::class, 'index'])->name('materiasabiertas.index');

    Route::resource('materiasabiertas', MateriaAbiertaController::class);

    Route::get('/materias-abiertas', [MateriaAbiertaController::class, 'index'])->name('materiasabiertas');
});





Route::middleware('auth')->group(function () {
    // Ruta para mostrar el índice del grupo de horarios
    Route::get('/aperturagrupo.index', [GrupoHorarioController::class, 'index'])->name('aperturagrupo.index');

    Route::get('/aperturagrupo.edit/{grupo}', [GrupoHorarioController::class, 'edit'])->name('aperturagrupo.edit');    // Rutas para las acciones CRUD de grupoHorario

    Route::resource('aperturagrupo', GrupoHorarioController::class);

    // Ruta alternativa para mostrar grupoHorarios
    Route::get('/apertura-grupo', [GrupoHorarioController::class, 'index'])->name('aperturagrupo');
});





Route::get('/horarios.index', function () {
    return view('horarios.index');
})->middleware("auth")->name("horarios.index");

Route::get('/horarios.submenuhorarios', function () {
    return view('horarios.submenuhorarios');
})->middleware("auth")->name("horarios.submenuhorarios");


//rutas de Proyectos personales

//Route::get('/proyectoPersonales', [ProyectoPersonaleController::class, 'index'])->name('proyectosPersonales.index');



Route::get('/proyectoPersonales.index', function () {
    return view('proyectoPersonales.index');
})->middleware("auth")->name("proyectoPersonales.index");

Route::get('/proyectoPersonales.submenuproyectos', function () {
    return view('proyectoPersonales.submenuproyectos');
})->middleware("auth")->name("proyectoPersonales.submenuproyectos");




Route::get('/catalogos.index', function () {
    return view('catalogos.index');
})->middleware("auth")->name("catalogos.index");

Route::get('/catalogos.submenu', function () {
    return view('catalogos.submenu');
})->middleware("auth")->name("catalogos.submenu");



//ruta principal de bienvenida.

Route::get('/', function () {
    return view('inicio');
})->name("inicio");


//ruta de apertura de materias - pantalla 2 proyecto


Route::middleware(['auth'])->group(function () {
    Route::get('/apertura_materias', function () {
        return view('apertura_materias'); // Vista para usuarios identificados
    })->name('apertura_materias');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/esquema_apertura_materias', function () {
        return view('esquema_apertura_materias'); // Vista para usuarios identificados
    })->name('esquema_apertura_materias');
});



///ruta para seleccionar el grupo
Route::middleware(['auth'])->group(function () {
    Route::get('/seleccion_grupos', function () {
        return view('seleccion_grupos'); // Vista para usuarios identificados
    })->name('seleccion_grupos');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio2', function () {
        return view('inicio2'); // Vista para usuarios identificados
    })->name('inicio2');
});

Route::get('/catalogos/otraVista', function () {
    return view('catalogos.otraVista'); // Vista de bienvenida
})->name('catalogos.bienvenida')->middleware('auth'); // Solo accesible para usuarios autenticados

Route::get('/inicio', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
