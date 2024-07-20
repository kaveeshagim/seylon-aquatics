@extends('layouts.app')

@section('content')
<div>
    <div id="alertArea" class="z-2"></div>

    <h4 class="text-2xl font-bold dark:text-white">Reset Password - <?php echo $data->id ?></h4>
    <hr class="w-full h-1 my-4 bg-gray-900 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="mb-5"></div>

    <form id="resetpasswordForm">
    @csrf
        
        <input hidden="true" type="text" id="user_id" name="user_id" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=<?php echo $data->user_id ?> required/>
        <input hidden="true" type="text" id="req_id" name="req_id" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=<?php echo $data->id ?> required/>

        <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" id="username" name="username" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=<?php echo $data->user->username ?> required/>
        </div>

        <div>
            <label for="oldpswd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old Password</label>
            <input type="text" id="oldpswd" name="oldpswd" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=<?php echo $data->cur_password ?> required/>
        </div>

        <div>
            <label for="newpswd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password <span id="errorMessage" class="font-semibold text-red-500"></span></label>
            <input type="text" id="newpswd" name="newpswd" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required/>
        
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
        
        <br>

    
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        <button onclick="refresh()" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Cancel</button>
    </form>

</div>


<script>

$(document).ready(function() {
    $('#resetpasswordForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: '{{ url("editnewpassword") }}',
            type: 'POST',
            data: $(this).serialize(), 
            success: function(response) {
                console.log(response);
                var alertArea = document.getElementById('alertArea');

                if(response === "success"){

                    var successAlert = `<div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                        User Type updated.
                        </div>
                        <button id="dismiss-button" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        </button>
                    </div>`;

                    alertArea.innerHTML = successAlert;
                    window.location.reload();


                }else{

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Form submission failed:', textStatus, errorThrown);
            }
        });
    });
});


$('#newpswd').on('input', function () {
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

    
</script>

<script>
    function refresh(){

        $('#resetpasswordForm')[0].reset();
    }
</script>

<script type="module">

    document.addEventListener('DOMContentLoaded', function() {
        dismissAlert('alert-border-2', 'dismiss-button');
    });
</script>

@endsection