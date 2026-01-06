<!DOCTYPE html>
<html>

<head>
    <title>Tampil Data bl-noval</title>
</head>

<body>

    <h3>Daftar Data Tabel Posts</h3>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Konten</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->konten }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>