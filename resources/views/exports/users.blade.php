<table>
    <thead >
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Dni</th>
        <th>Usuario</th>
        <th>Perfil</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->person->name }}</td>
            <td>{{ $user->person->lastname }}</td>
            <td>{{ $user->person->document }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->roles[0]->name }}</td>
            <td>
                @if ($user->estado)
                    Habilitado
                @else
                    Inhabilitado
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
