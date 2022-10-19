<table>
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

                </td>

                <td>{{$motivo->numeroMotivo}}</td>
                <td>{{$motivo->nombre}}</td>
                <td>{{$motivo->concepto}}</td>

            </tr>
        @endforeach
    </tbody>
</table>
