@extends('layouts.app')

@section('content')

<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      <li class="inline-flex items-center">
        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
          <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
          </svg>
          <span style="padding-left: 5px;">Home</span>
        </a>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Order</a>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Orders</span>
        </div>
      </li>
    </ol>
  </nav>

<div class="px-4">
<h4 class="text-2xl font-bold dark:text-white">Orders</h4>
<hr>
<div class="mb-4">
<a href="{{ route('addorderpage') }}">
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add new order</button>
</a>

<button onclick="searchdata()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2">Search</button>
</div>
<table class="table table-bordered dataTable display" id="orders-table" style="width:100%">
        <thead>
            <tr>
                <th>Datetime</th>
                <th>Cus Name</th>
                <th>Sub cus Name</th>
                <th>Orders</th>
                <th>Boxes</th>
                <th>Status</th>
                <th>View</th>
                <th>Update</th>
            </tr>
        </thead>
</table>
</div>


<script>
    $(document).ready(function() {
        searchdata();
    });
</script>

<script>

// $("#users-table").DataTable().destroy(true);
function searchdata() {
  $('#orders-table').DataTable().destroy();

  $.ajax({
    url: "getorders",
    type: "GET",
    dataSrc: "data",
    success: function(data) {
      console.log("Data:", data);

      // Initialize the DataTable with the retrieved data
      $('#orders-table').DataTable({
        "processing": true,
        "deferRender": true,
        "data": data,
        "columns": [
            { "data": "order_id" },
            { "data": "customer" },
            { "data": "subcustomer" },
            { "data": "executive" },
            { "data": "status" },
            { "data": "executive" },
            {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><a style="color: #000000" href="" onclick=""><span class="fas fa-eye"></span></a></td>';
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><a style="color: #000000" href=""><span class="fas fa-pencil-alt"></span></a></td>';
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><a style="color: #000000" href=""><span class="fas fa-trash-alt"></span></a></td>';
            }
          }
        ],
        "columnDefs": [
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5, 6] }
        ],
        "pageLength": 25,
        "order": [[0, "desc"]],
        "searching": true
      });
    },
    "error": function(xhr, status, error) {
      console.error("Error:", error);
    }
  });
}

</script>
@endsection