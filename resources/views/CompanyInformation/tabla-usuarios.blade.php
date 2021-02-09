<form action="{{ url('/listausuarios') }}" method="GET">


    <select name="company_id">
        <option value="{{ Auth::user()->company_id }}">{{ Auth::user()->companies->name }}</option>
    </select>
    <br>
    <button type="submit">Ver Usuarios</button>
</form>

<table>
    <tr>
        <td>No</td>
        <td>nombre</td>
        <td>apellido</td>
    </tr>
    @foreach ($usuarios as $usuario)
        <tr>
            <th>{{ $loop->index + 1 }}</th>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->lastname }}</td>

            <td>{{ $usuario->company_id }}</td>
        </tr>
    @endforeach
</table>
