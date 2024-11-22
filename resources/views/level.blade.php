<!DOCTYPE html>
<html>
    <head>
        <title>Data Level Pengguna</title>
    </head>
    <body>
        <h1>Data Level Pengguna</h1>
        <table broder="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Kode Level</th>
                <th>Nama level</th>
                <th>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->id_level }}</td>
                <td>{{ $d->kode_level }}</td>
                <td>{{ $d->nama_level }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>