<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/r-2.2.9/rg-1.1.4/sl-1.3.3/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: "{!! auth()->check()?auth()->user()->jsPermissions():null !!}"
    }
</script>

        <!-- Scripts -->
        @routes
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-light">
        @inertia
{{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>--}}

{{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/r-2.2.9/rg-1.1.4/sl-1.3.3/datatables.min.js"></script>
    </body>
</html>
