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
    <!-- <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('node_modules/flowbite/dist/flowbite.js')
    @livewireStyles
</head>
<body>

<div class="fondo">
    <!--Menu-->
    @livewire('navigation-menu')

    <div class="flex sm:rounded-lg md:mt-5 md:mx-10 md:my-0">
        <div class="w-3/4">
            <p class="text-2xl font-bold">Lista de Experiencias Educativas Vacantes</p>
        </div>
        <div class="w-1/4 flex flex-col items-end">
            <a href="{{ route('vacante.create') }}" class="text-white bg-azul-royal hover:bg-azul-royal-hover focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Añadir Nueva</a>
        </div>
    </div>

    <div class="flex sm:rounded-lg md:mt-5 md:mx-10 md:my-0">
    @include('vacante.filterZonaDependenciaPrograma')
    </div>

    {{--<form action="{{route('vacante.index')}}" method="GET" value="{{$search}}">--}}
    <div class="flex sm:rounded-lg md:mt-5 md:mx-10 md:my-10">

        <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Ver<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

        <form id="radioA" action="{{route('vacante.index')}}" method="GET" value="{{$radioButton}}">

            <div id="dropdownBgHover" class="hidden z-10 w-48 bg-white rounded shadow dark:bg-gray-700">

                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">

                    <li>
                        <div class="flex items-center">

                            <input id="toda" type="radio" value="toda" name="tipoV" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="toda" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Todas</label>

                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <input id="vacante" type="radio" value="vacante" name="tipoV" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="vacante" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vacantes</label>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <input id="noVacante" type="radio" value="noVacante" name="tipoV" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="noVacante" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No Vacantes</label>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <input id="vacanteCerrada" type="radio" value="vacanteCerrada" name="tipoV" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="vacanteCerrada" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vacantes Cerradas</label>
                        </div>
                    </li>

                </ul>

            </div>

        </form>

        <form action="{{route('vacante.index')}}" method="GET" value="{{$search}}">

            <div class="relative w-full">

                <input type="search" id="search-dropdown" class="block p-2.5 w-[80rem] z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingresa tu búsqueda. Para volver a ver la lista completa solo presiona nuevamente el botón de Buscar o la tecla Enter." name="search">

                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Buscar</span>
                </button>

            </div>

        </form>

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
                    Docente
                </th>
                <th scope="col" class="py-3 px-6">
                    Archivo
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Ver Información</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Editar</span>
                </th>

                @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )

                    <th scope="col" class="py-3 px-6">
                        <span class="sr-only">Eliminar</span>
                    </th>

                @endif
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
                            {{$vacante->numPrograma}} -
                            {{DB::table('zona__dependencia__programas')->where('clave_programa','=',$vacante->numPrograma)->value('nombre_programa') }}
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

                        <td class="py-4 px-6">
                            {{$vacante->nombreDocente}}
                        </td>

                        <td class="py-4 px-6">
                            {{--{{$vacante->archivo}}
                            <p class="truncate text-sm text-gray-700 dark:text-black-400">Documento: <a target="_blank" href="https://filesdgaaea.blob.core.windows.net/files/{{$vacante->archivo}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{$vacante->archivo}}</a> </p>--}}

                            @if($vacante->archivo != null)

                                <a target="_blank" href="https://filesdgaaea.blob.core.windows.net/files/{{$vacante->archivo}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                    <img src="{{asset('images/file.png')}}" alt="">
                                </a>

                            @else

                                Inexistente

                            @endif



                        </td>
                        {{--

                                            <td class="py-4 px-2 text-right">
                                                <button type="button"
                                                        class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                                        data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                            </td>
                        --}}

                        @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )

                            @if($isDeleted)

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                            @else

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                                <td class="py-4 px-2 text-right">
                                    <a href="{{route('vacante.edit',$vacante->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                </td>

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                            data-modal-toggle="delete-modal{{$vacante->id}}">Cerrar EE</button>
                                </td>

                            @endif

                        @else

                            @if($isDeleted)

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                            @else

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                                <td class="py-4 px-2 text-right">
                                    <a href="{{route('vacante.edit',$vacante->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                </td>

                            @endif

                        @endif

                    </tr>
                    @include('vacante.modalConfirmacionEliminar')
                    @include('vacante.modalVisualizarVacante')
                @endforeach
            @endif
            </tbody>
        </table>
        {{ $vacantes->links() }}
    </div>

</div>


<script type='text/javascript'>

    var formB = document.getElementById( 'radioA' );

    $(document).ready(function() {
        $('input[name=tipoV]').change(function(){
            //$('form').submit();
            formB.submit();
        });
    });

</script>

</body>
</html>
