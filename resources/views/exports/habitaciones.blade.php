<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Piso</th>
        <th>Estado</th>
        <th>Activo</th>
        <th>Usuario_Creación</th>
        <th>Fecha_Creación</th>
        <th>Usuario_Modificación</th>
        <th>Fecha_Modificación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($habitaciones as $habitacion)
        <tr>
            <td>{{ $habitacion->id }}</td>
            <td>{{ $habitacion->habitacion }}</td>
            <td>{{ $habitacion->piso->name }}</td>
            <td>
                @foreach($estados as $estado)
                    @if($habitacion->estado_id == $estado->id)
                    {{ $estado->descripcion }}
                    @endif
                @endforeach
            </td>
            <td>
              @if ($habitacion->estado)
                  Habilitado
              @else
                  Inhabilitado
              @endif
            </td>
            <td>{{ $habitacion->userCrea->username }}</td>
            <td>{{ $habitacion->created_at }}</td>
            @if ($habitacion->userUpd)
                <td>{{ $habitacion->userUpd->username }}</td>
                <td>{{ $habitacion->updated_at }}</td>
            @else
                <td>Sin modificación</td>
                <td>Sin modificación</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
