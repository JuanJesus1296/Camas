<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombres_Apellidos</th>
        <th>Número_CMP</th>
        <th>Número_RNE</th>
        <th>Estado</th>
        <th>Usuario_Creación</th>
        <th>Fecha_Creación</th>
        <th>Usuario_Modificación</th>
        <th>Fecha_Modificación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($doctores as $doctor)
        <tr>
            <td>{{ $doctor->id }}</td>
            <td>{{ $doctor->person->fullname }}</td>
            <td>{{ $doctor->cmp }}</td>
            <td>{{ $doctor->rne }}</td>
            <td>
              @if ($doctor->estado)
                  Habilitado
              @else
                  Inhabilitado
              @endif
            </td>
            <td>{{ $doctor->userCrea->username }}</td>
            <td>{{ $doctor->created_at }}</td>
            @if ($doctor->userUpd)
                <td>{{ $doctor->userUpd->username }}</td>
                <td>{{ $doctor->updated_at }}</td>
            @else
                <td>Sin modificación</td>
                <td>Sin modificación</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
