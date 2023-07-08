<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/images/logo-modified.png">

    <!-- include a theme -->
    {{-- <link rel="stylesheet" href="{PATH}/css/themes/default.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .pdf-btn {
            right: 180px;
            position: absolute;
            margin-top: 16px;
        }

        .excel-btn {
            right: 15px;
            position: absolute;
            margin-top: 16px;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #688c94;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #92c6d2;
        }

        .back-btn {
            border: 1px #16a2b4;
            background: #16a2b4;
        }

        .back-btn:hover {
            border: 1px #128291;
            background: #128291;
        }

        .search-btn {
            width: 130px;
            padding-top: 10px;
            padding-bottom: 13px;
            border: 1px #16a2b4;
            background: #16a2b4;
            border-radius: 7px;
            color: white;
        }

        .reset-btn {
            width: 130px;
            padding-top: 10px;
            padding-bottom: 13px;
            border-radius: 7px;
            color: white;
        }

        .search-btn:hover {
            border: 1px #128291;
            background: #128291;
        }

        .card {
            background: #92c6d2;
        }

        .bg-green {
            background: #1D3E53;
        }

        .dropdown-toggle::after {
            color: white !important;
        }

        .no-hover {
            background: white;
            color: #000000;
        }

        .img-style {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .lang-style {
            right: -1.7000000000000028px;
            bottom: -97px;
        }

        ul li a.active {
            font-weight: bold;
        }

        .dropdown-style {
            right: -1px;
            bottom: -179px;
        }

        .login-bg {
            background-image: url('/images/undraw_remotely.svg');
            background-repeat: no-repeat;
        }

        .th-bg {
            background: #476D7C !important;
            color: white !important;
        }

        .active>.page-link,
        .page-link.active {
            background-color: #595c5f !important;
            border-color: #595c5f !important;
        }

        .page-link {
            color: #000000;
        }

        .login-btn {
            background: #92c6d2;
            color: white;
            width: 110px;
            border: #92c6d2;
        }

        .login-btn:hover {
            background: #79a6b0;
            color: white;
            border: #79a6b0;
        }

        .active-btn {
            background: #dc3545;
            border: #dc3545;
        }

        .active-btn:hover {
            background: #a92a36;
            border: #a92a36;
        }

        .inactive-btn {
            background: #16a2b4;
            border: #16a2b4;
        }

        .inactive-btn:hover {
            background: #128291;
            border: #128291;
        }

        .card-style {
            background: #c5c5c505 !important;
            /* opacity: 0.5; */
            border: 1px solid #e6e6e62e !important;
            box-shadow: 2px 3px 12px -1px !important;
        }

        a {
            text-decoration: none;
        }

        body {
            font-family: "Roboto", sans-serif;
            background-color: #476D7C;

        }

        .file-upload {
            background-color: #EEEEEE;
            width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #EEEEEE;
            background: #393E46;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #00ADB5;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #393E46;
            color: #EEEEEE;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            border: 4px dashed #393E46;
            position: relative;
        }

        /* .image-dropping,
      .image-upload-wrap:hover {
      background-color: #393E46;
      border: 4px dashed #EEEEEE;
      } */

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h5 {
            font-weight: 100;
            /* text-transform: uppercase; */
            color: #00ADB5;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 150px;
            max-width: 150px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #EEEEEE;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #EEEEEE;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        @media screen and (max-width:600px) {
            .pdf-btn {
                right: 0px;
                position: static !important;
                margin-top: 0px;
            }

            .excel-btn {
                right: 0px;
                position: static !important;
                margin-top: 0px;
            }




            .navbar-brand {
                display: none;
            }

            .file-upload {
                width: 300px;
            }

            .small-text {
                font-size: 1rem !important;
            }

            .btn,
            span {
                font-size: 12px !important;
            }

            .drag-text h5 {
                font-weight: 50;
                /* text-transform: uppercase; */
                padding: 30px 0;
            }

        }
    </style>
    <style>
        .toggle-password {
            cursor: pointer;
            position: relative;
            user-select: none;
        }
    </style>
    <title>
        @yield('title')
    </title>

    @yield('nav')

</head>

<body>

    @if (session()->has('employee'))
        @include('layouts.nav')
    @endif

    @yield('content')


    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>



    @yield('footer')
</body>

</html>
