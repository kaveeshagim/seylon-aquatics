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
</head>
<body class="bg-gray-800 flex items-center justify-center h-screen"">

<div class="container">
    <div id="loginunsuccess" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 hidden" role="alert">
      <span class="font-medium">Login Unsuccessful</span> Change a few things up and try submitting again.
    </div>
  <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800 hidden" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
      Login Unsuccessful. Change a few things up and try submitting again.
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
</div>
    <div class="row flex justify-content-center">
        <div class="col-md-6">
            <div class="bg-gray-500 p-8 rounded-lg shadow-md">
                <div class="mb-6 text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="mx-auto">                
                </div>
                <h1 class="text-2xl font-bold mb-6 text-center"></h1>

                <form >
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">
                            Username
                        </label>
                        <input id="username" type="username" class="shadow appearance-none border bg-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('username') is-invalid @enderror" name="email" value="" required autocomplete="username" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">
                            Password
                        </label>
                        <input id="password" type="password" class="shadow appearance-none border bg-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
            $("#loginunsuccess").removeClass("hidden").addClass("block");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Login failed:", textStatus, errorThrown);
        }
      });
      return false;
    });
  });
</script>

</body>
</html>