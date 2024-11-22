<!DOCTYPE html>
<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <h1>Data User</h1>
        <a href="{{ url('user/tambah') }}">+ Tambah User</a>
        <table broder="1" cellpadding="2" cellspacing="0">
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Nama</td>
                <td>ID Levela</td>
                <td>Aksi</td>
            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->id_user }}</td>
                <td>{{ $d->username_user }}</td>
                <td>{{ $d->nama_user }}</td>
                <td>{{ $d->id_level}}</td>
                <td><a href="{{ url('user/ubah')}}/{{ $d->id_user }}">Ubah</a> | <a href="{{ url ('user/hapus')}}/{{ $d->id_user }}">Hapus</a></td>
            </tr>
            @endforeach
        </table>
    </body>
</html>