<div class="container">
    <div class="row my-3 mx-3">
        <div class="col-md-6">
            <h3>Employee Registration System</h3>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <a href="{{ route('employees.create') }}" class="mx-2 fw-bold text-dark {{ request()->path() == 'employees/create' ? '' : 'text-decoration-none'}}">Register</a>
            <a href="{{ route('employees.index')}}" class="mx-2 fw-bold text-dark {{ request()->path() == 'employees' ? '' : 'text-decoration-none'}}">List</a>
            <a href="#" class="btn btn-dark mx-2" data-bs-toggle="modal" data-bs-target="#logout">Logout</a>
        </div>
    </div>
</div>

<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">
          <a href="#"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
          <a href="{{ route('logout')}}"><button type="button" class="btn btn-primary">Ok</button></a>
        </div>
      </div>
    </div>
  </div>
