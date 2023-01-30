<div class="col-span-6">
    <label for="idZona-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">N° de la zona</label>
    <select  id="idZona-dropdown" name="idZona" class="estiloSelect" required>
        <option>Selecciona el N° de la zona</option>
        @foreach ($zonas as $data)
            <option value="{{$data->id}}">
                {{$data->id}}
            </option>
        @endforeach
    </select>
</div>

<div class="col-span-6">
    <label for="nombreZona-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Nombre de la zona</label>
    <select id="nombreZona-dropdown" class="estiloSelect" name="nombreZona">
    </select>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('#idZona-dropdown').on('change', function () {
            var idZonaSeleccionada = this.value;
            $("#nombreZona-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-idNombreZona')}}",
                type: "POST",
                data: {
                    idZona: idZonaSeleccionada,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.idNombreZona, function (key, value) {
                        $("#nombreZona-dropdown").html('<option value="' + value.nombre + '">' + value.nombre + '</option>');
                    });
                }
            });
        });

    });
</script>

