@extends('layouts.app')

@section('title')
    @lang('messages.employee_registration_system')
@endsection

@section('content')
    <div class="container my-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <a href="{{ Session::get('previous-url-detail' . $employee->id) }}" type="button"
                            class="btn btn-dark back-btn float-end back-loading">
                            <i class="fa-solid fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form>
                            @if (!empty($emp_id->file_name))
                                <div class="row my-2">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <img src="{{ asset('uploads/' . $emp_id->file_name) }}" alt=""
                                            class="img-fluid img-thumbnail w-25 rounded">
                                    </div>
                                </div>
                            @elseif (empty($emp_id->file_name))
                                <div class="row my-2">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <img src="{{ asset('images/user.png') }}" alt=""
                                            class="img-fluid img-thumbnail w-25 rounded">
                                    </div>
                                </div>
                            @endif
                            <div class="row my-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.employee_id')
                                    </label><span class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="employee_id" id="" class="form-control" disabled
                                        value="{{ $employee->employee_id }}">
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.employee_code')</label><span
                                        class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="employee_code" id="" class="form-control"
                                        placeholder="Enter Employee Code" disabled value="{{ $employee->employee_code }}">
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.employee_name')</label><span
                                        class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="employee_name" id="" class="form-control"
                                        placeholder="Enter Employee Name" disabled value="{{ $employee->employee_name }}">
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.nrc_number')</label><span
                                        class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="nrc_number" id="" class="form-control"
                                        placeholder="Enter NRC Number" disabled value="{{ $employee->nrc_number }}">
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.employee_email')</label><span
                                        class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="email_address" id="" class="form-control"
                                        placeholder="Enter Email" disabled value="{{ $employee->email_address }}">
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="gender" class="text-muted form-label">@lang('messages.gender')</label>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" disabled type="radio" name="gender"
                                            id="gender1" value="1" {{ $employee->gender == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender1">@lang('messages.male')</label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" disabled type="radio" name="gender"
                                            id="gender2" value="2" {{ $employee->gender == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender2">@lang('messages.female')</label>
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.date_of_birth')</label><span
                                        class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="date_of_birth" id="" class="form-control"
                                        disabled placeholder="Enter Employee Email"
                                        value="{{ $employee->date_of_birth }}">
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="marital_status" class="text-muted form-label">@lang('messages.marital_status')</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="marital_status" id="marital_status" class="form-control" disabled>
                                        <option value="">---@lang('messages.select')---</option>
                                        <option value="1" {{ $employee->marital_status == 1 ? 'selected' : '' }}>
                                            @lang('messages.single')</option>
                                        <option value="2" {{ $employee->marital_status == 2 ? 'selected' : '' }}>
                                            @lang('messages.married')</option>
                                        <option value="3" {{ $employee->marital_status == 3 ? 'selected' : '' }}>
                                            @lang('messages.divorce')</option>
                                    </select>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.address')</label>
                                </div>
                                <div class="col-md-5">
                                    <textarea name="address" id="" cols="10" disabled rows="3" class="form-control">{{ $employee->address }}</textarea>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
