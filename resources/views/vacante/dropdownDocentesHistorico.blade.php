<div id="dropdownDocentes{{$vacante->id}}" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-400 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        Historial de renuncias
    </div>
    <div class="divide-y divide-gray-400 dark:divide-gray-700">

        @foreach ($listaDocentesHistorico as $data)
            <div class="w-full pl-3">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Número de personal: <span class="font-semibold text-gray-900 dark:text-white">{{$data->nPersonal}}</span></div>
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Nombre del docente: <span class="font-semibold text-gray-900 dark:text-white">{{$data->nombreDocente}}</span></div>
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Fecha de aviso: <span class="font-semibold text-gray-900 dark:text-white">{{$data->fechaAviso}}</span></div>
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Fecha de asignación: <span class="font-semibold text-gray-900 dark:text-white">{{$data->fechaAsignacion}}</span></div>
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Fecha de renuncia: <span class="font-semibold text-gray-900 dark:text-white">{{$data->fechaRenuncia}}</span></div>
            </div>
        @endforeach

    </div>

</div>
