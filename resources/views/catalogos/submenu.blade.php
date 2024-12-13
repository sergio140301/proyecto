@extends('inicio2')

@section('contenido2')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="fw-bold mb-4">Selecciona uno</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Grupo18283 -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Grupo18283</h5>
                            <p class="card-text">Selecciona el grupo para ver más detalles.</p>
                            <a href="{{ route('grupos18283.index') }}" class="btn btn-primary">Ver grupo18283</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

                <!-- Grupos Horarios -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Grupos Horarios</h5>
                            <p class="card-text">Selecciona el grupo horario para más detalles.</p>
                            <a href="{{ route('gruposhorarios18283.index') }}" class="btn btn-primary">Ver Grupos Horarios</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

                <!-- Periodos -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Periodos</h5>
                            <p class="card-text">Accede a los periodos para más información.</p>
                            <a href="{{ route('periodos.index') }}" class="btn btn-primary">Ver Periodos</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

                <!-- Plazas -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Plazas</h5>
                            <p class="card-text">Explora las plazas disponibles.</p>
                            <a href="{{ route('plazas.index') }}" class="btn btn-primary">Ver Plazas</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">1</span>
                        </div>
                    </div>
                </div>

                <!-- Puestos -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Puestos</h5>
                            <p class="card-text">Accede a los puestos disponibles.</p>
                            <a href="{{ route('puestos.index') }}" class="btn btn-primary">Ver Puestos</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">4</span>
                        </div>
                    </div>
                </div>

                <!-- Deptos -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Deptos</h5>
                            <p class="card-text">Consulta los departamentos.</p>
                            <a href="{{ route('deptos.index') }}" class="btn btn-primary">Ver Departamentos</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">12</span>
                        </div>
                    </div>
                </div>

                <!-- Carreras -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Carreras</h5>
                            <p class="card-text">Explora las carreras disponibles.</p>
                            <a href="{{ route('carreras.index') }}" class="btn btn-primary">Ver Carreras</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">16</span>
                        </div>
                    </div>
                </div>

                <!-- Reticulas -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Reticulas</h5>
                            <p class="card-text">Consulta las retículas.</p>
                            <a href="{{ route('reticulas.index') }}" class="btn btn-primary">Ver Retículas</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">3</span>
                        </div>
                    </div>
                </div>

                <!-- Materias -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Materias</h5>
                            <p class="card-text">Accede a las materias disponibles.</p>
                            <a href="{{ route('materias.index') }}" class="btn btn-primary">Ver Materias</a>
                            <span class="badge text-bg-danger rounded-pill mt-2">5</span>
                        </div>
                    </div>
                </div>

                <!-- Alumnos -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Alumnos</h5>
                            <p class="card-text">Consulta los alumnos registrados.</p>
                            <a href="{{ route('alumnos.index') }}" class="btn btn-primary">Ver Alumnos</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">12</span>
                        </div>
                    </div>
                </div>

                <!-- Personal -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Personal</h5>
                            <p class="card-text">Accede a la información del personal.</p>
                            <a href="{{ route('personal.index') }}" class="btn btn-warning">Ver Personal</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

                <!-- Edificios -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Edificios</h5>
                            <p class="card-text">Consulta los edificios disponibles.</p>
                            <a href="{{ route('edificios.index') }}" class="btn btn-warning">Ver Edificios</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">8</span>
                        </div>
                    </div>
                </div>

                <!-- Lugares -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Lugares</h5>
                            <p class="card-text">Accede a la información de lugares.</p>
                            <a href="{{ route('lugares.index') }}" class="btn btn-warning">Ver Lugares</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

                <!-- Horas -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Horas</h5>
                            <p class="card-text">Consulta las horas disponibles.</p>
                            <a href="{{ route('horas.index') }}" class="btn btn-warning">Ver Horas</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

                <!-- Personal Plazas -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Personal Plazas</h5>
                            <p class="card-text">Consulta la información sobre personal plazas.</p>
                            <a href="{{ route('personalplazas.index') }}" class="btn btn-warning">Ver Personal Plazas</a>
                            <span class="badge text-bg-primary rounded-pill mt-2">10</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
