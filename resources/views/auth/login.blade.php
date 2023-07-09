@extends('layouts.app')


@section('content')
    <div class="container-fluid login-bg">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div id="spinner" class="d-none d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <span><img src="{{ asset('images/Pulse.gif') }}" style="width: 100px;height: 100px;" alt=""></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <form method="post" action="{{ route('login') }}" class="w-75">
                        @csrf
                        <div class="card card-style" style="background:#e6e6e6";>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <span><i class="fa-solid fa-circle-check"></i> {{ session()->get('success') }}</span>
                                </div>
                            @endif
                            <div class="card-body">
                                {{-- <a class="border border-warning p-2 rounded" href="{{ route('employees.index') }}">
                                <img src="../../images/ers-logo.png" alt="Bootstrap" width="35" height="26">
                            </a> --}}
                                <h5 class="card-title mt-3" style="color: white;font-family:monospace;">Employee
                                    Registration
                                    System
                                </h5>
                                <div class="card-text mt-5">
                                    <div class="form-group mb-3">
                                        <input type="text" name="employee_id" id="" class="form-control"
                                            placeholder="Employee ID" autocomplete="off">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="passwordInput" class="form-control"
                                            placeholder="Password" autocomplete="off">
                                        <span id="togglePassword" class="toggle-password input-group-text"><i
                                                class="fas fa-eye"></i></span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <a href="{{ route('forgot-password') }}" class="text-white"
                                            style="font-size: 15px;">Forgot Password?</a>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" id="login"
                                            class="login-btn btn btn-outline-info my-3">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        // password toggle
        const passwordInput = $("#passwordInput");
        const togglePassword = $("#togglePassword");

        togglePassword.on('click', function() {
            if (passwordInput.attr('type') === "password") {
                passwordInput.attr('type', 'text');
                togglePassword.html('<i class="fas fa-eye-slash"></i>');
            } else {
                passwordInput.attr('type', 'password');
                togglePassword.html('<i class="fas fa-eye"></i>');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Target the login button
            $('#login').click(function() {
                // remove d-none before the timeout
                $('#spinner').removeClass('d-none');
                // Set a timeout of seconds (1000 milliseconds)
                setTimeout(function() {
                    // add d-none after the timeout
                    $('#spinner').addClass('d-none');
                }, 2000);
            });
        });
    </script>
@endsection
