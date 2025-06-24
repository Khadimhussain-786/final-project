<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>myapp</title>

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

         

  
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
