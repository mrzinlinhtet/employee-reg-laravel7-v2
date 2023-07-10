@extends('layouts.app')


@section('content')
    <div class="container-fluid login-bg">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <form method="post" action="{{ route('verify-otp') }}" class="w-75">
                        @csrf
                        <div class="card card-style" style="background:#e6e6e6";>
                            @error('otp')
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <span><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                                </div>
                            @enderror
                            @if (session()->has('error'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <span><i class="fa-solid fa-triangle-exclamation"></i>
                                        {{ session()->get('error') }}</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <p class="card-title mt-3" style="color: white;font-family:monospace;">Confirmation with
                                    OTP Code
                                </p>
                                <div class="card-text mt-5">
                                    <div class="form-group mb-3">
                                        <input type="text" name="otp" id="" class="form-control"
                                            placeholder="Enter OTP Code" autocomplete="off">
                                        <input type="text" name="empid" value='{{ Session::get('verifyEmpId') }}'
                                            hidden />
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" class="login-btn btn btn-outline-info my-3">Submit</button>
                                    </div>

                                    <a href="{{ route('login') }}" class="text-white"
                                        style="text-decoration: none;font-size: 15px;">Go back</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
