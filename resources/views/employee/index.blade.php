@if (isset($employees) && $employees->count() == 0 && $employees->currentPage() > 1)
    @php
        //get the current URL
        $currentUrl = url()->current();
        //get the URL parameters as an associative array
        $queryParams = request()->query();
        //decrease the page value by one
        $previousPage = $queryParams['page'] - 1;
        //set the updated page value in the query parameters
        $queryParams['page'] = $previousPage;
        //generate the previous page URL with the updated query parameters
        $previousPageUrl = $currentUrl . '?' . http_build_query($queryParams);
        //redirect to the previous page URL
        header('Location: ' . $previousPageUrl);
        exit();
    @endphp
@endif

@extends('layouts.app')

@section('title')
    @lang('messages.employee_registration_system')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    @if (session()->has('error'))
                        @if (is_array(session('error')))
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                @foreach (session()->get('error') as $error)
                                    <div><i class="fa-solid fa-triangle-exclamation"></i> {{ $error['error'] }}</div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <span><i class="fa-solid fa-triangle-exclamation"></i> {{ session()->get('error') }}</span>
                            </div>
                        @endif
                    @elseif(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <span><i class="fa-solid fa-circle-check"></i> {{ session()->get('success') }}</span>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            <span><i class="fa-solid fa-circle-check"></i> {{ session('status') }}</span>
                        </div>
                    @endif
                    <div class="">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="mt-3 ms-3">@lang('messages.employee_list')</h3>

                                <form action="{{ route('employees.index') }}" method="GET">
                                    <div class="row mt-4">
                                        <div class="col-md-2">
                                            <div class="text-muted float-end me-2">@lang('messages.employee_id')</div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="search_employee_id"
                                                value="{{ $search_employee_id }}">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="text-muted float-end me-2">@lang('messages.employee_code')</div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="search_employee_code"
                                                value="{{ $search_employee_code }}">
                                        </div>
                                        <div class="col-md-1"></div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-2">
                                            <div class="text-muted float-end me-2">@lang('messages.employee_name')</div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="search_employee_name"
                                                value="{{ $search_employee_name }}">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="text-muted float-end me-2">@lang('messages.employee_email')</div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="search_email_address"
                                                value="{{ $search_email_address }}">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <button type="submit"
                                                class=" btn-info btn-sm mx-3 search-btn">@lang('messages.search')</button>
                                            {{-- @if (isset($search_employee_id) || isset($search_employee_code) || isset($search_employee_name) || $search_email_address)
                                                <a href="{{ route('employees.index') }}" type="submit"
                                                    class="btn btn-dark active-btn reset-btn btn-sm mx-3">@lang('messages.reset')</a>
                                            @endif --}}
                                            @if ($employees->isEmpty())
                                                <button name="" class="btn btn-outline-dark mx-2 btn-sm pdf-btn"
                                                    value="true" disabled>@lang('messages.pdf_download')</button>
                                            @else
                                                <a href="{{ route('search-download-pdf', request()->query()) }}"
                                                    name="" class="btn btn-outline-dark mx-2 btn-sm pdf-btn"
                                                    value="true">@lang('messages.pdf_download')</a>
                                            @endif
                                            @if ($employees->isEmpty())
                                                <button name="downloadExcel"
                                                    class="btn btn-outline-dark mx-2 btn-sm excel-btn" value="true"
                                                    disabled>@lang('messages.excel_download')</button>
                                            @else
                                                <a href="{{ route('search-download-excel', request()->query()) }}"
                                                    name="downloadExcel" class="btn btn-outline-dark mx-2 btn-sm excel-btn"
                                                    value="true">@lang('messages.excel_download')</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                <div class="row mt-3">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5">
                                        @if ($employees)
                                            @php
                                                $totalRows = $employees->toArray()['total'];
                                            @endphp
                                        @endif
                                        <span class="me-4 float-end">@lang('messages.total_rows')<span
                                                class="fw-bold">{{ $totalRows }}
                                                row(s)</span></span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered text-center">
                                                <thead class="align-middle">
                                                    <tr>
                                                        <th class="th-bg" rowspan="2">@lang('messages.no')</th>
                                                        <th class="th-bg" rowspan="2">@lang('messages.employee_id')</th>
                                                        <th class="th-bg" rowspan="2">@lang('messages.employee_code')</th>
                                                        <th class="th-bg" rowspan="2">@lang('messages.employee_name')</th>
                                                        <th class="th-bg" rowspan="2">@lang('messages.employee_email')</th>
                                                        <th class="th-bg" colspan="4">@lang('messages.action')</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="th-bg">@lang('messages.edit')</th>
                                                        <th class="th-bg">@lang('messages.detail')</th>
                                                        <th class="th-bg">@lang('messages.status')</th>
                                                        <th class="th-bg">@lang('messages.delete')</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="align-middle">
                                                    @foreach ($employees as $employee)
                                                        <tr>
                                                            <td>{{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}
                                                            </td>
                                                            <td>{{ $employee->employee_id }}</td>
                                                            <td>{{ $employee->employee_code }}</td>
                                                            <td>{{ $employee->employee_name }}</td>
                                                            <td>{{ $employee->email_address }}</td>
                                                            <td>
                                                                @if ($employee->deleted_at != null)
                                                                    <i
                                                                        class="fa-solid text-success text-muted fa-pen-to-square fa-xl"></i>
                                                                @else
                                                                    <a
                                                                        href="{{ route('employees.edit', $employee->id) }}"><i
                                                                            class="fa-solid text-success fa-pen-to-square fa-xl edit-loading"></i></a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('employees.show', $employee->id) }}"><i
                                                                        class="fa-solid text-info fa-circle-info fa-xl detail-loading"></i></a>
                                                            </td>
                                                            <td>
                                                                @if ($employee->deleted_at != null)
                                                                    <form id="confirmActive{{ $employee->id }}"
                                                                        action="{{ route('emp-active', $employee->id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="button"
                                                                            class="btn btn-dark btn-sm active-btn"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#active{{ $employee->id }}">Active</button>
                                                                    </form>
                                                                @endif

                                                                @if ($employee->deleted_at == null)
                                                                    <form id="confirmInactive{{ $employee->id }}"
                                                                        action="{{ route('emp-inactive', $employee->id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="button"
                                                                            class="btn btn-dark btn-sm inactive-btn"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#inactive{{ $employee->id }}">Inactive</button>
                                                                    </form>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($employee->deleted_at != null)
                                                                    <i
                                                                        class="fa-solid text-danger text-muted fa-trash fa-xl"></i>
                                                                @else
                                                                    <form id="confirmDelete{{ $employee->id }}"
                                                                        action="{{ route('employees.destroy', $employee->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete{{ $employee->id }}"><i
                                                                                class="fa-solid text-danger fa-trash fa-xl"></i></button>
                                                                    </form>
                                                                @endif
                                                            </td>



                                                        </tr>
                                                        <div class="modal fade" id="delete{{ $employee->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">@lang('messages.confirmation')</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('messages.delete_text')
                                                                        </p>
                                                                        <div>@lang('messages.employee_id') :
                                                                            {{ $employee->employee_id }} </div>
                                                                        <div>@lang('messages.employee_name') :
                                                                            {{ $employee->employee_name }}</div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">@lang('messages.cancel')</button>

                                                                        <button form="confirmDelete{{ $employee->id }}"
                                                                            type="submit"
                                                                            class="btn btn-info">@lang('messages.ok')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="active{{ $employee->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">@lang('messages.confirmation')</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('messages.active_text')
                                                                        </p>
                                                                        <div>@lang('messages.employee_id') :
                                                                            {{ $employee->employee_id }} </div>
                                                                        <div>@lang('messages.employee_name') :
                                                                            {{ $employee->employee_name }}</div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">@lang('messages.cancel')</button>

                                                                        <button form="confirmActive{{ $employee->id }}"
                                                                            type="submit"
                                                                            class="btn btn-info">@lang('messages.ok')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="inactive{{ $employee->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">@lang('messages.confirmation')</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('messages.inactive_text')
                                                                        </p>
                                                                        <div>@lang('messages.employee_id') :
                                                                            {{ $employee->employee_id }} </div>
                                                                        <div>@lang('messages.employee_name') :
                                                                            {{ $employee->employee_name }}</div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">@lang('messages.cancel')</button>

                                                                        <button form="confirmInactive{{ $employee->id }}"
                                                                            type="submit"
                                                                            class="btn btn-info">@lang('messages.ok')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if ($employees->isEmpty())
                                                        <tr>
                                                            <td colspan="9">
                                                                @lang('messages.search_no_data')
                                                            </td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            {{ $employees->links() }}
                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
