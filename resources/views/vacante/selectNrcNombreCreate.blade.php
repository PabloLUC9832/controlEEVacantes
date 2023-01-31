<div class="col-span-6">
            <label for="numMateria-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">NRC</label>
            <select  id="numMateria-dropdown" name="numMateria" class="estiloSelect" required>
            <option>Selecciona el NRC</option>
                @foreach ($experienciasEducativas as $data)
                    <option value="{{$data->nrc}}">
                            {{$data->nrc}} {{$data->nombre}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-6">
            <label for="nombreMateria-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Experiencia Educativa</label>
            <select id="nombreMateria-dropdown" class="estiloSelect" name="nombreMateria">
            </select>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {


            $('#numMateria-dropdown').on('change', function () {
                var nrcMateriaSeleccionada = this.value;
                $("#nombreMateria-dropdown").html('');
                $.ajax({
                    url: "{{url('api/fetch-nombreExperienciaEducativa')}}",
                    type: "POST",
                    data: {
                        nrc: nrcMateriaSeleccionada,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.nombreExperienciaEducativa, function (key, value) {
                            $("#nombreMateria-dropdown").html('<option value="' + value.nombre + '">' + value.nombre + '</option>');
                        });
                    }
                });
            });


        });
    </script>

