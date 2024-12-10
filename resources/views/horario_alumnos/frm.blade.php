@extends("menu3")

@section("contenido2")
<div class="container mt-5" style="background-color: #f8f9fa; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Mostrar errores -->
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>

            <!-- Título dinámico -->
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #343a40; font-weight: 700;">
                @if ($accion == 'C')
                    Selección de Materias y Horarios
                @else
                    Modificación de Horario
                @endif
            </h2>

            <!-- Información del alumno -->
            <div class="mb-4">
                <h5 class="fw-bold" style="font-family: 'Roboto', sans-serif;">{{ $alumnoAuth->nombre }} {{ $alumnoAuth->apellidop }} {{ $alumnoAuth->apellidom }}</h5>
                <p class="text-muted" style="font-family: 'Roboto', sans-serif;">Semestre: {{ $alumnoAuth->semestre }}</p>
            </div>

            <!-- Inicio del formulario -->
            <form action="{{ $accion == 'C' ? route('horario_alumnos.store') : route('horario_alumnos.update', $horarioAlumno->id) }}" method="POST">
                @csrf
                @if ($accion == 'E') @method('PUT') @endif

                <!-- Tabla de materias disponibles -->
                <div class="table-responsive mb-4">
                    <table class="table table-hover table-bordered" style="border-radius: 10px; overflow: hidden; background-color: #ffffff; color: #495057;">
                        <thead style="background-color: #28a745; color: white;">
                            <tr>
                                <th>Seleccionar</th>
                                <th>Grupo</th>
                                <th>Semestre</th>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Docente</th>
                                <th>Salón</th>
                                <th>Días</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupoHorariosAgrupados as $grupoHorario)
                                @if ($grupoHorario['semestre'] == $alumnoAuth->semestre)
                                    @php
                                        $yaSeleccionado = in_array($grupoHorario['materia'], $horariosAsignados);
                                    @endphp
                                    @if (!$yaSeleccionado)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="grupo_horario_id[]" 
                                                       value="{{ $grupoHorario['id'] }}"
                                                       data-credito="{{ $grupoHorario['credito'] }}" 
                                                       class="form-check-input">
                                            </td>
                                            <td>{{ $grupoHorario['grupo'] }}</td>
                                            <td>{{ $grupoHorario['semestre'] }}</td>
                                            <td>{{ $grupoHorario['materia'] }}</td>
                                            <td>{{ $grupoHorario['credito'] }}</td>
                                            <td>{{ $grupoHorario['docente'] }}</td>
                                            <td>{{ $grupoHorario['salon'] }}</td>
                                            <td>{{ $grupoHorario['dias'] }}</td>
                                            <td>{{ $grupoHorario['hora'] }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                <div class="mb-4">
                    <h5>Total de Créditos Seleccionados: <span id="total-credito">0</span></h5>
                </div>
                
                <!-- Botones de acción -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4 py-2" style="border-radius: 50px; transition: background-color 0.3s ease;">
                        {{ $accion == 'C' ? 'Registrar Horario' : 'Actualizar Horario' }}
                    </button>
                    <a href="{{ route('horario_alumnos.index') }}" class="btn btn-secondary ms-2 btn-lg px-4 py-2" style="border-radius: 50px; transition: background-color 0.3s ease;">
                        Regresar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Agregar animación de hover para botones -->
<style>
    /* Animaciones de hover */
    .btn {
        transition: transform 0.2s ease, background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #0056b3 !important;
        transform: translateY(-4px);
    }
    .table-hover tbody tr:hover {
        background-color: #28a745 !important;
        color: white;
        transform: scale(1.02);
    }
    .table-hover tbody tr {
        transition: transform 0.2s ease;
    }
    /* Agregar color más claro a las celdas de la tabla */
    th, td {
        padding: 12px;
        text-align: center;
    }
</style>

<!-- Fuentes -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="grupo_horario_id[]"]');
        const totalCreditosElement = document.getElementById('total-credito');
        const creditosMaximos = 24;

        let horariosSeleccionados = []; // Lista para almacenar los días y horas seleccionadas

        const calcularTotal = () => {
            let total = 0;

            // Calcular el total de créditos seleccionados
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseInt(checkbox.getAttribute('data-credito'));
                }
            });

            // Mostrar el total
            totalCreditosElement.textContent = total;

            // Controlar habilitación/deshabilitación de checkboxes
            checkboxes.forEach(checkbox => {
                if (!checkbox.checked && total >= creditosMaximos) {
                    checkbox.disabled = true; // Deshabilitar si se alcanza el límite
                } else {
                    checkbox.disabled = false; // Habilitar si el límite no se excede
                }
            });
        };

        const validarConflicto = (nuevoHorario) => {
            // Compara el nuevo horario con los ya seleccionados
            for (const horario of horariosSeleccionados) {
                if (
                    horario.hora === nuevoHorario.hora && // Coincidencia de hora
                    horario.dias.some(dia => nuevoHorario.dias.includes(dia)) // Coincidencia en algún día
                ) {
                    return true; // Hay conflicto
                }
            }
            return false; // No hay conflicto
        };

        // Agregar evento a cada checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function (e) {
                const diasTexto = this.closest('tr').querySelector('td:nth-child(8)').innerText.trim(); // Días
                const hora = this.closest('tr').querySelector('td:nth-child(9)').innerText.trim(); // Hora
                const dias = diasTexto.split(',').map(dia => dia.trim()); // Convertir días en un array

                const nuevoHorario = { dias, hora };

                let total = 0;

                // Calcular el total de créditos seleccionados
                checkboxes.forEach(chk => {
                    if (chk.checked) {
                        total += parseInt(chk.getAttribute('data-credito'));
                    }
                });

                if (this.checked) {
                    // Validar si hay conflicto de horario
                    if (validarConflicto(nuevoHorario)) {
                        Swal.fire({
                            title: 'Conflicto de Horario',
                            text: `El horario seleccionado (${diasTexto}, ${hora}) entra en conflicto con otro horario ya seleccionado.`,
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Entendido'
                        });

                        e.preventDefault(); // Impedir el cambio
                        this.checked = false; // Asegurarse de que no quede marcado
                        return;
                    }

                    // Validar si excede el límite de créditos
                    if (total + parseInt(this.getAttribute('data-credito')) > creditosMaximos) {
                        Swal.fire({
                            title: 'Límite de Créditos Alcanzado',
                            text: `Ya has seleccionado ${total} créditos. El máximo permitido es ${creditosMaximos}. Por favor, desmarca alguna materia para continuar.`,
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Entendido'
                        });

                        e.preventDefault(); // Impedir el cambio
                        this.checked = false; // Asegurarse de que no quede marcado
                        return;
                    }

                    // Agregar el nuevo horario a los seleccionados
                    horariosSeleccionados.push(nuevoHorario);
                } else {
                    // Remover el horario al desmarcar
                    horariosSeleccionados = horariosSeleccionados.filter(horario => 
                        horario.hora !== nuevoHorario.hora ||
                        !horario.dias.every(dia => nuevoHorario.dias.includes(dia))
                    );
                }

                calcularTotal(); // Recalcular el total de créditos
            });
        });
    });
</script>

@endsection
