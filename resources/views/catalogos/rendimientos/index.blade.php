@extends("inicio2")

@section("contenido2")
<html>
<head>
    <title>Formato de Rendimiento Académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h1, .header h2, .header h3 {
            margin: 0;
        }
        .table-bordered {
            border: 1px solid black;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid black;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 30%;
            text-align: center;
        }
        .signature div hr {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INSTITUTO TECNOLOGICO DE PIEDRAS NEGRAS</h1>
        <h2>SUBDIRECCION ACADEMICA</h2>
        <h3>DEPARTAMENTO DE DESARROLLO ACADEMICO</h3>
        <h3>PROGRAMA INSTITUCIONAL DE TUTORIAS</h3>
    </div>
    <div>
        <p><strong>CARRERA:</strong> INGENIERIA EN SISTEMAS COMPUTACIONALES <strong>SEGUIMIENTO No.</strong> <span>1</span> <span>2</span> <span>X</span></p>
        <p><strong>FECHA:</strong> <u>1 DE DICIEMBRE DE 2023</u> <strong>MARCA X</strong></p>
        <h4>FORMATO DE RENDIMIENTO ACADEMICO</h4>
        <p><strong>Nombre del tutorado:</strong> <u>SERGIO ABRAHAM VALÉS ESCAMILLA</u> <strong>No. de Control</strong> <u>18430283</u></p>
        <p><strong>Nombre del tutor:</strong> <u>Ing. Antonio Chavez Soto</u></p>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Materia</th>
                <th>Maestro</th>
                <th>Temas evaluados</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Inteligencia Artificial</td>
                <td>López Ramírez Tomas</td>
                <td>4</td>
                <td>P</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Programación Web II</td>
                <td>Chávez Soto Antonio</td>
                <td>3</td>
                <td>R</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Programación Móvil Multiplataformas</td>
                <td>Rodriguez Cervantes Rogelio Cesar</td>
                <td>4</td>
                <td>P</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Residencias</td>
                <td>López Ramírez Tomas</td>
                <td>3</td>
                <td>A</td>
            </tr>
            <tr>
                <td>5</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>7</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p><strong>Resultado:</strong> A = Acreditado &nbsp;&nbsp; NA = No acreditado &nbsp;&nbsp; P = Pendiente de calificación</p>
    <div class="row">
        <div class="col-6">
            <p><strong>Materia:</strong></p>
            <p><strong>Problemática:</strong></p>
            <p><strong>Requiere asesoría</strong> <br> Si ______ No ______</p>
        </div>
        <div class="col-6">
            <p><strong>Se canalizó a:</strong></p>
            <p>Asesor:____________________ <br> Lugar:____________________ <br> Fecha:____________________ <br> Horario:____________________</p>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p><strong>Materia:</strong></p>
            <p><strong>Problemática:</strong></p>
            <p><strong>Requiere asesoría</strong> <br> Si ______ No ______</p>
        </div>
        <div class="col-6">
            <p><strong>Se canalizó a:</strong></p>
            <p>Asesor:____________________ <br> Lugar:____________________ <br> Fecha:____________________ <br> Horario:____________________</p>
        </div>
    </div>
    <p><strong>Observaciones</strong></p>
    <div class="signature">
        <div>
            <hr>
            <p>TUTORADO</p>
        </div>
        <div>
            <hr>
            <p>TUTOR</p>
        </div>
        <div>
            <hr>
            <p>MAYL HILDA PATRICIA BELTRÁN HERNÁNDEZ <br> COORDINADORA DE TUTORIAS DEL DEPTO. ACADEMICO</p>
        </div>
    </div>
    <div>
      
    </div>

</body>
</html>
@endsection