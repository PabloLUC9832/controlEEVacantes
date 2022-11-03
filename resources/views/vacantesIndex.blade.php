<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Vacantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a23e6feb03.js"></script>
</head>
<body>
    <nav class="h-16 flex justify-end py-4 px-16">
{{--        <a href="{{ route('vacantes.index') }}" class="border border-blue-500 rounded px-4 pt-1 h-10
        bg-white text-blue-500 font-semibold mx-2">Vacantes</a>

        <a href="{{ route('crearVacante.create') }}" class="text-white rounded px-4 pt-1 h-10 bg-blue-500 font-semibold mx-2
        hover:bg-blue-600">Crear</a>--}}
    </nav>
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
        <th class="w-28 py-4 ...">Actions</th>
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
                <td class="p-3 flex justify-center">



                <form action="{{route('vacantes.destroy', $vacante->id)}}" method="POST">
                @csrf
                @method('delete')
                <button class="bg-red-500 text-white px-3 py-1 rounded-sm mx-2">
                <i class="fas fa-trash"></i></button>
                </form>


                <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-sm">
                <i class="fas fa-pen"></i></a>

              </td>
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
