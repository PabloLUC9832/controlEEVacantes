<div class="w-1/4">
    <label for="zona-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Zona</label>
    <select  id="zona-dropdown" name="zona" class="estiloSelect" required>
        <option>Selecciona la zona</option>
        @foreach ($zonas as $data)
            <option value="{{$data->id}}~{{$data->nombre}}">
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
                        $("#dependencia-dropdown").append('<option value="' + value.clave_dependencia + "~" + value.nombre_dependencia + '">' + value.clave_dependencia +"~"+ value.nombre_dependencia + '</option>');
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
                        $("#programa-dropdown").append('<option value="' + value.clave_programa + "~" + value.nombre_programa + '">' + value.clave_programa +"~"+ value.nombre_programa + '</option>');
                    });
                }
            });
        });
    });
</script>
