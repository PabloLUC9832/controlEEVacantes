<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitácora</title>
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

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg md:mt-10 md:mx-10 md:my-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Fecha (Año-Mes-Día)
                </th>
                <th scope="col" class="py-3 px-6">
                    Usuario
                </th>
                <th scope="col" class="py-3 px-6">
                    Correo
                </th>
                <th scope="col" class="py-3 px-6">
                    Acción
                </th>
                <th scope="col" class="py-3 px-6">
                    Cambios Realizados
                </th>
            </tr>
            </thead>
            <tbody>

            @if(count($bitacora)<=0)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="py-4 px-6">
                        No se han encontrado registros
                    </td>
                </tr>
            @else
                @foreach($bitacora as $accion)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$accion->created_at}}
                        </th>

                        <td class="py-4 px-6">
                            {{$accion->name}}
                        </td>

                        <td class="py-4 px-6">
                            {{$accion->email}}
                        </td>

                        <td class="py-4 px-6">
                            {{$accion->action}}
                        </td>

                        <td class="py-4 px-6">
                            {{$accion->data}}
                        </td>

                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
