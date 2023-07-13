@php
    $currentUrl = url()->current();
    $previousUrl = url()->previous();
    if ($currentUrl != $previousUrl) {
        Session::put('back-previous', $previousUrl);
    }
@endphp

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
                        <a href="{{ Session::get('back-previous') }}" type="button" class="btn btn-dark back-btn float-end">
                            <i class="fa-solid fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('employees.update', $employee->id, $employee->employee_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                    <label for="" class="text-muted form-label">@lang('messages.employee_id')</label><span
                                        class="text-danger">*</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="employee_id" id="" class="form-control"
                                        value="{{ $employee->employee_id }}" readonly>
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
                                        value="{{ old("employee_code",$employee->employee_code) }}">
                                    @error('employee_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                        value="{{ old("employee_name",$employee->employee_name) }}">
                                    @error('employee_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                        value="{{ old("nrc_number",$employee->nrc_number) }}">
                                    @error('nrc_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                         value="{{ old("email_address",$employee->email_address)}}">
                                    @error('email_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                        <input class="form-check-input" type="radio" name="gender" id="gender1"
                                            value="1" {{ old("gender",$employee->gender) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender1">@lang('messages.male')</label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2"
                                            value="2" {{ old("gender",$employee->gender) == 2 ? 'checked' : '' }}>
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
                                        value="{{ old("date_of_birth",$employee->date_of_birth) }}">
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="marital_status" class="text-muted form-label">@lang('messages.marital_status')</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="marital_status" id="marital_status" class="form-control">
                                        <option value="">---@lang('messages.select')---</option>
                                        <option value="1" {{ old("marital_status",$employee->marital_status) == 1 ? 'selected' : '' }}>
                                            @lang('messages.single')</option>
                                        <option value="2" {{ old("marital_status",$employee->marital_status) == 2 ? 'selected' : '' }}>
                                            @lang('messages.married')</option>
                                        <option value="3" {{ old("marital_status",$employee->marital_status) == 3 ? 'selected' : '' }}>
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
                                    <textarea name="address" id="" cols="10" rows="3" class="form-control">{{ old("address",$employee->address) }}</textarea>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label for="" class="text-muted form-label">@lang('messages.upload_photo')</label>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <input type="file" accept="image/*" name="photo" id="imgInp"
                                            class="form-control">
                                        <button type="button" id="removeButton"
                                            class="btn btn-danger float-end btn-sm d-none">@lang('messages.remove')</button>
                                    </div>
                                    <img id="previewImage" src="" alt=""
                                        class="mt-3 object-fit-cover w-25" />
                                    @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">

                                </div>
                            </div>
                            <div class="row my-3 text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info search-btn">@lang('messages.update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        // preview the upload image and remove this
        $(document).ready(function() {
            $('#imgInp').on('change', function(evt) {
                var file = evt.target.files[0];
                if (file) {
                    // previewImage.show();
                    $('#previewImage').attr('src', URL.createObjectURL(file));
                    //if file have, show remove btn
                    $('#removeButton').removeClass('d-none');
                }
            });
        });

        $(document).ready(function() {
            // Target the remove button
            $('#removeButton').click(function() {
                // Target the preview image and remove it
                $('#previewImage').attr('src', '');
                // Clear the file name from the input file element
                $('#imgInp').val('');
                //if no have file, hide remove btn
                $('#removeButton').addClass('d-none');

            });
        });
    </script>
@endsection
