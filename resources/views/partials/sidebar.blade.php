<aside class="relative bg-gray-800 text-gray-200 md:w-64 px-6 py-8">
   <button id="toggleSidebar" class="absolute top-0 right-0 text-white focus:outline-none mr-4 mt-4">
       <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
       </svg>
   </button>

   <div class="flex flex-col items-center justify-center mb-10">
       <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-full w-16 h-15 mb-4 p-2 ring-2 ring-gray-300 dark:ring-gray-500">
       <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ session()->get('username') }}</span>
   </div>

   <hr>

   <nav class="flex flex-col items-start">

       <a href="{{ route('dashboard') }}" class="flex items-center mb-4 text-white bg-gray-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:bg-gray-600 dark:focus:ring-gray-800 no-underline">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207"/>
            </svg>
           Dashboard
       </a>

       <div class="mb-4 w-full">
           <div id="fishDropdownBtn" class="flex items-center justify-between w-full text-white bg-gray-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:bg-gray-600 dark:focus:ring-gray-800 no-underline">
               <div class="flex items-center">
                   <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 6c0 1.657-3.134 3-7 3S5 7.657 5 6m14 0c0-1.657-3.134-3-7-3S5 4.343 5 6m14 0v6M5 6v6m0 0c0 1.657 3.134 3 7 3s7-1.343 7-3M5 12v6c0 1.657 3.134 3 7 3s7-1.343 7-3v-6"/>
                    </svg>

                   <span>Fish Stock</span>
               </div>
               <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
               </svg>
           </div>

           <!-- Dropdown menu -->
           <div id="fishDropdown" class="z-10 hidden divide-y divide-gray-600 rounded-lg shadow w-44 dark:bg-gray-800">
               <ul class="py-2 text-sm text-gray-200">
                   <li class="border-b border-gray-600">
                       <a href="#" class="block px-4 py-2 text-white no-underline">Weekly Fish Stock</a>
                   </li>
                   <li>
                       <a href="#" class="block px-4 py-2 text-white no-underline">Orders</a>
                   </li>
               </ul>
           </div>
       </div>

       <div class="mb-4 w-full">
           <div id="orderDropdownBtn" class="flex items-center justify-between w-full text-white bg-gray-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:bg-gray-600 dark:focus:ring-gray-800 no-underline">
               <div class="flex items-center">
                   <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                   </svg>
                   <span>Order</span>
               </div>
               <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
               </svg>
           </div>

           <!-- Dropdown menu -->
           <div id="orderDropdown" class="z-10 hidden divide-y divide-gray-600 rounded-lg shadow w-44 dark:bg-gray-800">
               <ul class="py-2 text-sm text-gray-200">
                   <li class="border-b border-gray-600">
                       <a href="#" class="block px-4 py-2 text-white no-underline">Order Upload</a>
                   </li>
                   <li>
                       <a href="#" class="block px-4 py-2 text-white no-underline">Orders</a>
                   </li>
               </ul>
           </div>
       </div>

       <a href="#" class="flex items-center mb-4 text-white bg-gray-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:bg-gray-600 dark:focus:ring-gray-800 no-underline">
           <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
           </svg>
           Invoice
       </a>

       <div class="mb-4 w-full">
           <div id="userManageDropdownBtn" class="flex items-center justify-between w-full text-white bg-gray-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:bg-gray-600 dark:focus:ring-gray-800 no-underline">
               <div class="flex items-center">
                   <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                   </svg>
                   <span>User Manage</span>
               </div>
               <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
               </svg>
           </div>

           <!-- Dropdown menu -->
           <div id="userManageDropdown" class="z-10 hidden divide-y divide-gray-600 rounded-lg shadow w-44 dark:bg-gray-800">
               <ul class="py-2 text-sm text-gray-200">
                   <li class="border-b border-gray-600">
                       <a href="{{ route('users') }}" class="block px-4 py-2 text-white no-underline">Users</a>
                   </li>
                   <li class="border-b border-gray-600">
                       <a href="{{ route('customers') }}" class="block px-4 py-2 text-white no-underline">Customers</a>
                   </li>
                   <li>
                       <a href="{{ route('suppliers') }}" class="block px-4 py-2 text-white no-underline">Suppliers</a>
                   </li>
               </ul>
           </div>
       </div>
   </nav>

   <div class="mt-auto">
       <a href="{{ route('logout') }}" class="flex items-center mb-4 text-white bg-gray-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-left dark:bg-gray-600 dark:focus:ring-gray-800 no-underline" id="logoutButton">
           <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
           </svg>
           Logout
       </a>
       <!-- <hr> -->
       <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; {{ date('Y') }} <a href="" class="hover:underline"></a>. All Rights Reserved.</span>
       <!-- <p class="text-sm flex items-center">&copy; {{ date('Y') }} All rights reserved</p> -->
   </div>
</aside>

<style>

aside.sidebar-collapsed {
    width: 80px;
}

aside.sidebar-collapsed nav a span,
aside.sidebar-collapsed nav div span,
aside.sidebar-collapsed hr,
aside.sidebar-collapsed p {
    display: none;
}

aside.sidebar-collapsed nav a,
aside.sidebar-collapsed nav div {
    justify-content: center;
}

aside.sidebar-collapsed nav svg {
    margin-right: 0;
}

aside.sidebar-collapsed nav {
    align-items: center;
}

</style>

<script>
   const fishDropdownButton = document.getElementById('fishDropdownBtn');
   const fishDropdown = document.getElementById('fishDropdown');

   const orderDropdownButton = document.getElementById('orderDropdownBtn');
   const orderDropdown = document.getElementById('orderDropdown');

   const userManageDropdownButton = document.getElementById('userManageDropdownBtn');
   const userManageDropdown = document.getElementById('userManageDropdown');

   const toggleSidebarButton = document.getElementById('toggleSidebar');
   const sidebar = document.querySelector('aside');

   toggleSidebarButton.addEventListener('click', function() {
       sidebar.classList.toggle('sidebar-collapsed');
   });

   document.addEventListener('click', function(event) {
       if (!orderDropdownButton.contains(event.target) && !orderDropdown.contains(event.target)) {
           orderDropdown.classList.add('hidden');
       }

       if (!fishDropdownButton.contains(event.target) && !fishDropdown.contains(event.target)) {
        fishDropdown.classList.add('hidden');
       }

       if (!userManageDropdownButton.contains(event.target) && !userManageDropdown.contains(event.target)) {
           userManageDropdown.classList.add('hidden');
       }
   });

   orderDropdownButton.addEventListener('click', function() {
       orderDropdown.classList.toggle('hidden');
   });

   userManageDropdownButton.addEventListener('click', function() {
       userManageDropdown.classList.toggle('hidden');
   });

   fishDropdownButton.addEventListener('click', function() {
       fishDropdown.classList.toggle('hidden');
   });

</script>

<script>

// $("#logoutButton").click(function() {

//       $.ajax({
//         url: "/logout",
//         type: "GET",
//         data: { },
//         success: function(response) {

//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//           alert("Login failed:", textStatus, errorThrown);
//         }
//       });
//       return false;
// });


</script>