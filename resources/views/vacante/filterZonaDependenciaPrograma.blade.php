<form action="{{ route('vacante.index') }}" method="GET" enctype="multipart/form-data" >

    <div class="flex sm:rounded-lg md:mt-5 md:mx-10 md:my-0">
        <div class="w-1/4">
            <label for="zona-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Zona</label>
            <select  id="zona-dropdown" name="zona" class="estiloSelect" required>
                <option>Selecciona la zona</option>
                @foreach ($zonas as $data)
                    <option value="{{$data->id}}">
                        {{$data->id}}~{{$data->nombre}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-1/4 ml-8">
            <label for="dependencia-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Dependencia</label>
            <select id="dependencia-dropdown" class="estiloSelect" name="dependencia">
            </select>
        </div>

        <div class="w-1/4 ml-8">
            <label for="programa-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Programa Educativo</label>
            <select id="programa-dropdown" class="estiloSelect" name="programa">
            </select>
        </div>

        <div class="w-1/4 ml-8">
            <label for="filtroBusqueda-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Filtrar</label>
            <select id="filtroBusqueda-dropdown" class="estiloSelect" name="filtroBusqueda">
                <option value="Todas">Todas</option>
                <option value="Vacantes">Vacantes</option>
                <option value="No Vacantes">No Vacantes</option>
                <option value="Vacantes Cerradas">Vacantes Cerradas</option>
            </select>
        </div>
    </div>
{{--<div class="w-1/8 ml-8">
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mt-7 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aplicar</button>
</div>--}}

    <div class="flex sm:rounded-lg md:mt-5 md:mx-10 md:my-0">
        <div class="w-11/12">
            <input type="search" id="search-dropdown" class=" p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50
            border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingresa tu búsqueda. Para volver a ver la lista completa solo presiona nuevamente el botón de Buscar o la tecla Enter." name="search">
        </div>

        <div class="w-1/12">
            <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mt-0 ml-6 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aplicar</button>
        </div>


    </div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#zona-dropdown').on('change', function () {
            var zonaSeleccionada = this.value;
            var zonaSeleccionadaCompleta = zonaSeleccionada.split('~');
            var idZonaSeleccionada = zonaSeleccionadaCompleta[0];
            $("#dependencia-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-dependenciaVacante')}}",
                type: "POST",
                data: {
                    idZona: idZonaSeleccionada,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.dependenciaVacante, function (key, value) {
                        $("#dependencia-dropdown").append('<option value="' + value.clave_dependencia  +  '">' + value.clave_dependencia +"~"+ value.nombre_dependencia + '</option>');
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#dependencia-dropdown').on('change', function () {
            var dependenciaSeleccionada = this.value;
            var dependenciaSeleccionadaCompleta = dependenciaSeleccionada.split('~');
            var idDependenciaSeleccionada = dependenciaSeleccionadaCompleta[0];
            $("#programa-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-programaVacante')}}",
                type: "POST",
                data: {
                    idDependencia: idDependenciaSeleccionada,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.programaVacante, function (key, value) {
                        $("#programa-dropdown").append('<option value="' + value.clave_programa + '">' + value.clave_programa +"~"+ value.nombre_programa + '</option>');
                    });
                }
            });
        });
    });
</script>

