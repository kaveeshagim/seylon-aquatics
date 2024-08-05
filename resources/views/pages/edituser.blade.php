@extends('layouts.app')

@section('content')
<div>


<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">
    <form id="usereditForm" enctype="multipart/form-data">
    @csrf
    <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="mb-4 text-xl font-semibold dark:text-white">Edit user</h3>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="w-full">
            <label for="usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
            <select id="usertype" name="usertype" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select user type -</option>
                @foreach($usertypelist as $value)
                    <option value="{{ $value->id }}" @if($value->id == $data->user_type) selected @endif>
                        {{ $value->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" id="username" name="username" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->username ?>"  required/>
        </div>
        <div class="w-full">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
            <input type="text" id="firstname" name="firstname" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->fname ?>" />
        </div>
        <<div class="w-full">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
            <input type="text" id="lastname" name="lastname" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="<?php echo $data->lname ?>"/>
        </div>
        <div class="w-full">
            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
            <input type="text" id="company" name="company" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->company ?>" />
        </div>  
        <div class="w-full">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
            <input type="email" id="email" name="email" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->email ?>" />
        </div> 
        <div class="w-full">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
            <input type="tel" id="primary_contact" name="primary_contact" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->primary_contact ?>" />
        </div>
        <div class="w-full">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number 2</label>
            <input type="tel" id="secondary_contact" name="secondary_contact" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->secondary_contact ?>"/>
        </div>
        <div class="w-full">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password <span id="errorMessage" class="font-semibold text-red-500"></span></label>
            <input type="password" id="password" name="password" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $data->password ?>" required />
            
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
            <span id="errorMessage" class="font-semibold text-red-500"></span>


        </div> 

        <div class="w-full">
            <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="displaySelectedImage(event)">
            <button type="button" onclick="document.getElementById('avatar').click()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block">Select Image</button>
            <button onclick="cancelSelectedImage()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-block ml-2">Cancel</button>
            <p id="selectedImageText" class="hidden mt-1 text-sm text-gray-500">Selected image: <span id="selectedImageName"></span></p>
            <img id="selectedImagePreview" class="mt-2" src="{{ asset('storage/' . $data->avatar) }}" alt="Selected Image Preview" style="max-width: 200px; max-height: 200px;">
        </div>



        
        <div class="w-full">
            <label for="activestatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Active Status</label>
            <div class="flex">
                <div class="flex items-center me-4">
                    <input id="active" type="radio" value="1" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if ($data->active_status == 1) echo 'checked'; ?> >
                    <label for="active" name="activestatus" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="inactive" type="radio" value="0" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if ($data->active_status == 0) echo 'checked'; ?>> 
                    <label for="inactive" name="activestatus" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inactive</label>
                </div>
            </div>
        </div>

    </div>
    <button id="submitButton" type="button" onclick="submitForm()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    <button onclick="refresh()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
        Cancel
    </button>
    <button onclick="userspage()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
        Back to users
    </button>
    </form>
    </div>
  </div>
</section>

</div>

<script>

$(document).ready(function() {
    $('#usereditForm').submit(function(event) {
        event.preventDefault();

        const formData = new FormData();
        const fileInput = document.getElementById('avatar');

        // Append the selected file to the FormData object
        if (fileInput.files.length > 0) {
            formData.append('avatar', fileInput.files[0]);
        }

        // Append the other form fields to the FormData object
        formData.append('_token', $('input[name="_token"]').val());
        formData.append('usertype', $('select[name="usertype"]').val());
        formData.append('userid', $('input[name="userid"]').val());
        formData.append('username', $('input[name="username"]').val());
        formData.append('firstname', $('input[name="firstname"]').val());
        formData.append('lastname', $('input[name="lastname"]').val());
        formData.append('company', $('input[name="company"]').val());
        formData.append('email', $('input[name="email"]').val());
        formData.append('primary_contact', $('input[name="primary_contact"]').val());
        formData.append('secondary_contact', $('input[name="secondary_contact"]').val());
        formData.append('password', $('input[name="password"]').val());
        formData.append('inline-radio-group', $('input[name="inline-radio-group"]:checked').val());

        $.ajax({
            url: '{{ url("edituser") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                var alertArea = document.getElementById('alertArea');

                if (response == "failed") {
                    $("#alert-2").removeClass("hidden").addClass("block");
                    // Scroll to the top of the page
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                } else {
                    $("#alert-3").removeClass("hidden").addClass("block");
                    // Scroll to the top of the page
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    // window.location.reload();
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Form submission failed:', textStatus, errorThrown);
            }
        });
    });
});

function userspage() {
    location.href = '{{url('users')}}';
}
    
</script>

<script>
    function refresh(){

        $('#usereditForm')[0].reset();
    }
</script>
<script>
$(document).ready(function() {
    function validatePassword() {
        const password = $('#password').val();
        const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Check if all password conditions are met
        const isStrongPassword = password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[@$!%*?&]/.test(password);

        // Update the submit button state
        $('#submitButton').prop('disabled', !isStrongPassword);

        // Update the password strength message
        $('#minLength').html(password.length >= 8 ? '<i class="fas fa-check text-green-500"></i> Minimum 8 characters' : '<i class="fas fa-times text-red-500"></i> Minimum 8 characters');
        $('#uppercase').html(/[A-Z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one uppercase letter' : '<i class="fas fa-times text-red-500"></i> At least one uppercase letter');
        $('#lowercase').html(/[a-z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one lowercase letter' : '<i class="fas fa-times text-red-500"></i> At least one lowercase letter');
        $('#symbol').html(/[@$!%*?&]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one symbol (@$!%*?&)' : '<i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)');

        // Update the error message based on password strength
        const errorMessage = $('#errorMessage');
        errorMessage.text(isStrongPassword ? 'Strong Password' : 'Weak Password')
                    .toggleClass('text-red-500', !isStrongPassword)
                    .toggleClass('text-green-500', isStrongPassword);
    }

    // Attach the validatePassword function to the input event
    $('#password').on('input', validatePassword);

    // Call the validatePassword function on page load
    validatePassword();
});
</script>

<!-- <script>
$('#password').on('input', function () {
    const password = $(this).val();
    const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    // Check if all password conditions are met
    const isStrongPassword = password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[@$!%*?&]/.test(password);

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

	</script> -->
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