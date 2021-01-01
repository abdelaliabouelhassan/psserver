<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
     content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          crossorigin="anonymous">

    <!-- fontawesome css -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- google font css -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

    <!-- slick css -->
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">

    <!-- vgnav -->
    <link href="{{asset('vgnav/vgnav.css')}}"
          rel="stylesheet" type="text/css">
    <link href="{{asset('vgnav/vgnav-theme.css')}}"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/github.min.css">
    <link href="https://vegas-dev.github.io/vegas-nav/demo/css/demo.css"
          rel="stylesheet" type="text/css">
    <!-- lity css -->
    <link rel="stylesheet" href="{{asset('lity/lity.css')}}">

    <!-- style css -->
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
{{-- recaptcha --}}
 <script src='https://www.google.com/recaptcha/api.js'></script>
 
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>

    <!-- responsive css -->

    <title>Metine2 TopList</title>
</head>
<body>
<div id="app">
    <main-App></main-App>
</div>

<script src="{{asset('js/app.js')}}"></script>

<!-- javascripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
    crossorigin="anonymous"></script>

<!-- vgnav -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/languages/javascript.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/languages/css.min.js"></script>
<script
    src="{{asset('vgnav/vgnav.min.js')}}"></script>
<!-- slick js -->
<script src="{{asset('slick/slick.min.js')}}"></script>

<!-- lity js -->
<script src="{{asset('lity/lity.js')}}"></script>
<!-- custom js -->
<script src="{{asset('custom js/script.js')}}"></script>

 

</body>
</html>
