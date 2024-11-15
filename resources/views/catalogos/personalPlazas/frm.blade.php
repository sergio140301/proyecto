@extends('inicio2')

@section('contenido1')
    @include('catalogos.personalplazas.tablahtml') 
@endsection

@section('contenido4000')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        @if ($accion == 'crear')
                            Insertar nuevo Personal Plaza
                        @elseif ($accion == 'actualizar')
                            Actualizar Personal Plaza
                        @elseif ($accion == 'ver')
                            Ver Personal Plaza
                        @endif
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" 
                        action="{{ $accion == 'crear' ? route('personalplazas.store') : route('personalplazas.update', $personalplaza->id) }}">
                        @csrf
                        @if ($accion == 'actualizar')
                            @method('PUT')
                        @endif
                        @if ($accion == 'eliminar')
                            @method('DELETE')
                        @endif

                        <div class="mb-3">
                            <label for="tipoNombramiento" class="form-label">Tipo de Nombramiento</label>
                            <input type="text" name="tipoNombramiento" class="form-control" id="tipoNombramiento"
                                   value="{{ old('tipoNombramiento', $personalplaza->tipoNombramiento ?? '') }}" {{$desabilitado}}>
                            @error('tipoNombramiento')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el tipo de nombramiento: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Ingrese el tipo de nombramiento (Ejemplo: Permanente, Temporal)</div>
                        </div>

                        <div class="mb-3">
                            <label for="personal_id" class="form-label">Personal</label>
                            <select name="personal_id" id="personal_id" class="form-control" {{$desabilitado}}>
                                <option value="" disabled selected>Seleccione un personal</option>
                                @foreach ($personals as $person)
                                    <option value="{{ $person->id }}" 
                                        {{ (old('personal_id', $personalplaza->personal_id ?? '') == $person->id) ? 'selected' : '' }}>
                                        {{ $person->nombres }} {{ $person->apellidop }} {{ $person->apellidom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('personal_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la selección de personal: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Seleccione el personal asignado a esta plaza</div>
                        </div>

                        <div class="mb-3">
                            <label for="plaza_id" class="form-label">Plaza</label>
                            <select name="plaza_id" id="plaza_id" class="form-control" {{$desabilitado}}>
                                <option value="" disabled selected>Seleccione una plaza</option>
                                @foreach ($plazas as $plaza)
                                    <option value="{{ $plaza->id }}" 
                                        {{ (old('plaza_id', $personalplaza->plaza_id ?? '') == $plaza->id) ? 'selected' : '' }}>
                                        {{ $plaza->nombreplaza }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plaza_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la selección de plaza: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Seleccione la plaza asignada a esta persona</div>
                        </div>

                        @if ($accion != 'ver')
                            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                        @endif
                    </form>

                    @if ($accion == 'ver')
                        <a href="{{ route('personalplazas.index') }}" class="btn btn-primary">Regresar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
