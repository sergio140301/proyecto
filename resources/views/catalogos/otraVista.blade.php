@extends('inicio2')

@section('bienvenida')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>

<body style="background-color: #000000">

       <div>
           <section class="d-flex justify-content-center align-items-center"
               style="background-image: url('./img/fondo2.jpg'); background-size: cover; background-position: center; padding: 50px; color: white;">
               <div class="text-center">
                   <img src=" {{ asset('img\logo-tec.png') }}" width="100px">
                   <article>
                       <h2>BIENVENIDOS <br>
                           A HORARIOS 2024
                       </h2>
                       <a href="{{ route('apertura_materias') }}" target="_blank">
                        <h1>INICIAR LA APERTURA DE MATERIAS</h1>
                    </a><br>
                    
                    <a href="{{ route('materiasabiertas') }}">
                        <h1>ESQUEMA DEL PROFE APERTURA DE MATERIAS</h1>
                    </a><br>

                       <p> Nuestra visión es que los momentos de nuestros alumnos <strong>sean</strong> <br>
                           <strong>inolvidables</strong> y que nuestras clases cuenten tengan esa calidad <br>
                           que buscamos en nuestras vidas.
                       </p>

                       <p>Es un honor ser un Oso del Tecnm, ¿estas listo? <br>
                           ven <strong>somos tu mejor opcion.</strong></p>

                       <p>En 100 años de servicio en la educacion profesional <br>
                           nos complace seguir siendo su opcion de confianza <br>
                           <strong>ofreciendo calidad,confianza, resilencia.</strong>
                       </p>
                   </article>
               </div>
           </section>
       </div>

       <div style="background-image: url('./img/fondo4-portafolio.jpg'); background-size: cover;">
           <section>
               <h2 class="text-center text-white">CATALOGO DE MAESTROS</h2>
               <p class="text-center text-white">ESTOS SON NUESTROS MEJORES DOCENTES</p>
           </section>
           <div class="row justify-content-around">
               <article class="col-md-2">
                   <div class="card">
                       <img src="{{ asset('img\docente-1.jpg') }}" class="card-img-top"
                           alt="...">
                       <div class="card-body">
                           <h3 class="card-title">ING. ARMANDO CAPETILLO</h3>
                           <p class="card-text">DESDE 1980 A LA FECHA</p>
                       </div>
                   </div>
               </article>
               <article class="col-md-2">
                   <div class="card">
                       <img src="{{ asset('img\docente-2.jpg') }}" class="card-img-top"
                           alt="...">
                       <div class="card-body">
                           <h3 class="card-title">ING. NAPOLEON BUENA VISTA</h3>
                           <p class="card-text">DESDE 1975 A LA FECHA</p>
                       </div>
                   </div>
               </article>
               <article class="col-md-2">
                   <div class="card">
                       <img src="{{ asset('img\docente-4.jpg') }}" class="card-img-top"
                           alt="...">
                       <div class="card-body">
                           <h3 class="card-title">MAYL. RUS CATERPILLAR</h3>
                           <p class="card-text">DESDE 2018 A LA FECHA</p>
                       </div>
                   </div>
               </article>
               <article class="col-md-2">
                   <div class="card">
                       <img src="{{ asset('img\docente-3.jpg') }}" class="card-img-top"
                           alt="...">
                       <div class="card-body">
                           <h3 class="card-title">ING. JUAN RAMON</h3>
                           <p class="card-text">DESDE 1999 A LA FECHA</p>
                       </div>
                   </div>
               </article>
               <article class="col-md-2">
                   <div class="card">
                       <img src="{{ asset('img\docente-5.jpg') }}" class="card-img-top"
                           alt="...">
                       <div class="card-body">
                           <h3 class="card-title">ING. ROSA</h3>
                           <p class="card-text">DESDE 2020 A LA FECHA</p>
                       </div>
                   </div>
               </article>
           </div>
       </div>

       <div style="background-image: url('./img/fondo3-ubicacion.jpg'); background-size: cover; padding: 5%;">
           <section>
               <article style="color: white;">
                   <h2 style="text-align: center;">TECNM: EL CÉNIT<br>
                       DE PIEDRAS NEGRAS
                   </h2>
                   <p style="text-align: center;">UNA NUEVA EXPERIENCIA EN LA EDUCACION <strong>CARGADA DE
                           NOVEDADES</strong> Y CONTENIDO,<br>
                       QUE EMPIEZA A SER TENDENCIA EN LA CIUDAD, CON DINÁMICAS, COLABORACIONES,<br>
                       <strong>PRECIOS INCREIBLES Y MUCHO MÁS</strong> EN LO QUE SERÁ UNA EXPERIENCIA ÚNICA A LA <br>
                       <strong>CREACIÓN</strong> DE NUEVOS INGENIEROS.
                   </p>
               </article>
           </section>
       </div>

       <div style="background-image: url('./img/fondo-muy-vacio.png'); background-size: cover; padding: 5%;">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-md-6">
                       <section>
                           <article style="color: white;">
                               <h2>DISFRUTA DE LAS MEJORES <br>
                                   CARRERAS DE LA CIUDAD</h2>
                               <p>ESTE AÑO 2024 FORMA PARTE DE NUESTRA <br>
                                   <strong>ESCUELA</strong> LLEVA A TU HOGAR LOS MEJORES <br>
                                   CONOCIMIENTOS Y COMPARTE <strong>TU EXPERIENCIA CON <br>
                                       LOS QUE TE RODEAN</strong> HAS ALGUNA RECOMENDACION <br>
                                   PARA MEJORAR EN NUESTRO SERVICIOS.
                               </p>

                           </article>
                       </section>
                   </div>
                   <div class="col-md-6">
                       <section>
                           <h2 class="text-white">Director del plantel</h2>
                           <div class="card text-white bg-light mb-3">
                               <div class="card-body">
                                   <h5 class="card-title text-dark"> Dr. Gustavo Emilio Rojo Velázquez</h5>
                                   <strong>
                                       <p class="card-text" style="color: cornflowerblue;"></p>
                                   </strong>
                                   <p class="card-text text-dark"><small class="text-muted">Desde 2024/01/21</small>
                                   </p>
                               </div>
                           </div>
                       </section>
                   </div>
               </div>
           </div>
       </div>
</html>

@endsection