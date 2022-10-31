<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')  
    <title>Crear Vacante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a23e6feb03.js"></script>
</head>
<body>
    <div class="nav">
        <a href="{{ route('vacantes.index') }}" class="border border-blue-500 rounded px-4 pt-1 h-10
        bg-white text-blue-500 font-semibold mx-2">Vacantes</a>

        <a href="{{ route('crearVacante.create') }}" class="text-white rounded px-4 pt-1 h-10 bg-azul-secundario font-semibold mx-2
        hover:bg-azul-terciario">Crear</a>
</div>

    <div>
    <form action="{{ route('crearVacante.store') }}" method="POST">
        <h2 class="text-2xl text-center py-4 mb-4 font-semibold">Crear Vacante</h2>
        <h3 class="text-2 text-center py-4 mb-4">Por favor ingresa los siguientes datos:</h3>
        @csrf
        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Periodo:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Ingresa el periodo" name="periodo" type="text">
        
        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de zona:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Ingresa el número de zona" 
        name="numZona" type="number">
        
        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de dependencia:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número de dependencia" 
        name="numDependencia" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de área:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número de área" 
        name="numArea" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de programa:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número de programa" 
        name="numPrograma" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de plaza:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número de plaza" 
        name="numPlaza" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de horas:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número de horas" 
        name="numHoras" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número de materia:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número de materia" 
        name="numMateria" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Nombre de la materia:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Nombre de la materia" 
        name="nombreMateria" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Grupo:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="grupo" 
        name="grupo" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número del motivo:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Número del motivo" 
        name="numMotivo" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Tipo de asignación:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Tipo de Asignación" 
        name="tipoAsignación" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Número personal del docente:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Numero del personal docente" 
        name="numPersonalDocente" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Plan:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Plan" 
        name="plan" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Fecha de apertura:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Fecha de apertura" 
        name="fechaApertura" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Fecha de cierre:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Fecha de cierre" 
        name="fechaCierre" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Observaciones:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Observaciones" 
        name="observaciones" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Fecha de renuncia:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Fecha de renuncia" 
        name="fechaRenuncia" type="text">

        <label class="mb-2 text-md font-medium text-gray-900 place-self-">Banco de horas disponible:</label>
        <input class="my-2 w-1/3  p-2 text-md rounded-lg placeholder-gray-900 focus:border-azul-secundario" placeholder="Banco de horas disponible" 
        name="bancoHorasDisponible" type="text">

        <button type="submit" class="my-3 wg-full bg-azul-secundario p-2 font-semibold rounded text-white
        hover:bg-azul-terciario">Guardar vacante</button>
    </form>
    </div>
    

</body>
</html>