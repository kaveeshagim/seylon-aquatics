<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}" />
  <title>Seylon Aquatics</title>
  <script src="{{ asset('customcss/customcss.css') }}"></script>
  @vite(['resources/css/app.css','resources/js/app.js'])

  <script>
      if (
          localStorage.getItem('color-theme') === 'dark' ||
          (!('color-theme' in localStorage) &&
              window.matchMedia('(prefers-color-scheme: dark)').matches)
      ) {
          document.documentElement.classList.add('dark');
      } else {
          document.documentElement.classList.remove('dark');
      }
  </script>


</head>
<body class="bg-gray-300 flex items-center justify-center h-screen dark:bg-gray-900">

  <!-- Password Reset Modal Start -->
<div id="passwordreset-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-50 dark:bg-gray-800 rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Passwword Reset Request
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="passwordreset-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="passwordresetform" class="space-y-4">
                    <div>
                        <label for="username-reset" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                        <input type="text" name="username-reset" id="username-reset"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                             required />
                    </div>
                    <div>
                        <label for="reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason for password reset</label>
                        <textarea name="reason" id="reason"  rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required></textarea>
                    </div>
                    <button type="button" onclick="resetpassword()"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
  <!-- Password Reset Modal End -->


  <div class="row flex justify-content-center">
      <div class="col-md-6">
        
        <!-- Alert Start -->
        <div class="container">


            <!-- <div id="alert-1" class="hidden flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
              <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Info</span>
              <div class="ms-3 text-sm font-medium">
                Login Unsuccessful. Don't leave the fields empty!
              </div>
              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
              </button>
            </div> -->


            <div id="alert-2" class="hidden flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
              <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Info</span>
              <div class="ms-3 text-sm font-medium">
                Login Unsuccessful. Change a few things up and try submitting again.
              </div>
              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
              </button>
            </div>

            <div id="alert-3" class="hidden flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
              <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Info</span>
              <div class="ms-3 text-sm font-medium">
                Login Unsuccessful. User Account is inactive. Contact the administrator.
              </div>
              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
              </button>
            </div>
          <!-- Alert Start -->

          <!-- Login Container Start -->
          <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <div class="mb-6 text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="mx-auto">                
            </div>
            <h1 class="text-2xl font-bold mb-6 text-center"></h1>

            <form >
            @csrf
              <div class="mb-4">
                <label for="username" autofill="false" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Username
                </label>
                <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-600 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="true">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Password
                </label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-600 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="true">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-4 flex justify-between">

                <button data-modal-target="passwordreset-modal" data-modal-toggle="passwordreset-modal" 
                class="block text-blue-600 hover:text-blue-500 focus:outline-none font-medium 
                rounded-lg text-sm py-2.5 text-center" type="button">
                  Forgot Password
                </button>

                <!-- Dark mode switcher -->
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-500 hover:text-gray-900 dark:hover:text-gray-50 focus:outline-none rounded-lg text-sm p-1.5">
                <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
                </button>
                <!-- Dark mode switcher end -->
              </div>

              <button type="button" onclick="login()" id="loginButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 w-full">
                Login
              </button>
            </form>
          </div>
          <!-- Login Container Start -->
            
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery.js') }}"></script>
<script src="{{ asset('plugins/bootbox.js') }}"></script>
<script src="{{ asset ('js/dark-mode.js') }}"></script>

<script>

  function login() {
      var username = $("#username").val();
      var password = $("#password").val();

      if(username == ''|| password == '') {
        bootbox.alert({
            message: "Login Unsuccessful. Don't leave the fields empty!",
            backdrop: true,
            callback: function () {
            }
        }).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400").find('.bootbox-close-button').addClass("ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700");

      }else{
        $.ajax({
          url: "{{ url('login') }}",
          type: "POST",
          data: { username: username, password: password, _token: "{{ csrf_token() }}" },
          success: function(response) {
            if(response.status == 'success'){
              location.href = "{{ route('dashboard') }}";
              
            }else if(response.status == 'error'){
              bootbox.alert({
            message: response.message,
            backdrop: true,
            callback: function () {
            }
        }).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400");

            }else{
              bootbox.alert({
            message: response.message,
            backdrop: true,
            callback: function () {
            }
        }).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400").find('.bootbox-close-button').addClass("ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700");
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert("Login failed:", textStatus, errorThrown);
            bootbox.alert({
            message: "Login Unsuccessful."+ textStatus + " " + errorThrown,
            backdrop: true,
            callback: function () {
            }
        }).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400").find('.bootbox-close-button').addClass("ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700");
          }
        });
      }
    }


    function resetpassword() {
    $.ajax({
        url: 'addpasswordresetreq',
        type: 'POST',
        data: $('#passwordresetform').serialize() + '&_token={{ csrf_token() }}', // Corrected serialization
        success: function(response) {
            if (response.status == "success") {
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {
                    }
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");
            } else if(response.status == "error") {
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {
                    }
                }).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400").find('.bootbox-close-button').addClass("ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Form submission failed:', textStatus, errorThrown);
            bootbox.alert({
            message: "An error occurred while submitting the form.",
            backdrop: true,
            callback: function () {
            }
        }).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400").find('.bootbox-close-button').addClass("ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700");
        }
    });
}





</script>


</body>
</html>