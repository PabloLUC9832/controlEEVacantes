<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importar CSV</title>
</head>
<body>

    <p> {{ session('status') }}</p>

    <form method="POST" action="{{url("import")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <label for="file">Archivo CSS a importar</label>
        <input id="file" type="file" name="file" required>

        @if($errors->has('file'))
        <span>
            <strong> {{ $errors->first('file') }} </strong>
        </span>
        @endif

        <p>
            <button type="submit" name="submit">Enviar</button>
        </p>
    </form>


</body>
</html>
