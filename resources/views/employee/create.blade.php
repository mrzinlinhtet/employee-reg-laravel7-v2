@extends('layouts.app')

@section('title')
    @lang('messages.employee_registration_system')
@endsection

@section('content')
    <div class="container mt-3">
        @error('import_file')
            <div class="alert alert-danger" role="alert">
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                <span><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
            </div>
        @enderror
        @if (session()->has('error'))
            @if (is_array(session('error')))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    @foreach (session()->get('error') as $error)
                        <div><i class="fa-solid fa-triangle-exclamation"></i> {{ $error['error'] }}</div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <span><i class="fa-solid fa-triangle-exclamation"></i> {{ session()->get('error') }}</span>
                </div>
            @endif
        @elseif(session()->has('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                <span><i class="fa-solid fa-circle-check"></i> {{ session()->get('success') }}</span>
            </div>
        @endif
        <form method="get" id="radio-form" action="{{ route('employees.create') }}">
            <div class="card">
                <div class="card-body">
                    <div class="row my-3 mx-3">
                        <div class="col-md-6 form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" {{ request()->formSelector == 'form1' ? 'checked' : '' }}
                                    type="radio" name="formSelector" value="form1">
                                @lang('messages.normal_register')
                            </label>
                        </div>
                        <div class="col-md-6 form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" {{ request()->formSelector == 'form2' ? 'checked' : '' }}
                                    type="radio" name="formSelector" value="form2">
                                @lang('messages.excel_register')
                            </label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" id="radioBtn" hidden></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container my-3">
        <div class="card">
            <div class="card-body">
                @if (request()->formSelector == 'form1')
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('employees.store') }}" method="POST" id="form1" class="form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row my-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <label for="" class="text-muted form-label">@lang('messages.employee_id')</label><span
                                            class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="employee_id" class="form-control"
                                            value="{{ $empId }}" readonly>
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
                                        <input type="text" name="employee_code" class="form-control"
                                            value="{{ old('employee_code') }}">
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
                                        <input type="text" name="employee_name" class="form-control"
                                            value="{{ old('employee_name') }}">
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
                                        <input type="text" name="nrc_number" class="form-control"
                                            value="{{ old('nrc_number') }}">
                                        @error('nrc_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <label for="" class="text-muted form-label">@lang('messages.password')</label><span
                                            class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="password" id="passwordInput" name="password"
                                                class="form-control" value="{{ old('password') }}">
                                            <span id="togglePassword" class="toggle-password input-group-text"><i
                                                    class="fas fa-eye"></i></span>
                                            <a class="btn btn-outline-dark float-end btn-sm pt-2"
                                                onclick="generatePassword()">@lang('messages.generate_password')</a>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <span class="float-start text-danger fw-light mt-1">
                                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            @lang('messages.password_validate')
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <label for=""
                                            class="text-muted form-label">@lang('messages.employee_email')</label><span
                                            class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="email_address" class="form-control"
                                            value="{{ old('email_address') }}">
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
                                                value="1" {{ old('gender') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender1">@lang('messages.male')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2"
                                                value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender2">@lang('messages.female')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <label for=""
                                            class="text-muted form-label">@lang('messages.date_of_birth')</label><span
                                            class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="date" name="date_of_birth" class="form-control"
                                            value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <label for="marital_status"
                                            class="text-muted form-label">@lang('messages.marital_status')</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select name="marital_status" id="marital_status" class="form-control">
                                            <option value="">---@lang('messages.select')---</option>
                                            <option value="1" {{ old('marital_status') == 1 ? 'selected' : '' }}>
                                                @lang('messages.single')
                                            </option>
                                            <option value="2" {{ old('marital_status') == 2 ? 'selected' : '' }}>
                                                @lang('messages.married')
                                            </option>
                                            <option value="3" {{ old('marital_status') == 3 ? 'selected' : '' }}>
                                                @lang('messages.divorce')
                                            </option>
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
                                        <textarea name="address" cols="10" rows="3" class="form-control">{{ old('address') }}</textarea>
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
                                                class="form-control" value="{{ old('photo') }}">
                                            <button type="button" id="removeButton"
                                                class="btn btn-danger float-end btn-sm d-none">@lang('messages.remove')</button>
                                        </div>
                                        <img id="previewImage" src="" alt=""
                                            class="mt-3 object-fit-cover w-25" />
                                        @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row my-3 text-center">
                                    <div class="col-12">
                                        <button style="width: 130px;" type="submit"
                                            class="btn btn-primary search-btn">@lang('messages.save')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if (request()->formSelector == 'form2')
                    <div class="row">
                        <span id="togglePassword" class="toggle-password input-group-text d-none"><i
                                class="fas fa-eye"></i></span>
                        <div class="col-12">
                            <form id="form2" action="{{ route('reg-import') }}" method="POST" class="form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('reg-export') }}"
                                            class="btn btn-success btn-sm float-end mb-2"><i
                                                class='fa-solid fa-file-excel'></i> @lang('messages.excel_download_format')</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12">
                                            <div class="file-upload">
                                                <div class="image-upload-wrap">
                                                    <input accept=".xls, .xlsx" class="file-upload-input"
                                                        name="import_file" type='file' onchange="readURL(this);" />
                                                    <div class="drag-text">
                                                        <h5 class="dragText"> @lang('messages.browse')</h5>
                                                        <img class="file-upload-image" src="#" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <span class="image-title"></span>
                                        <div class="file-upload-content">
                                            <div class="image-title-wrap mt-1">
                                                <button type="button" onclick="removeUpload()"
                                                    class="remove-image btn btn-danger"> @lang('messages.remove')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-12 text-center">
                                        <button style="width: 130px;" type="submit" class="btn btn-primary search-btn">
                                            @lang('messages.save')</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        //to change register form
        $(document).ready(function() {
            $('input[name="formSelector"]').on('click', function() {
                var selectedFormId = $(this).val();
                $('#radioBtn').click()

            });
        });
    </script>
    <script>
        // import excel file and remove this
        function readURL(input) {
            if (input.files && input.files[0]) {
                $('.file-upload-image').attr('src', '../../images/excel.png');

                var reader = new FileReader();

                reader.onload = function(e) {

                    $('.file-upload-content').show();
                    $('.image-title').show();
                    $('.dragText').hide();
                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            // $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-input').val('');
            $('.file-upload-content').hide();
            $('.image-title').hide();
            $('.image-upload-wrap').show();
            $('.dragText').show();
            $('.file-upload-image').attr('src', '');

        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
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
    <script>
        // password generate
        const password = document.getElementById('passwordInput');

        function generatePassword() {
            let length = Math.floor(Math.random() * 5) + 4; // Random length between 4 and 8
            let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
        let dummyPassword = "";

        // Ensure at least one character from each category
        dummyPassword += getRandomCharacter("abcdefghijklmnopqrstuvwxyz"); // Small letter
        dummyPassword += getRandomCharacter("ABCDEFGHIJKLMNOPQRSTUVWXYZ"); // Capital letter
        dummyPassword += getRandomCharacter("0123456789"); // Number
        dummyPassword += getRandomCharacter("!@#$%^&*()_+~`|}{[]:;?><,./-="); // Special character

            // Generate remaining characters randomly
            for (let i = 4; i < length; i++) {
                let randomIndex = Math.floor(Math.random() * charset.length);
                dummyPassword += charset[randomIndex];
            }

            password.value = dummyPassword;
        }

        function getRandomCharacter(charset) {
            let randomIndex = Math.floor(Math.random() * charset.length);
            return charset[randomIndex];
        }
    </script>
    <script>
        // password toggle
        const passwordInput = $("#passwordInput");
        const togglePassword = $("#togglePassword");

        togglePassword.on('click', function() {
            if (passwordInput.attr('type') === "password") {
                passwordInput.attr('type', 'text');
                togglePassword.html('<i class="fas fa-eye-slash"></i>');
            } else {
                passwordInput.attr('type', 'password');
                togglePassword.html('<i class="fas fa-eye"></i>');
            }
        });
    </script>
@endsection
