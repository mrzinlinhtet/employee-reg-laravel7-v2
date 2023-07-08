@extends('layouts.app')


@section('content')

    <div class="container-fluid login-bg">
        <div class="row min-vh-100 justify-content-center align-items-center">
            {{-- <div class="col-md-6"> --}}
            <form method="post" action="{{ route('login') }}" style="width: 420px;left: 380px;top: -40px;position: relative;">
                @csrf
                <div class="card card-style" style="background:#e6e6e6";>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body">
                        {{-- <a class="border border-warning p-2 rounded" href="{{ route('employees.index') }}">
                                <img src="../../images/ers-logo.png" alt="Bootstrap" width="35" height="26">
                            </a> --}}
                        <h5 class="card-title mt-3" style="color: white;font-family:monospace;">Employee Registration System
                        </h5>
                        <div class="card-text mt-5">
                            <div class="form-group mb-3">
                                <input type="text" name="employee_id" id="" class="form-control"
                                    placeholder="Employee ID" autocomplete="off">
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" id="passwordInput" class="form-control"
                                    placeholder="Password" autocomplete="off">
                                <span id="togglePassword" class="toggle-password input-group-text">👁️</span>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="login-btn btn btn-outline-info my-3">Login</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            {{-- </div> --}}
        </div>
    </div>
@endsection

@section('footer')
    <script>
        //password toggle
        const passwordInput = document.getElementById("passwordInput");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.innerHTML = "👁️";
            } else {
                passwordInput.type = "password";
                togglePassword.innerHTML = "👁️";
            }
        });
    </script>
@endsection
