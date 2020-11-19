<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Nombre_Completo</th>
        <th>DNI</th>
        <th>Estado</th>
        <th>Usuario_Creación</th>
        <th>Fecha_Creación</th>
        <th>Usuario_Modificación</th>
        <th>Fecha_Modificación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pacientes as $paciente)
        <tr>
            <td>{{ $paciente->id }}</td>
            <td>{{ $paciente->name }}</td>
            <td>{{ $paciente->lastname }}</td>
            <td>{{ $paciente->fullname }}</td>
            <td>{{ $paciente->document }}</td>
            <td>
              @if ($paciente->estado)
                  Habilitado
              @else
                  Inhabilitado
              @endif
            </td>
            <td>{{ $paciente->userCrea->username }}</td>
            <td>{{ $paciente->created_at }}</td>
            @if ($paciente->userUpd)
                <td>{{ $paciente->userUpd->username }}</td>
                <td>{{ $paciente->updated_at }}</td>
            @else
                <td>Sin modificación</td>
                <td>Sin modificación</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
