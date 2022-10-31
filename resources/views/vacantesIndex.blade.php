<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Motivos</title>
</head>
<body>
    <br>
<div class="container">
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Periodo</th>
        <th>Número de Zona</th>
        <th>Número de Dependencia</th>
        <th>Número Programa</th>
        <th>Número de Plaza</th>
        <th>Horas</th>
        <th>Número de Materia</th>
        <th>Nombre de Materia</th>
        <th>Grupo</th>
        <th>Número de Motivo</th>
        <th>Tipo de Asignación</th>
        <th>Número Personal Docente</th>
        <th>Plan</th>
        <th>Fecha Apertura</th>
        <th>Fecha Cierre</th>
        <th>Observaciones</th>
        <th>Fecha Renuncia</th>
        <th>Banca de Horas Disponible</th>
    </tr>
    </thead>

    <tbody>
        @foreach($vacantes as $vacante)
            <tr>
                <td>{{$vacante->id}}</td>
                <td>{{$vacante->periodo}}</td>
                <td>{{$vacante->numZona}}</td>
                <td>{{$vacante->numDependencia}}</td>
                <td>{{$vacante->numPrograma}}</td>
                <td>{{$vacante->numPlaza}}</td>
                <td>{{$vacante->numHoras}}</td>
                <td>{{$vacante->numMateria}}</td>
                <td>{{$vacante->nombreMateria}}</td>
                <td>{{$vacante->grupo}}</td>
                <td>{{$vacante->numMotivo}}</td>
                <td>{{$vacante->tipoAsignacion}}</td>
                <td>{{$vacante->numPersonalDocente}}</td>
                <td>{{$vacante->plan}}</td>
                <td>{{$vacante->fechaApertura}}</td>
                <td>{{$vacante->fechaCierre}}</td>
                <td>{{$vacante->observaciones}}</td>
                <td>{{$vacante->fechaRenuncia}}</td>
                <td>{{$vacante->bancoHorasDisponible}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<br>
<h1>combobox</h1>

<form>
    <div class="form-group">
        <h2>Selecciona el motivo</h2>
        <select class="form-control">
            @foreach($listaVacantes as $vacante)
            <option>{{$vacante->nombre}}</option>
            @endforeach
        </select>
    </div>
</form>

</div>
    
</body>
</html>
