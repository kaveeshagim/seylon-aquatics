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
          <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Admin</a>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">User Type</span>
        </div>
      </li>
    </ol>
  </nav>

<div class="px-4">
<h4 class="text-2xl font-bold dark:text-white">User Type</h4>
<hr>
<div class="mb-4">
<a href="{{ route('addusertypepage') }}">
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add new usertype</button>
</a>

<button onclick="searchdata()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2">Search</button>
</div>

<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
              <table class="table table-bordered dataTable display" id="usertype-table" style="width:100%">
                <thead class="bg-gray-100 dark:bg-gray-700">
                          <tr>
                              <th>User Type</th>
                              <th>Users</th>
                              <th>View</th>
                              <th>Edit</th>
                              <th>Delete</th>
                          </tr>
                      </thead>
              </table>
              </div>
        </div>
    </div>
</div>

</div>


<script>
    $(document).ready(function() {
        searchdata();
    });
</script>

<script>

function searchdata() {
  $('#usertype-table').DataTable().destroy();

  $.ajax({
    url: "getusertypes",
    type: "GET",
    dataSrc: "data",
    success: function(data) {
      console.log("Data:", data);

      // Initialize the DataTable with the retrieved data
      $('#usertype-table').DataTable({
        "processing": true,
        "deferRender": true,
        "data": data,
        "columns": [
          { "data": "title" },
          { "data": "userscount" },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><a style="color: #000000" href="" onclick=""><span class="fas fa-eye"></span></a></td>';
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              // return '<td><button style="color: #000000" onclick="editusertype(\'' + full.id + '\')"><span class="fas fa-pencil-alt"></span></button></td>';
              return '<td><button type="button" onclick="editusertype(\'' + full.id + '\')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><span class="fas fa-pencil-alt"></span> Edit</button></td>';

            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              // return '<td><a style="color: #000000" href="" onclick="deleteusertype(\'' + full.id + '\')"><span class="fas fa-trash-alt"></span></a></td>';
              return '<td><button type="button" onclick="deleteusertype(\'' + full.id + '\')" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><span class="fas fa-trash-alt"></span> Delete</button></td>';

            }
          }
        ],
        "columnDefs": [
          { className: "text-center", "targets": [0, 1, 2, 3, 4] }
        ],
        "pageLength": 25,
        // "order": [[0, "desc"]],
        "searching": true
      });
    },
    "error": function(xhr, status, error) {
      console.error("Error:", error);
    }
  });
}

function editusertype(id) {
  location.href = "{{url('editusertypepage')}}" + "/" + id;
}


function deleteusertype(id) {
    $.ajax({
        url: 'deleteusertype',
        type: 'GET',
        data: {id: id},
        success: function (response) {
            if(response == "deleted") {
               alert("user type successfully deleted!"); 
               location.reload();
            }
        }
    });
}
</script>
@endsection