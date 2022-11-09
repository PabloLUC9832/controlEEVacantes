    <form>
        <div class="form-group mb-3">
            <select  id="zona-dropdown" class="form-control">
                <option value="">Selecciona la zona</option>
                @foreach ($zonas as $data)
                <option value="{{$data->id}}">
                    {{$data->nombre}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <select id="dependencia-dropdown" class="form-control">
            </select>
        </div>
    </form>

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
  

            $('#zona-dropdown').on('change', function () {
                var idZonaSeleccionada = this.value;
                $("#dependencia-dropdown").html('');
                $.ajax({
                    url: "{{url('api/fetch-dependencias')}}",
                    //url: "{{url('/register')}}",
                    type: "POST",
                    data: {
                        id_zona: idZonaSeleccionada,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#dependencia-dropdown').html('<option value=""> Selecciona la dependencia</option>');
                        $.each(result.dependencias, function (key, value) {
                            $("#dependencia-dropdown").append('<option value="' + value.id_zona + '">' + value.clave_dependencia + " "+ value.nombre + '</option>');
                        });
                    }
                });
            });
  

        });
    </script>

