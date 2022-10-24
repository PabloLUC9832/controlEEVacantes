<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Motivos</title>
</head>
<body>
    <br>
<div class="container">
<table class="table">
    <thead>
    <tr>
        <th>Número Motivo</th>
        <th>Nombre</th>
        <th>Concepto</th>
    </tr>
    </thead>

    <tbody>
        @foreach($motivos as $motivo)
            <tr>
                <td>{{$motivo->numeroMotivo}}</td>
                <td>{{$motivo->nombre}}</td>
                <td>{{$motivo->concepto}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<br>
<h1>combobox</h1>

<form>
    <div class="form-group">
        <h2>Selecciona el motivo</h2>
        <select class="form-control">
            @foreach($listaMotivos as $motivo)
            <option>{{$motivo->nombre}}</option>
            @endforeach
        </select>
    </div>
</form>

</div>
    
</body>
</html>


