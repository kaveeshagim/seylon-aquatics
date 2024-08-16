@extends('layouts.app')

@section('content')
<div class="rounded-lg h-20 mb-1"></div>

<h4 class="text-2xl font-bold dark:text-white">Realtime Analytics Dashboard</h4>
<hr class="w-full h-1 my-4 bg-gray-900 border-0 rounded md:my-10 dark:bg-gray-700">


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-4">

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="pendingorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">PENDING ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="confirmedorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">CONFIRMED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="shippedorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">SHIPPED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="cancelledorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">COMPLETED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="completedorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">CANCELLED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="totalorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">TOTAL ORDERS</dd>
      </dl>
    </div>
  </a>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-4">

<a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="pendinginvoices" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">PENDING INVOICES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="completedinvoices" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">COMPLETED INVOICES</dd>
      </dl>
    </div>
  </a>


  <a href="" class="no-underline rounded-lg shadow">
    
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="pendingshipments" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">PENDING SHIPMENTS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="intransitshipments" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">IN-TRANSIT SHIPMENTS</dd>
      </dl>
    </div>
  </a>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

<a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishvarietycount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH VARIETIES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishspeciescount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH SPECIES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishfamilycount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH FAMILIES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishhabitatcount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH HABITATS</dd>
      </dl>
    </div>
  </a>


</div>


      







<script>
     document.addEventListener("DOMContentLoaded", function(event) {

      $.ajax({
          url: '{{url('update-status-customer')}}',
          type: 'get',
          processData: false,
          contentType: false,
          success: function(response) {

          },
          error: function(jqXHR, textStatus, errorThrown) {

          }
      });


      const socket = io('http://localhost:6050', {transports: ['websocket']});
      
      
      socket.on('connect', () => {
        console.log('WebSocket connected');
      });



    socket.on('updateOrdersCustomer', (data) => {
      console.log('Received orders data:', data);
        document.getElementById('pendingorders').textContent = data.pendingorders;
        document.getElementById('confirmedorders').textContent = data.confirmedorders;
        document.getElementById('shippedorders').textContent = data.shippedorders;
        document.getElementById('cancelledorders').textContent = data.cancelledorders;
        document.getElementById('completedorders').textContent = data.completedorders;
        document.getElementById('totalorders').textContent = data.totalorders;

        document.getElementById('pendinginvoices').textContent = data.pendinginvoices;
        document.getElementById('completedinvoices').textContent = data.completedinvoices;

        document.getElementById('pendingshipments').textContent = data.pendingshipments;
        document.getElementById('intransitshipments').textContent = data.intransitshipments;

        document.getElementById('fishvarietycount').textContent = data.fishvarietycount;
        document.getElementById('fishspeciescount').textContent = data.fishspeciescount;
        document.getElementById('fishfamilycount').textContent = data.fishfamilycount;
        document.getElementById('fishhabitatcount').textContent = data.fishhabitatcount;
    });

    socket.on('disconnect', () => {
        console.log('WebSocket disconnected');
    });

});
    

</script>

@endsection