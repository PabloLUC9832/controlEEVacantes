<div class="col-span-6">
    <label for="idZona-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">N° de la zona</label>
    <select  id="idZona-dropdown" name="idZona" class="estiloSelect" required>
        <option value="{{$programa->id_zona}}">{{$programa->id_zona}}</option>
        @foreach ($zonas as $data)
            <option value="{{$data->id_zona}}">
                {{$data->id_zona}}
            </option>
        @endforeach
    </select>
</div>

<div class="col-span-6">
    <label for="nombreZona-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Nombre de la zona</label>
    <select id="nombreZona-dropdown" class="estiloSelect" name="nombreZona">
        <option value="{{$programa->nombre_zona}}">{{$programa->nombre_zona}}</option>
    </select>
</div>

<div class="col-span-6">
    <label for="claveDependencia-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Clave de la dependencia</label>
    <select id="claveDependencia-dropdown" class="estiloSelect" name="claveDependencia">
        <option value="{{$programa->clave_dependencia}}">{{$programa->clave_dependencia}}</option>
    </select>
</div>

<div class="col-span-6">
    <label for="nombreDependencia-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Nombre de la dependencia</label>
    <select id="nombreDependencia-dropdown" class="estiloSelect" name="nombreDependencia">
        <option value="{{$programa->nombre_dependencia}}">{{$programa->nombre_dependencia}}</option>
    </select>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('#idZona-dropdown').on('change', function () {
            var idZonaSeleccionada = this.value;
            $("#nombreZona-dropdown").html('');
            $("#claveDependencia-dropdown").html('');
            $("#nombreDependencia-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-zonaDependencia')}}",
                type: "POST",
                data: {
                    idZona: idZonaSeleccionada,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.zonaDependencias, function (key, value) {
                        $("#nombreDependencia-dropdown").append('<option value="' + value.nombre_dependencia + '">' + value.nombre_dependencia + '</option>');
                        $("#nombreZona-dropdown").html('<option value="' + value.nombre_zona + '">' + value.nombre_zona + '</option>');
                        $("#claveDependencia-dropdown").append('<option value="' + value.clave_dependencia + '">' + value.clave_dependencia + '</option>');
                    });
                }
            });
        });

    });

</script>

<script>
    $(document).ready(function () {

        $('#claveDependencia-dropdown').on('change', function () {
            var claveDependencia = this.value;
            $("#nombreDependencia-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-nombreDependencia')}}",
                type: "POST",
                data: {
                    claveDependencia: claveDependencia,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.nombre, function (key, value) {
                        $("#nombreDependencia-dropdown").html('<option value="' + value.nombre_dependencia + '">' + value.nombre_dependencia + '</option>');
                    });
                }
            });
        });

    });

</script>



