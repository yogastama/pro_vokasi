<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation</title>
</head>

<body>
    <h1>
        Halo, {{ $name }}
    </h1>
    <hr>
    <h4>
        Pendaftaran kamu pada event {{ $event }} telah diverifikasi oleh admin. Gunakan tiket ini untuk masuk ke lokasi event ya!
    </h4>
    <img src="{{ $image }}" alt="image" width="100%">
</body>

</html>