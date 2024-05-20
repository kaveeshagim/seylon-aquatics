<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}" />
  <title>Seylon Aquatics</title>
  <!-- Styles -->
  @vite('resources/css/app.css')
  <!-- Scripts -->
  @vite('resources/js/app.js')
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"> -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="bg-blue-800 flex items-center justify-center h-screen">


<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Password Reset Request
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#" id="password-reset-form">
                  <!-- <input hidden type="text" name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ session()->get('userid') }}" required /> -->

                    <div>
                        <label for="username-reset" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                        <input type="username" name="username-reset" id="username-reset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason for password reset</label>
                        <textarea name="reason" id="reason" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required></textarea>
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div> 





    <div class="row flex justify-content-center">
        <div class="col-md-6">

        <div class="container">
            <div id="alert-2" class="hidden flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
              <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Info</span>
              <div class="ms-3 text-sm font-medium">
                Login Unsuccessful</span> Change a few things up and try submitting again.
              </div>
              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
              </button>
            </div>
        </div>


            <div class="bg-gray-100 p-8 rounded-lg shadow-md">
                <div class="mb-6 text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="mx-auto">                
                </div>
                <h1 class="text-2xl font-bold mb-6 text-center"></h1>

                <form >
                    @csrf

                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-bold mb-2">
                            Username
                        </label>
                        <!-- <input id="username" type="username" class="shadow appearance-none border bg-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('username') is-invalid @enderror" name="email" value="" required autocomplete="username" autofocus> -->
                        <input type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">
                            Password
                        </label>
                        <!-- <input id="password" type="password" class="shadow appearance-none border bg-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> -->
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="checkbox">
                        <!-- <label class="pull-left">
                            <a href="#" style="text-decoration: none; color: black;" id="forgot-password">Forgotten Password?</a>
                        </label> -->
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-black bg-stone-700 hover:bg-stone-600 focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-stone-600 dark:hover:bg-stone-700 dark:focus:ring-stone-800" type="button">
                          Forgot Password
                        </button>
                    </div>




                    <button type="submit" id="loginButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 w-full">
                     Login
                    </button>


                </form>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



<script>
  $(document).ready(function() {
    $("#loginButton").click(function() {
      var username = $("#username").val();
      var password = $("#password").val();

      $.ajax({
        url: "/login",
        type: "POST",
        data: { username: username, password: password, _token: "{{ csrf_token() }}" },
        success: function(response) {
          if(response === 'correct'){
            location.href = "{{ route('home') }}";
          }else{
            // alert("Login unsuccessful:", response);
            $("#alert-2").removeClass("hidden").addClass("block");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Login failed:", textStatus, errorThrown);
        }
      });
      return false;
    });

  });


  $(document).ready(function() {
    $('#password-reset-form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'addpasswordresetreq',
            type: 'POST',
            data: $(this).serialize() + '&_token={{ csrf_token() }}', // Corrected serialization
            success: function(response) {
                console.log(response);
                var alertArea = document.getElementById('alertArea');

                if (response === "success") {
                    window.location.reload();
                } else {
                    alert('An error occurred.'); // You might want to show a more informative message here
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Form submission failed:', textStatus, errorThrown);
                alert('An error occurred while submitting the form.'); // Informative message for the user
            }
        });
    });
});




</script>

</body>
</html>