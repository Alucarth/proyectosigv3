<table>
    <thead>
    <tr>
        <th>{{$title}}</th>
    </tr>
    <tr>
        <th>Nro</th>
        <th>Nombres</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
    </tr>
    </thead>
    <tbody>
    @foreach($general_list as $index => $item)
        <tr>
            <td> {{$index+1}} </td>
            <td>{{ $item->people->nombres}}</td>
            <td>{{ $item->people->paterno }}</td>
            <td>{{  $item->people->Materno }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
