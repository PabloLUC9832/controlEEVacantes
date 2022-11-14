<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de EE vacantes</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('node_modules/flowbite/dist/flowbite.js')
    @livewireStyles
</head>
<body>

<div class="fondo">
    <!--Menu-->
    @livewire('navigation-menu')

    <div class="p-6 md:mx-10 md:my-5 md:w-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white ">Datos de la dependencia</h5>

        <div class=" grid grid-cols-2">

            <p class="grid-cols-1 mb-3 font-normal text-gray-700 dark:text-gray-400">N° de área <span class="font-bold">3</span> </p>
            <p class="grid-cols-1 mb-3 font-normal text-gray-700 dark:text-gray-400">Nombre de área <span class="font-bold">Económico Administrativa </span> </p>
            <p class="grid-cols-1 mb-3 font-normal text-gray-700 dark:text-gray-400">N° de dependencia <span class="font-bold"> {{$user->dependencia}} </span> </p>
            <p class="grid-cols-1 mb-3 font-normal text-gray-700 dark:text-gray-400">Nombre de la dependencia  <span class="font-bold"> {{$nombreDependencia}} </span> </p>
            <p class="grid-cols-1 mb-3 font-normal text-gray-700 dark:text-gray-400">N° de zona <span class="font-bold"> {{$user->zona}} </span> </p>
            <p class="grid-cols-1 mb-3 font-normal text-gray-700 dark:text-gray-400">Nombre de la zona <span class="font-bold"> {{$nombreZona}} </span> </p>

        </div>

    </div>


    <div class="overflow-x-auto relative shadow-md sm:rounded-lg md:mt-10 md:mx-10 md:my-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Programa
                </th>
                <th scope="col" class="py-3 px-6">
                    Experiencia Educativa
                </th>
                <th scope="col" class="py-3 px-6">
                    Horas
                </th>
                <th scope="col" class="py-3 px-6">
                    Grupo
                </th>
                <th scope="col" class="py-3 px-6">
                    Plan
                </th>
                <th scope="col" class="py-3 px-6">
                    Plaza
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Editar</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Eliminar</span>
                </th>
            </tr>
            </thead>
            <tbody>

            @if(count($vacantes)<=0)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="py-4 px-6">
                        No se han encontrado vacantes
                    </td>
                </tr>
            @else
                @foreach($vacantes as $vacante)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$vacante->numPrograma}}
                    </th>

                    <td class="py-4 px-6">
                        {{$vacante->nombreMateria}}
                    </td>

                    <td class="py-4 px-6">
                        {{$vacante->numHoras}}
                    </td>
                    <td class="py-4 px-6">
                        {{$vacante->grupo}}
                    </td>

                    <td class="py-4 px-6">
                        {{$vacante->plan}}
                    </td>

                    <td class="py-4 px-6">
                        {{$vacante->numPlaza}}
                    </td>

                    <td class="py-4 px-6 text-right">
                        <a href="{{route('vacante.edit',$vacante->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                    </td>

                    <td class="py-4 px-6 text-right">
                        <button type="button"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                data-modal-toggle="delete-modal{{$vacante->id}}">Eliminar</button>
                    </td>

                </tr>
                @include('vacante.modalConfirmacionEliminar')
               @endforeach
            @endif
            </tbody>
        </table>
    </div>


</div>

</body>
</html>
