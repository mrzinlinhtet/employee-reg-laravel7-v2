<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        .toggle-password {
        cursor: pointer;
        position: relative;
        user-select: none;
        }


    </style>
    <title>
    @yield('title')
    </title>

    @yield('nav')
</head>
<body>

    @if (session()->has('employee'))
        @include('layouts.nav')
    @endif

    @yield('content')


    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    {{-- <script>
        $(document).ready(function() {
            $('input[type=radio]').change(function() {
                $('#radio-form').submit();
            });
        });
    </script> --}}
     <script>
        function generatePassword() {
          var length = Math.floor(Math.random() * 5) + 4; // Random length between 4 and 8
          var lowercase = "abcdefghijklmnopqrstuvwxyz";
          var uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          var numbers = "0123456789";
          var specialChars = "!@#$%^&*()";
          var charset = lowercase + uppercase + numbers + specialChars; // Combined character set
          var password = "";

          // Ensure the password contains at least one character from each required category
          password += getRandomChar(lowercase);
          password += getRandomChar(uppercase);
          password += getRandomChar(numbers);
          password += getRandomChar(specialChars);

          // Generate the remaining characters of the password
          for (var i = 0; i < length - 4; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset.charAt(randomIndex);
          }

          var passwordInput = document.getElementById("passwordInput");
          passwordInput.value = password;
        }

        function getRandomChar(charset) {
          var randomIndex = Math.floor(Math.random() * charset.length);
          return charset.charAt(randomIndex);
        }
      </script>
    <script>
        $(document).ready(function() {
            $('input[name="formSelector"]').on('change', function() {
                var selectedFormId = $(this).val();

                // Hide all forms
                $('.form').hide();

                // Show the selected form
                $('#' + selectedFormId).show();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
          $('#form2').submit(function(event) {
            event.preventDefault(); // Prevent form from submitting normally

            var formData = new FormData();
            var imageFile = $('#imageInput')[0].files[0];
            formData.append('image', imageFile);

            $.ajax({
              url: 'upload.php', // Replace with the server-side script URL
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                // Handle the server response
                console.log(response);
              },
              error: function(xhr, status, error) {
                // Handle errors
                console.log(xhr.responseText);
              }
            });
          });
        });
      </script>
      <script>
        const passwordInput = document.getElementById("passwordInput");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.innerHTML = "👁️";
        } else {
            passwordInput.type = "password";
            togglePassword.innerHTML = "👁️";
        }
        });

      </script>

    @yield('footer')
</body>
</html>
