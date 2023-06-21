@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="min-vh-100 w-100 d-flex justify-content-center align-items-center">
                <form method="post" action="{{ route('login') }}">
                    @csrf
                        <div class="card" style="width:30rem;">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            <div class="card-body">
                                <h5 class="card-title">Employee Registration System</h5>
                                <div class="card-text mt-3">
                                    <div class="form-group mb-3">
                                        <input type="text" name="employee_id" id="" class="form-control" placeholder="Employee ID">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="password" name="password" id="" class="form-control" placeholder="Password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" class="btn btn-primary">Login</button>
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
