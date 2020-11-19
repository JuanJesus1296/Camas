<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Usuario_Creación</th>
        <th>Fecha_Creación</th>
        <th>Usuario_Modificación</th>
        <th>Fecha_Modificación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pisos as $piso)
        <tr>
            <td>{{ $piso->id }}</td>
            <td>{{ $piso->name }}</td>
            <td>
              @if ($piso->estado)
                  Habilitado
              @else
                  Inhabilitado
              @endif
            </td>
            <td>{{ $piso->userCrea->username }}</td>
            <td>{{ $piso->created_at }}</td>
            @if ($piso->userUpd)
                <td>{{ $piso->userUpd->username }}</td>
                <td>{{ $piso->updated_at }}</td>
            @else
                <td>Sin modificación</td>
                <td>Sin modificación</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
