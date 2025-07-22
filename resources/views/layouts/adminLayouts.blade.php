<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>myapp</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    

    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
       

          @include('layouts.header')
          @include('layouts.sidebar')


          <div id="app">
                @yield('content')   
          </div>

         

   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
