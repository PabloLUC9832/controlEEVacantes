<!doctype html>
<html lang="es">
<head>
    {{--<meta charset="UTF-8">--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Vacantes</title>
</head>

<style>

    .tabla{
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .cabecera{
        background-color: #0D47A1;
        color: white;
    }

    .encabezado{
        margin-top: 5px;
        margin-bottom: 5px;
        font-size: 20px;
    }

    .subTitulo{
        margin-top: 0;
        margin-bottom: 5px;
        text-align: center;
        color: #0D47A1;
        font-weight: bold;
    }

    .titulo{
        margin-top: 15px;
        font-size: 18px;
        margin-bottom: 5px;
        text-align: center;
    }

    td,th{
        border: 1px solid #939090;
    }

    tbody tr:nth-child(odd) {
        background-color: white;
        text-align: left;
        border: 1px solid #ddd;
    }

    tbody tr:nth-child(even) {
        background-color: rgba(236, 230, 230, 0.72);
        border: 1px solid #ddd;
    }

    .imagen{
        display: flex;
        justify-content: center;
    }

    .right{
        float: right;
        width: 80%;
        margin-top: 10px;
    }

    .left{
        position:relative;
        float: left;
        width: 20%;
        padding-bottom: 100px;
    }

</style>

<body>

<div class="right">
    <h2 class="encabezado">DIRECCIÓN GENERAL DEL ÁREA ACADÉMICA ECONÓMICO-ADMINISTRATIVA</h2>
    <h4 class="subTitulo">{{$dependencia}}</h4>
</div>

<div class="left">
    <img src="<?php echo $uv ?>" width="120px">
</div>

<h4 class="titulo">Reporte Experiencias Educativas Vacantes</h4>

<div>
    <table class="tabla">
        <thead class="cabecera">
        <tr>
            <th>N° Programa</th>
            <th>N° Horas</th>
            <th>N° Materia</th>
            <th>Nombre Materia</th>
            <th>Grupo</th>
        </tr>
        </thead>

            @foreach($listaVacantes as $vacante)
                <tr>

                    <td>
                        {{$vacante->numPrograma}}
                    </td>

                    <td>
                        {{$vacante->numHoras}}
                    </td>

                    <td >
                        {{$vacante->numMateria}}
                    </td>

                    <td>
                        {{$vacante->nombreMateria}}
                    </td>

                    <td>
                        {{$vacante->grupo}}
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>

</div>
</body>
</html>
