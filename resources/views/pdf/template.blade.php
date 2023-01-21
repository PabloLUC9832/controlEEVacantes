<!doctype html>
<html lang="es">
<head>
    {{--<meta charset="UTF-8">--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Docentes</title>
    
</head>
<body>

<div class="overflow-x-auto relative shadow-md sm:rounded-lg md:mt-10 md:mx-10 md:my-10">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">
                N° de personal
            </th>
            <th scope="col" class="py-3 px-6">
                Nombre
            </th>
            <th scope="col" class="py-3 px-6">
                Apellido Paterno
            </th>
            <th scope="col" class="py-3 px-6">
                Apellido Materno
            </th>
            <th scope="col" class="py-3 px-6">
                Email
            </th>
        </tr>
        </thead>
        <tbody>

        @if(count($docentes)<=0)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="py-4 px-6">
                    No se han encontrado docentes
                </td>
            </tr>
        @else
            @foreach($docentes as $docente)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$docente->nPersonal}}
                    </th>

                    <td class="py-4 px-6">
                        {{$docente->nombre}}
                    </td>

                    <td class="py-4 px-6">
                        {{$docente->apellidoPaterno}}
                    </td>

                    <td class="py-4 px-6">
                        {{$docente->apellidoMaterno}}
                    </td>

                    <td class="py-4 px-6">
                        {{$docente->email}}
                    </td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

</body>
</html>
