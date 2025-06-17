<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nota Donasi</title>
</head>

<body>
    <h1 style="color: #2d3748;">Nota Penggunaan Dana Donasi</h1>

    @if (!empty($pesan))
        <p>{!! nl2br(e($pesan)) !!}</p>
    @else
        <p>Tidak ada pesan dikirim.</p>
    @endif

    <p>Hormat kami,<br>
        Tim Donasi</p>
</body>

</html>
