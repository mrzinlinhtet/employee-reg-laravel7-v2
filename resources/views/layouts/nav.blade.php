<div class="container">
    <div class="row my-3 mx-3">
        <div class="col-md-6">
            <h3>Employee Registration System</h3>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <a href="{{ route('employees.create') }}" class="mx-2 fw-bold text-info {{ request()->path() == '/employees/create' ? '' : 'text-decoration-none'}}">Register</a>
            <a href="{{ route('employees.index')}}" class="mx-2 fw-bold text-info {{ request()->path() == '/employees/index' ? 'text-decoration-none' :  ''}}">List</a>
            <a href="{{ route('logout')}}" class="btn btn-dark mx-2">Logout</a>
        </div>
    </div>
</div>
