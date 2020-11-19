<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Piso</th>
        <th>estado</th>
        <th>Habitacion_Inicio</th>
        <th>Habitacion_Final</th>
        <th>Usuario_Creación</th>
        <th>Fecha_Creación</th>
        <th>Usuario_Modificación</th>
        <th>Fecha_Modificación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipos as $equipo)
        <tr>
            <td>{{ $equipo->id }}</td>
            <td>{{ $equipo->name }}</td>
            <td>{{ $equipo->piso->name }}</td>
            <td>
              @if ($equipo->estado)
                  Habilitado
              @else
                  Inhabilitado
              @endif
            </td>
            <td>{{ $equipo->habitacionInicio->habitacion }}</td>
            <td>{{ $equipo->habitacionFinal->habitacion }}</td>
            <td>{{ $equipo->usuarioCrea->username }}</td>
            <td>{{ $equipo->created_at }}</td>
            @if ($equipo->updated_id)
                <td>{{ $equipo->usuarioUpd->username }}</td>
                <td>{{ $equipo->updated_at }}</td>
            @else
                <td>Sin modificación</td>
                <td>Sin modificación</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
