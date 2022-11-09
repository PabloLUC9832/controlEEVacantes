<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel AJAX Dependent Country State City Dropdown Example - ItSolutionStuff.com</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-primary mb-4 text-center">
                   <h4 >Laravel AJAX Dependent Country State City Dropdown Example  ItSolutionStuff.com</h4>
                </div> 
                <form>
                    <div class="form-group mb-3">
                        <select  id="country-dropdown" class="form-control">
                            <option value="">-- Select Country --</option>
                            @foreach ($zonas as $data)
                            <option value="{{$data->id}}">
                                {{$data->nombre}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select id="state-dropdown" class="form-control">
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('api/fetch-dependencias')}}",
                    type: "POST",
                    data: {
                        id_zona: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.dependencias, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value.id_zona + '">' + value.clave_dependencia + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>

