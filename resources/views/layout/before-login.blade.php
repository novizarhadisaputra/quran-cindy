<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quran Cindy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<style>
    @font-face {
        font-family: "Montserrat-Regular";
        src: url("{{ asset('fonts/Montserrat/Montserrat Regular 400.ttf') }}");
    }

    @font-face {
        font-family: "LPMQ";
        src: url("{{ asset('fonts/LPMQ IsepMisbah.ttf') }}");
    }

    label {
        font-family: "Montserrat-Regular"
    }
    .text-arab {
        font-family: "LPMQ",
    }
</style>

<body>
    @include('components.navbar')
    @yield('content')
    @include('components.spinner')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
