<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')  
    <title>Editar Vacante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a23e6feb03.js"></script>
</head>
<body>
    <nav class="h-16 flex justify-end py-4 px-16">
        @csrf
        @method("put")
        <a href="{{ route('vacantes.update', $vacante->id) }}" class="text-white rounded px-4 pt-1 h-10 bg-blue-500 font-semibold mx-2
        hover:bg-blue-600">Crear</a>
    </nav>

    <section>
    <form action="{{ route('crearVacante.store') }}" method="POST" class="bg-white wg-2/3 p-4 border-gray-100 shadow-xl rounded-lg">
        <h2 class="text-2xl text-center py-4 mb-4 font-semibold">Editar Vacante
            {{$vacante->id}}
        </h2>
        @csrf

        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Periodo" 
        name="periodo" type="text" value="{{$vacante->periodo}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de zona" 
        name="numZona" type="text" value="{{$vacante->numZona}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de dependencia" 
        name="numDependencia" type="text" value="{{$vacante->numDependencia}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de área" 
        name="numArea" type="text" value="{{$vacante->numArea}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de programa" 
        name="numPrograma" type="text" value="{{$vacante->numPrograma}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de plaza" 
        name="numPlaza" type="text" value="{{$vacante->numPlaza}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de horas" 
        name="numHoras" type="text" value="{{$vacante->numHoras}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número de materia" 
        name="numMateria" type="text" value="{{$vacante->numMateria}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Nombre de la materia" 
        name="nombreMateria" type="text" value="{{$vacante->nombreMateria}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="grupo" 
        name="grupo" type="text" value="{{$vacante->grupo}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Número del motivo" 
        name="numMotivo" type="text" value="{{$vacante->numMotivo}}">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Tipo de Asignación" 
        name="tipoAsignación" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Numero del personal docente" 
        name="numPersonalDocente" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Plan" 
        name="plan" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Fecha de apertura" 
        name="fechaApertura" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Fecha de cierre" 
        name="fechaCierre" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Observaciones" 
        name="observaciones" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Fecha de renuncia" 
        name="fechaRenuncia" type="text">
        <input class="my-2 w-full bg-gray-200 p-2 text-lg rounded placeholder-gray-900" placeholder="Banco de horas disponible" 
        name="bancoHorasDisponible" type="text">

        <button type="submit" class="my-3 wg-full bg-green-500 p-2 font-semibold rounded text-white
        hover:bg-green-600">Guardar vacante</button>
    </form>
    </div>
    

</body>
</html>