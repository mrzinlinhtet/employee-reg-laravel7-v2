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
                    <form method="post" action="{{ route('forgot-password') }}" class="w-75">
                        @csrf
                        <div class="card card-style" style="background:#e6e6e6";>
                            @error('email_address')
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
                                <h5 class="card-title mt-3" style="color: white;font-family:monospace;">Forgot your
                                    password?
                                </h5>
                                <div class="card-text mt-5">
                                    <div class="form-group mb-3">
                                        <input type="email" name="email_address" id="" class="form-control"
                                            placeholder="Enter Email Address" autocomplete="off">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" id="continue-btn"
                                            class="login-btn btn btn-outline-info my-3">Continue</button>
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

@section('footer')
    <script>
        $(document).ready(function() {
            // Target the continue button
            $('#continue-btn').click(function() {
                // Perform some actions before the timeout
                console.log('Button clicked!');

                // Set a timeout of 2 seconds (2000 milliseconds)
                setTimeout(function() {
                    // Actions to perform after the timeout
                    $('#spinner').removeClass('d-none');
                    console.log('Timeout completed!');
                }, 2000);
            });
        });
    </script>
@endsection
