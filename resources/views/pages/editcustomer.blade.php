@extends('layouts.app')

@section('content')
<div>


<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">
    <form id="customerForm" enctype="multipart/form-data">
    @csrf
    <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="mb-4 text-xl font-semibold dark:text-white">Edit customer</h3>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="w-full">

                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a title</label>
                    <select id="title"  name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">- Select title -</option>
                        <option value="Mr." @if($data->title == "Mr.") selected @endif >Mr.</option>
                        <option value="Ms." @if($data->title == "Ms.") selected @endif>Ms.</option>
                        <option value="Mrs." @if($data->title == "Mrs.") selected @endif>Mrs.</option>
                    </select>
                </div>
              <div class="w-full">
                  <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                  <input type="text" name="first_name" id="first_name" value="{{$data->fname}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                  <input hidden type="text" name="cus_id" id="cus_id" value="{{$data->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>

              </div>
              <div class="w-full">
                  <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                  <input type="text" name="last_name" id="last_name" value="{{$data->lname}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
              </div>
              <div class="w-full">
                  <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                  <input type="text" name="company" id="company" value="{{$data->company}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
              </div>
              <div class="w-full">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                  <input type="email" name="email" id="email" value="{{$data->email}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
              </div>
              <div class="w-full">
                  <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                  <input type="text" name="country" id="country" value="{{$data->country}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
              </div>
              <div class="w-full">
                  <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                  <input type="text" name="address" id="address" value="{{$data->address}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
              </div>
              <div class="w-full">
                  <label for="primary_contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary Contact</label>
                  <input type="tel" name="primary_contact" id="primary_contact" value="{{$data->primary_contact}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
              </div>
              <div class="w-full">
                  <label for="secondary_contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Secondary Contact</label>
                  <input type="tel" name="secondary_contact" id="secondary_contact" value="{{$data->secondary_contact}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              </div>
              <div class="w-full">
                    <label for="cususer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Account</label>
                    <select id="cususer"  name="cususer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">- Select user account -</option>
                        @foreach($cususeraccounts as $value)
                        <option value="{{ $value->id }}" @if($value->id == $data->username) selected @endif>
                            {{ $value->username }}
                        </option>
                        @endforeach
                    </select>
             </div>
              <div class="w-full">
                    <label for="executive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Executive in-charge</label>
                    <select id="executive"  name="executive" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">- Select executive in charge -</option>
                        @foreach($executivelist as $value)
                        <option value="{{ $value->id }}" @if($value->id == $data->executive_id) selected @endif>
                            {{ $value->username }}
                        </option>
                        @endforeach
                    </select>
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
    
            <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

          <button type="button" id="submitButton" onclick="submitForm()" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
              Submit
          </button>
            <button type="button" onclick="refresh()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
              Cancel
          </button>
          <button type="button" onclick="customerspage()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
              Back to customers
          </button>
      </form>
  </div>
  </div>
</section>

</div>

<script>

function submitForm(){

        // Check if all required fields are filled
        let isValid = true;
        let requiredFields = ['#title', '#first_name', '#last_name', '#company', '#email', '#country', '#address', '#primary_contact','#cususer', '#executive'];
        
        requiredFields.forEach(function(field) {
            if ($(field).val() === '') {
                isValid = false;
            }
        });

        // Check if a radio button is selected
        if (!$('input[name="inline-radio-group"]:checked').val()) {
            isValid = false;
        }


        if (!isValid) {
            bootbox.alert({
                message: 'Please fill in all required fields.',
                backdrop: true
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            return; // Stop form submission
        }

        // If all required fields are filled, proceed with AJAX submission
        const formData = new FormData(document.getElementById('customerForm'));
        formData.append('inline-radio-group', $('input[name="inline-radio-group"]:checked').val());

        $.ajax({
            url: '{{url('editcustomer')}}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status == "success") {
                    bootbox.alert({
                        message: response.message,
                        backdrop: true,
                        callback: function () {
                            window.location.reload();
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

function customerspage() {
    location.href = '{{url('customers')}}';
}

    
</script>

<script>
    function refresh(){

        $('#customerForm')[0].reset();
    }
</script>



@endsection