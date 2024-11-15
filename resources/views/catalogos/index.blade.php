<style>
    .custom-menu {
        background-color: #f8f9fa; 
        padding: 15px; 
        border-right: 1px solid #dee2e6; 
    }

    .custom-table {
        margin-top: 20px; 
        
    }
</style>
@extends('inicio2') 

@section('contenido2')
    <div class="container mt-4"> 
        <div class="row">
            <div class="col-md-4"> 
                @include('catalogos.submenu') 
            </div>
            <div class="col-md-8"> 
                @include('catalogos.alumnos2.tablahtml') 
            </div>
        </div>
    </div>
@endsection
