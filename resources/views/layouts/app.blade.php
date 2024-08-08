<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seylon Aquatics</title>
    @vite('resources/css/app.css')
    <!-- Styles -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}" />
    <script src="{{ asset('plugins/jquery.js') }}"></script>
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


    <!-- @vite(['resources/css/app.css','resources/js/app.js']) -->

</head>
<body>

    <div class="antialiased bg-gray-200 dark:bg-gray-900">
        @include('partials.header')
 


            <!-- Main Content -->
            <main class="p-4 h-auto pt-20 mt-18 bg-gray-200 dark:bg-gray-900 min-h-screen">


            @yield('content')



            </main>
            <!-- End of Main Content -->

            <div id="logout-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-50 rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="logout-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to logout?</h3>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" data-modal-hide="logout-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Logout</button>
                </form>

                <button data-modal-hide="logout-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
            </div>
        </div>
    </div>
</div>



    </div>


    @stack('styles')
    @stack('scripts')

     <!-- Scripts -->

    
    <script src="{{ asset('plugins/bootbox.js') }}"></script>
    <script src="{{ asset('plugins/socket.io.js') }}"></script>
    <script src="{{ asset('plugins/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/html2pdf.min.js') }}"></script>
    <script src="{{ asset('plugins/jspdf-plugin.js') }}"></script>
    <script src="{{ asset('plugins/spin.js') }}"></script>
    <script src="{{ asset('plugins/xlsx.full.min.js') }}"></script>
    <script src="{{ asset ('js/dark-mode.js') }}"></script>
    @vite('resources/js/app.js')
    <script>
        function userprofile() {
            location.href = "{{ url('userprofile') }}";
        }
        function notifications() {
            location.href = "{{ url('notifications') }}";
        }
    </script>
</body>
</html>
