<div class="container-fluid my-5 p-0 m-0">
    <div class="row mb-5 p-0 m-0">
        <div class="col-12 p-0 m-0">
            <nav class="navbar bg-green fixed-top navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand p-2 rounded" href="{{ route('employees.index') }}">
                        <img src="/images/logo-modified.png" alt="Bootstrap" width="45" height="40" class="">
                    </a>
                    <a class="navbar-brand small-text text-white" style="color: white;font-family:monospace;"
                        href="{{ route('employees.index') }}"> @lang('messages.employee_registration_system')
                    </a>
                    <button class="navbar-toggler bg-white mt-1" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                    </button>
                    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item my-auto">
                                <div class="nav-link">
                                    <a href="{{ route('employees.create', ['formSelector' => 'form1']) }}"
                                        class="mx-2 {{ request()->path() == 'employees/create' ? 'shadow text-dark bg-white p-2 rounded-2' : 'text-white' }}">
                                        <span class="">@lang('messages.register')</span>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item my-auto">
                                <div class="nav-link">
                                    <a href="{{ route('employees.index') }}"
                                        class="mx-2 {{ request()->path() == 'employees' ? 'shadow text-dark bg-white p-2 rounded-2' : 'text-white' }}">
                                        <span class="">@lang('messages.employee_list')</span>
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item my-auto">
                                <div class="nav-link">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if (session('locale') == 'en')
                                                <img src="{{ asset('images/flag-english.png') }}" style=""
                                                    alt="" class="img-fluid img-style">
                                            @elseif (session('locale') == 'mm')
                                                <img src="{{ asset('images/flag-myanmar.png') }}" style=""
                                                    alt="" class="img-fluid img-style">
                                            @endif
                                        </a>

                                        <div class="dropdown-menu text-left lang-style"
                                            aria-labelledby="dropdownMenuLink">
                                            <a href="/language/en" class="btn btn-info dropdown-item">
                                                <img src="{{ asset('images/flag-english.png') }}" style=""
                                                    alt="" class="img-fluid img-style">
                                                <span class="text-dark">English</span></a>
                                            <a href="/language/mm" class="btn btn-info dropdown-item">
                                                <img src="{{ asset('images/flag-myanmar.png') }}" style=""
                                                    alt="" class="img-fluid img-style">
                                                <span class="text-dark">Myanmar</span></a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item my-auto">
                                <div class="nav-link">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" role="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset(session('photo')) }}" alt=""
                                                class="img-fluid rounded-5" style="width: 35px;height: 35px;">
                                        </a>
                                        <div class="dropdown-menu dropdown-style" style=""
                                            aria-labelledby="dropdownMenu2">
                                            <div class="row dropdown-header">
                                                <div class="col-md-12 btn dropdown-item no-hover">
                                                    {{-- <img src="{{ asset(session('photo')) }}" alt=""
                                                        class="img-fluid rounded-5" style="width: 30px;height: 30px;"> --}}
                                                    <span class="">{{ session('employee.employee_name') }}</span>
                                                </div>
                                                <div class="col-12 mt-3 p-0 m-0">
                                                    @if (session('employee.id'))
                                                        <span
                                                            class="d-none">{{ $employeeID = session('employee.id') }}</span>
                                                    @endif
                                                    <a href="{{ route('employees.show', $employeeID) }}"
                                                        class="btn btn-info dropdown-item">
                                                        <i class="fa-solid fa-user text-dark"></i>
                                                        <span class="text-dark">@lang('messages.myprofile')</span></a>
                                                </div>
                                            </div>
                                            <hr>
                                            <button type="button" class="btn btn-info dropdown-item"
                                                data-bs-toggle="modal" data-bs-target="#logout">
                                                <i class="fa fa-sign-out ms-1" aria-hidden="true"></i>
                                                @lang('messages.logout')</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('messages.confirmation')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang('messages.logout_text')
            </div>
            <div class="modal-footer">
                <a href="#"><button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('messages.cancel')</button></a>
                <a href="{{ route('logout') }}"><button type="button"
                        class="btn btn-info">@lang('messages.ok')</button></a>
            </div>
        </div>
    </div>
</div>
