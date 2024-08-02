@extends('layouts.app')

@section('content')

<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">

<div id="toast-success" class="hidden flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-gray-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">Order added successfully.</div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-50 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Add Order</span>
                    </h5>
                    
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose upload method</h3>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-gray-50 border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="horizontal-list-radio-license" type="radio" value="" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Excel Upload</label>
                        </div>
                    </li>
                    <li class="w-full dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="horizontal-list-radio-passport" type="radio" value="" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-passport" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Form Submission</label>
                        </div>
                    </li>
                </ul>


            </div>

            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">

                <!-- form upload -->
                 <form id="addorderform" enctype="multipart/form-data">
    @csrf
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="w-full">

                    <label for="fishvariety" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a title</label>
                    <select id="fishvariety"  name="fishvariety" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">- Select fishvariety -</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>
                    </select>
                </div>
              <div class="w-full">
                  <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                  <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="orders" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Orders</label>
                  <input type="text" name="orders" id="orders" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>
              <div class="w-full">
                  <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                  <input type="text" name="size" id="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
              </div>





       
            </div>
    
            <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">
    <button type="button" id="addOrderButton" class="inline-flex items-center px-5 py-2.5 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
        Add Order
    </button>
          <button type="submit" id="submitButton" onclick="addorderform()" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800" disabled>
              Submit
          </button>
            <button onclick="refreshform()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
              Cancel
          </button>
      </form>
                      <!-- form upload -->


                <!-- excel upload -->
                <form id="addorderexcel" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="excel_input">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="excel_input_help" id="excel_input" name="excel_input" type="file" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="excel_input_help">XLS.F (MAX. 800x400px).</p>
                        </div>
                    </div>

                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

                    <button type="button" onclick="addorderexcel()" id="submitButton" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
                        Submit
                    </button>
                    <button type="button" onclick="refreshexcel()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                        Cancel
                    </button>
                </form>
                <!-- excel upload -->

            </div>
    </div>
</section>
<!-- End block -->

<script>

function addorderexcel() {
    const form = document.getElementById('addorderexcel');
    const formData = new FormData(form);

    $.ajax({
        url: '{{ url("addorderexcel") }}', // Ensure this URL matches your route
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle success response
            console.log(response);
            if (response.success) {
                $('#toast-success').removeClass('hidden'); // Show success toast
            } else {
                $('#toast-danger').removeClass('hidden'); // Show error toast
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Form submission failed: ' + textStatus + ' ' + errorThrown);
        }
    });
}

function refreshexcel() {
    $('#addorderexcel')[0].reset();
}

function addorderform() {
    const form = document.getElementById('addorderform');
    const formData = new FormData(form);

    $.ajax({
        url: '{{ url("addorderform") }}', // Ensure this URL matches your route
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle success response
            console.log(response);
            if (response.success) {
                $('#toast-success').removeClass('hidden'); // Show success toast
            } else {
                $('#toast-danger').removeClass('hidden'); // Show error toast
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Form submission failed: ' + textStatus + ' ' + errorThrown);
        }
    });
}

function refreshform() {
    $('#refreshform')[0].reset();
}
</script>


@endsection