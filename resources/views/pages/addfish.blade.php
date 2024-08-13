@extends('layouts.app')

@section('content')
<div>


    <h4 class="text-2xl font-bold dark:text-white">Add Fish</h4>
    <hr class="w-full h-1 my-4 bg-gray-900 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="mb-5"></div>

    <form id="fishForm" enctype="multipart/form-data">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2 font-medium">
        
        <div>
            <label for="fishhabitat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Habitat</label>
            <select id="fishhabitat" name="fishhabitat" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select fish habitat -</option>
                @foreach($fishhabitatlist as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fishvariety" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Variety</label>
            <select id="fishvariety" name="fishvariety" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select fish variety -</option>
                @foreach($fishvarietylist as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fishsize" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Size</label>
            <select id="fishsize" name="fishsize" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select fish size -</option>
                @foreach($fishsizelist as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fish_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Code</label>
            <input type="text" id="fish_code" name="fish_code" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required/>
        </div>
        <div>
            <label for="scientific_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scientific Name</label>
            <input type="text" id="scientific_name" name="scientific_name" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required/>
        </div>
        <div>
            <label for="common_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Common Name</label>
            <input type="text" id="common_name" name="common_name" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
        </div>
        <div>
            <label for="pack_A" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pack A</label>
            <input type="text" id="pack_A" name="pack_A" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
        </div>
        <div>
            <label for="pack_B" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pack B</label>
            <input type="text" id="pack_B" name="pack_B" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
        </div>  


        <div>
            <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="displaySelectedImage(event)">
            <button type="button" onclick="document.getElementById('avatar').click()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block">Select Image</button>
            <button onclick="cancelSelectedImage()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-block ml-2">Cancel</button>
            <p id="selectedImageText" class="hidden mt-1 text-sm text-gray-500">Selected image: <span id="selectedImageName"></span></p>
            <img id="selectedImagePreview" class="hidden mt-2" src="" alt="Selected Image Preview" style="max-width: 200px; max-height: 200px;">
        </div>




    </div>
    <button id="submitButton" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>Submit</button>

    <!-- <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button> -->
    <button onclick="refresh()" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Cancel</button>
    </form>

</div>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add new fish</h2>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
      <form id="userForm" enctype="multipart/form-data">
        @csrf
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                    <select id="usertype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                  <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
             </div>


            <div class="w-full">
                
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Avatar</label>
                <input name="avatar" onchange="displaySelectedImage(event)" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="avatar" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

                <!-- <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label> -->
                <!-- <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="displaySelectedImage(event)"> -->
                <!-- <button type="button" onclick="document.getElementById('avatar').click()" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                    Upload picture
                </button> -->
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
                <span id="errorMessage" class="font-semibold text-red-500"></span>
            </div>
          </div>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">

          <button type="submit" id="submitButton" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800" disabled>
              Submit
          </button>
            <button onclick="refresh()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
              Cancel
          </button>
      </form>
  </div>
</section>

<script>

 $('#fish_code').click(() => {

    var habitat = document.getElementById('fishhabitat');
    var variety = document.getElementById('fishvariety');
    var size = document.getElementById('fishsize');

            $.ajax({
            url: 'genfishcode',
            type: 'GET',
            data: {habitat:habitat, variety:variety, size:size},
            processData: false,
            contentType: false,
            success: function(response) {

                $('#fish_code').text(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Form submission failed:', textStatus, errorThrown);
            }
        });
});


$(document).ready(function() {
    $('#fishForm').submit(function(event) {
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
        formData.append('username', $('input[name="username"]').val());
        formData.append('firstname', $('input[name="firstname"]').val());
        formData.append('lastname', $('input[name="lastname"]').val());


        $.ajax({
            url: 'addfish',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                var alertArea = document.getElementById('alertArea');

                if(response === "failed"){
                    var errorAlert = `<div id="alert-border-3" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                         <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                         </svg>
                         <div class="ms-3 text-sm font-medium">
                         Username already exists.
                         </div>
                         <button id="dismiss-button" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                         <span class="sr-only">Dismiss</span>
                         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                         </svg>
                         </button>
                     </div>`;

                    alertArea.innerHTML = errorAlert;
                } else {
                    var successAlert = `<div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                        User added.
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
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Form submission failed:', textStatus, errorThrown);
            }
        });
    });
});
    
</script>

<script>
    function refresh(){

        $('#fishForm')[0].reset();
    }
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