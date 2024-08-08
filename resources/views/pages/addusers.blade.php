@extends('layouts.app')

@section('content')
<div>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">
      <form id="userForm" enctype="multipart/form-data">
        @csrf
        <!-- <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"> -->
        <div class="p-4 mb-4 bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Add user</h3>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">


                    <label for="usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                    <select id="usertype" name="usertype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Select a user type</option>
                        @foreach($usertypelist as $value)
                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                  <label for="activestatus" class="block mb-3 px-2 text-sm font-medium text-gray-900 dark:text-white">Active Status</label>
                        <div class="flex">
                            <div class="flex items-center">
                                <input id="default-radio-1" type="radio" value="1" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="w-full ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
                            </div>
                            <div class="flex items-center ps-4">
                                <input checked id="default-radio-2" type="radio" value="0" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="w-full ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inactive</label>
                            </div>
                        </div>
                </div>
              <div class="w-full">
                  <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                  <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                  <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                  <input type="text" name="company" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                  <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="primary_contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary Contact</label>
                  <input type="tel" name="primary_contact" id="primary_contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="secondary_contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Secondary Contact</label>
                  <input type="tel" name="secondary_contact" id="secondary_contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                  <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                  <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                  <span id="errorMessage" class="font-semibold text-red-500"></span>


                </div>


            <div class="w-full">
                
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Avatar</label>
                <input name="avatar" onchange="displaySelectedImage(event)" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="avatar" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

                <button onclick="cancelSelectedImage()" type="button" class="inline-flex items-center px-3 py-2 ml-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Cancel
                </button>
                <p id="selectedImageText" class="hidden mt-1 text-sm text-gray-500">Selected image: <span id="selectedImageName"></span></p>
                <img id="selectedImagePreview" class="hidden mt-2" src="" alt="Selected Image Preview" style="max-width: 200px; max-height: 200px;">
            </div>

            <div class="w-full">
            <div class="flex p-4 mb-2 mt-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Ensure that these requirements are met:</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            <li id="minLength"><i class="fas fa-times 
                                text-red-500"></i> Minimum 8 characters</li>
                            <li id="uppercase"><i class="fas fa-times 
                                text-red-500"></i> At least one uppercase letter</li>
                            <li id="lowercase"><i class="fas fa-times
                                text-red-500"></i> At least one lowercase letter</li>
                            <li id="symbol"><i class="fas fa-times
                                text-red-500"></i> At least one symbol (@$!%*?&)</li>
                        </ul>
                    </div>
                </div>
                
            </div>

          </div>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">

          <button type="button" id="submitButton" onclick="submitForm()" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
              Submit
          </button>
            <button onclick="refresh()" type="button" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
              Cancel
          </button>
          <button onclick="userspage()" type="button" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
              Back to users
          </button>
      </form>
  </div>
  </div>
</section>

</div>



<script>


    function submitForm() {

        // Check if the required fields are filled
        let requiredFields = ['#usertype', '#first_name', '#username', '#company', '#email', '#primary_contact', '#password'];
        let allFieldsFilled = true;

        requiredFields.forEach(function(selector) {
            if ($(selector).val() === '') {
                allFieldsFilled = false;
            }
        });

        // Check if a radio button is selected
        if (!$('input[name="inline-radio-group"]:checked').val()) {
            allFieldsFilled = false;
        }

        if (!allFieldsFilled) {
            bootbox.alert({
                message: "Please fill in all required fields and select an active status.",
                backdrop: true,
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            return;
        }

        // Validate password requirements
        const password = $('#password').val();
        const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!strongPasswordRegex.test(password)) {
            bootbox.alert({
                message: "Password does not meet the requirements.",
                backdrop: true,
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            return;
        }


        const formData = new FormData(document.getElementById('userForm'));
        const fileInput = document.getElementById('avatar');

        // Append the selected file to the FormData object
        if (fileInput.files.length > 0) {
            formData.append('avatar', fileInput.files[0]);
        }

        // Append the other form fields to the FormData object
        formData.append('_token', $('input[name="_token"]').val());
        formData.append('usertype', $('select[name="usertype"]').val());
        formData.append('username', $('input[name="username"]').val());
        formData.append('firstname', $('input[name="first_name"]').val());
        formData.append('lastname', $('input[name="last_name"]').val());
        formData.append('company', $('input[name="company"]').val());
        formData.append('email', $('input[name="email"]').val());
        formData.append('primary_contact', $('input[name="primary_contact"]').val());
        formData.append('secondary_contact', $('input[name="secondary_contact"]').val());
        formData.append('password', $('input[name="password"]').val());
        formData.append('inline-radio-group', $('input[name="inline-radio-group"]:checked').val());

        $.ajax({
            url: '{{url('adduser')}}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                var alertArea = document.getElementById('alertArea');
                if(response.status == "success") {
                    bootbox.alert({
                        message: response.message,
                        backdrop: true,
                        callback: function () {
                            refresh();
                        }
                    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");

                } else if(response.status == "error"){
                    bootbox.alert({
                        message: response.message,
                        backdrop: true,
                        callback: function () {}
                    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
    // Parse the JSON response to get the error messages
    var response = jqXHR.responseJSON;

    // Default error message
    var errorMessage = 'Form submission failed.';

    // Check if there are validation errors
    if (response && response.errors) {
        // Collect all error messages
        var errorMessages = [];
        var errors = response.errors;
        for (var field in errors) {
            if (errors.hasOwnProperty(field)) {
                errorMessages.push(errors[field][0]); // Add each error message to the array
            }
        }

        // Join all error messages into a single string
        errorMessage = errorMessages.join('<br>'); // Using <br> to create new lines between messages
    }

    // Show the error message(s) in a bootbox alert
    bootbox.alert({
        message: errorMessage,
        backdrop: true,
        callback: function () {}
    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
}

        });
    }

    
function userspage() {
    location.href = '{{url('users')}}';
}



    function refresh(){

        $('#userForm')[0].reset();
    }



    $('#password').on('input', function () {
        const password = $(this).val();
        const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Check if all password conditions are met
        const isStrongPassword = strongPasswordRegex.test(password);

        // Update the submit button state
        $('#submitButton').prop('disabled', !isStrongPassword);

        // Update the password strength message
        const errorMessage = $('#errorMessage');
        $('#minLength').html(password.length >= 8 ? '<i class="fas fa-check text-green-500"></i> Minimum 8 characters' : '<i class="fas fa-times text-red-500"></i> Minimum 8 characters');
        $('#uppercase').html(/[A-Z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one uppercase letter' : '<i class="fas fa-times text-red-500"></i> At least one uppercase letter');
        $('#lowercase').html(/[a-z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one lowercase letter' : '<i class="fas fa-times text-red-500"></i> At least one lowercase letter');
        $('#symbol').html(/[@$!%*?&]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one symbol (@$!%*?&)' : '<i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)');

        // Update the error message based on password strength
        errorMessage.text(isStrongPassword ? 'Strong Password' : 'Weak Password').toggleClass('text-red-500', !isStrongPassword).toggleClass('text-green-500', isStrongPassword);
    });

	</script>
<script>
    function displaySelectedImage(event) {
        const input = event.target;
        const imageName = input.files[0].name;
        document.getElementById('selectedImageName').textContent = imageName;
        document.getElementById('selectedImageText').classList.remove('hidden');

        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('selectedImagePreview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }

    function cancelSelectedImage() {
        document.getElementById('avatar').value = '';
        document.getElementById('selectedImageText').classList.add('hidden');
        document.getElementById('selectedImagePreview').classList.add('hidden');
    }
</script>

@endsection