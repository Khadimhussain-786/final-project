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




    <div id="app">
        @include('layouts.header.header')

        @yield('content')   
        
    </div>


    

    <script src="{{ asset('js/dropzone.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- myapp_script -->

        <script>
                function goToStep2() {
                    const mobile = document.getElementById('mobile').value.trim();

                    
                    if (!mobile || mobile.length < 9) {
                    alert('لطفاً شماره موبایل معتبر وارد کنید.');
                    return;
                    }


                    const regex = /^[0-9]+$/;
                    if (!regex.test(mobile)) {
                    alert('شماره موبایل فقط باید شامل عدد باشد.');
                    return;
                    }
                    
                    document.getElementById('step1').classList.add('d-none');
                    document.getElementById('step2').classList.remove('d-none');
                    document.getElementById('showMobile').innerText = '+93' + mobile;
                }

                function backToStep1() {
                    document.getElementById('step2').classList.add('d-none');
                    document.getElementById('step1').classList.remove('d-none');
                }
        </script>

   <!-- chat_script -->

        <script>
            function goToStep2Login() {
                const mobileInput = document.querySelector('#loginContainer #mobile');
                const step1 = document.querySelector('#loginContainer #step1');
                const step2 = document.querySelector('#loginContainer #step2');
                const showMobile = document.querySelector('#loginContainer #showMobile');

                if (!mobileInput || !step1 || !step2 || !showMobile) {
                    console.warn("عناصر مورد نظر یافت نشدند");
                    return;
                }

                const mobile = mobileInput.value.trim();
                if (!mobile || mobile.length < 9) {
                    alert('لطفاً شماره موبایل معتبر وارد کنید.');
                    return;
                }

                const regex = /^[0-9]+$/;
                if (!regex.test(mobile)) {
                    alert('شماره موبایل فقط باید شامل عدد باشد.');
                    return;
                }

                step1.classList.add('d-none');
                step2.classList.remove('d-none');
                showMobile.innerText = '+93' + mobile;
            }

            function backToStep1Login() {
                const step1 = document.querySelector('#loginContainer #step1');
                const step2 = document.querySelector('#loginContainer #step2');

                if (step1 && step2) {
                    step2.classList.add('d-none');
                    step1.classList.remove('d-none');
                }
            }
        </script>




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
