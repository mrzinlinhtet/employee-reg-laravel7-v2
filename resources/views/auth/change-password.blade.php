@extends('layouts.app')


@section('content')
    <div class="container-fluid login-bg">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <form method="post" action="{{ route('change-password') }}"
                style="width: 420px;left: 380px;top: -40px;position: relative;">
                @csrf
                <div class="card card-style" style="background:#e6e6e6";>
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <span><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                        </div>
                    @enderror
                    <div class="card-body">
                        <h5 class="card-title mt-3" style="color: white;font-family:monospace;">Change New Password
                        </h5>
                        <div class="card-text mt-5">
                            <div class="form-group mb-3">
                                <input type="password" name="password" id="" class="form-control"
                                    placeholder="Enter New Password" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="confirm_password" id="" class="form-control"
                                    placeholder="Enter Confirm Password" autocomplete="off">
                                <input type="text" name="empid" value='{{ Session::get('verifyEmpId') }}' hidden />
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="login-btn btn btn-outline-info my-3">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
