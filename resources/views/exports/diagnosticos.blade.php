<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>CIE10</th>
        <th>estado</th>
        <th>Usuario_Creación</th>
        <th>Fecha_Creación</th>
        <th>Usuario_Modificación</th>
        <th>Fecha_Modificación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($diagnosticos as $diagnostico)
        <tr>
            <td>{{ $diagnostico->id }}</td>
            <td>{{ $diagnostico->name }}</td>
            <td>{{ $diagnostico->cie10 }}</td>
            <td>
              @if ($diagnostico->estado)
                  Habilitado
              @else
                  Inhabilitado
              @endif
            </td>
            <td>{{ $diagnostico->user_created->username}}</td>
            <td>{{ $diagnostico->created_at }}</td>
            <td>{{ $diagnostico->user_updated->username}}</td>
            <td>{{ $diagnostico->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
