<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>myapp</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">


    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>


    @include('layouts.header.header')

    <div id="app">
        @yield('content')   
    </div>


    

    <script src="{{ asset('js/dropzone.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>




  <script type="text/javascript">
    Dropzone.options.myDropzone1 = {
        paramName: "file",
        maxFilesize: 5,
        dictDefaultMessage: "تصاویر را اینجا بکشید یا کلیک کنید",
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        success: function(file, response) {
            if (response.filename) {
                $('#editimage').append(
                    '<input type="hidden" name="image[]" value="' + response.filename + '">'
                );
            }
        }
    };
</script>

    
    
</body>
</html>
