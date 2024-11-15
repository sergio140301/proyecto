<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/js/app.js'])

{{-- <style>
    /* Row */
.container .row .row{
 padding-right:284px;
 width:284px;
}

@media (min-width:768px){

 /* Column 6/12 */
 .container .container .row .col-md-6{
  width:25% !important;
 } 
 
}
</style> --}}

    <title>Inicio2</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                @include('menu2')
            </div>
        </div>

      
            <div class="row">
                <div class="col">
                    @yield('contenido4000')
                </div>
            </div> 

            <div class="row">
                <div class="col">
                    @yield('apertura_materias')
                </div>
            </div> 

            <div class="row">
                <div class="col">
                    @yield('seleccion_grupos')
                </div>
            </div> 

            <div class="row">
                <div class="col">
                    @yield('esquema_apertura_materias')
                </div>
            </div> 


            <div class="row">
                <div class="col"> 
                    @yield('contenido2')
                </div>
                 <div class="col-md-12"> 
                    @yield('bienvenida')
                </div>
            </div> 

            <div class="row">
                <div class="col">
                    @yield('contenido1')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @include('piedepagina2')
                </div>
            </div>
        </div>
    </div>

</body>

</html>
