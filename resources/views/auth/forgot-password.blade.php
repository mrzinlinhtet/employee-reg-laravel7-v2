@extends('layouts.app')


@section('content')
    <div class="container-fluid login-bg">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">
                <div id="spinner" class="d-none d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <span><img src="{{ asset('images/Pulse.gif') }}" style="width: 100px;height: 100px;" alt=""></span>
                </div>
            </div>
            <div class="col-md-5">
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
                                <p class="card-title mt-3" style="color: white;font-family:monospace;">We will send you an email to reset your password.
                                </p>
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
            // remove d-none before the timeout
            $('#spinner').removeClass('d-none');
            // Set a timeout of seconds (1000 milliseconds)
            setTimeout(function() {
                // add d-none after the timeout
                $('#spinner').addClass('d-none');
            }, 7000);
        });
    });
</script>
@endsection
