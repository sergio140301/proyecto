<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .profile-container {
        max-width: 800px;
        margin: 0 auto;
        font-family: 'Poppins', sans-serif;
    }

    .profile-header {
        background: linear-gradient(135deg, #244474, #0d47a1);
        color: white;
        padding: 20px;
        border-radius: 10px 10px 0 0;
        text-align: center;
    }

    .profile-header h3 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 600;
    }

    .profile-content {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-section {
        margin-bottom: 20px;
    }

    .profile-section h4 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
        border-bottom: 2px solid #4c5fda;
        display: inline-block;
        font-weight: 500;
    }

    /* Estilo común para botones */
    .btn-custom {
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: background 0.3s;
        display: inline-block;
    }

    /* Estilo específico para el botón de Editar */
    .btn-edit {
        background-color: #1f6feb; /* Azul */
    }

    .btn-edit:hover {
        background-color: #144985;
    }

    /* Estilo específico para el botón de Eliminar */
    .btn-delete {
        background-color: #dc3545; /* Rojo */
    }

    .btn-delete:hover {
        background-color: #c82333; /* Rojo más oscuro */
    }

    /* Estilo específico para el botón de Reinscribir */
    .btn-reinscribir {
        background-color: #4caf50; /* Verde */
    }

    .btn-reinscribir:hover {
        background-color: #45a049; /* Verde más oscuro */
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
    }

    .schedule-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .schedule-table th, .schedule-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .schedule-table th {
        background-color: #1f6feb;
        color: white;
    }

    .empty-state {
        text-align: center;
        color: #555;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 10px;
        margin-top: 20px;
    }
</style>

<div class="profile-container">
    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Perfil de Alumno --}}
    @if($alumnoAuth)
        <div class="profile-header">
            <h3>Perfil de Alumno</h3>
        </div>
        <div class="profile-content">

            {{-- Mostrar el mensaje de advertencia si no hay documentación --}}
            @if(!$documentacion)
                <p class="alert alert-warning">El encargado, docente o administrador aún no sube tu documentación.</p>
            @else
                {{-- Información del Alumno --}}
                <div class="profile-section">
                    <h4>Información Personal</h4>
                    <p><strong>Nombre:</strong> {{ $alumnoAuth->nombre }} {{ $alumnoAuth->apellidop }} {{ $alumnoAuth->apellidom }}</p>
                    <p><strong>Número de Control:</strong> {{ $alumnoAuth->noctrl }}</p>
                    <p><strong>Semestre:</strong> {{ $alumnoAuth->semestre }}</p>
                </div>

                {{-- Botones Centrados --}}
                <div class="btn-container">
                    <a href="{{ route('alumnos.edit', ['alumno' => $alumnoAuth->id, 'redirect_to' => request()->fullUrl()]) }}" class="btn-custom btn-reinscribir">Actualizar Perfil</a>
                
                    <a href="{{ route('documentacions.edit', ['documentacion' => $documentacion->id, 'redirect_to' => request()->fullUrl()]) }}" class="btn-custom btn-reinscribir">Actualizar Documentos</a>
                    <a href="{{ route('documentacions.edit', ['documentacion' => $documentacion->id, 'redirect_to' => route('horario_alumnos.frm')]) }}"
                        class="btn-custom btn-reinscribir" id="reinscribir" style="display: none;">Reinscribir</a>                
                </div>

                {{-- Horarios Asignados --}}
                <div class="profile-section">
                    <h4>Horarios Asignados</h4>
                    <div class="text-end mb-2" id="asignarHorario" style="display: none;">
                        <a href="{{ route('horario_alumnos.create') }}" class="btn-custom btn-edit">Asignar Nuevo Horario</a>
                     </div>

                    <div class="text-end mb-2">
                        <a href="{{ route('horario_alumnos.pdf') }}" class="btn-custom btn-edit">Imprimir PDF</a>
                    </div>
                    @if($horarioAlumnos->isEmpty())
                        <div class="empty-state">
                            <p>No hay horarios asignados.</p>
                        </div>
                    @else
                    <table class="schedule-table">
                        <thead>
                        <tr>
                        <th>Grupo</th>
                        <th>Docente</th>
                        <th>Materia</th>
                        <th>Hora</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach ($horarioAlumnos as $horarioAlumno)
                        <tr>
                        <td>{{ $horarioAlumno->grupoHorario->grupo->grupo ?? 'Sin grupo' }}</td>
                        <td>
                                            {{ $horarioAlumno->grupoHorario->grupo->personal->nombres ?? 'Sin docente' }}
                                            {{ $horarioAlumno->grupoHorario->grupo->personal->apellidop ?? '' }}
                        </td>
                        <td>{{ $horarioAlumno->grupoHorario->grupo->materiaAbierta->materia->nombremateria ?? 'Sin materia' }}</td>
                        <td>{{ $horarioAlumno->grupoHorario->hora ?? 'Sin hora' }}</td>
                        {{--<td>{{ $diasSemana[$horarioAlumno->grupoHorario->dia] ?? 'Día no válido' }}</td>--}}
                        <td>
                        <button class="btn-custom btn-delete delete-btn" data-action="{{ route('horario_alumnos.destroy', $horarioAlumno->id) }}" data-id="{{ $horarioAlumno->id }}">
                                                Eliminar
                        </button>
                        </td>
                        </tr>
                                @endforeach
                        </tbody>
                        </table>
                    @endif
                </div>
            @endif
        </div>
    @else
        {{-- Alumno no encontrado --}}
        <div class="empty-state">
            <h4>¡Alumno no encontrado!</h4>
            <p>No hay información asociada al alumno autenticado.</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const asignarHorarioDiv = document.getElementById('asignarHorario');
        const reinscribirLink = document.getElementById('reinscribir');
 
        // Obtener el estado desde el servidor
        const updateVisibility = () => {
            fetch('{{ route('get.estado') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.estado === 'opened') {
                        asignarHorarioDiv.style.display = 'block';
                        reinscribirLink.style.display = 'block';
                    } else {
                        asignarHorarioDiv.style.display = 'none';
                        reinscribirLink.style.display = 'none';
                    }
                });
        };
 
        // Actualizar visibilidad al cargar
        updateVisibility();
    });
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Escucha clics en los botones de eliminar
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Evita el envío inmediato del formulario
            const actionUrl = this.getAttribute('data-action'); // Ruta de eliminación
            const id = this.getAttribute('data-id'); // ID del elemento

            Swal.fire({
                title: '¿Estás seguro?',
                text: `No podrás revertir esto. El horario con ID ${id} será eliminado.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Crear un formulario para enviar el DELETE
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = actionUrl;

                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    form.appendChild(csrfField);

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>