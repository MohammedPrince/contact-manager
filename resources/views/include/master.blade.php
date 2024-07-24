<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel-- Contact Manager</title>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('/public') }}/laravel.png" />

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTable -->


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .pagination {
            justify-content: flex-end;
        }
    </style>
</head>

<body>

    @yield('content')

    @include('include.script')

</body>

</html>