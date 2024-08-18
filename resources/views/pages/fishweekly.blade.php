@extends('layouts.app')

@section('content')


<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">



        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Weekly Fish List</span>
                    </h5>
                    
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="addnewfishweeklyButton" onclick="addnewfishweeklypage()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add New Fish Weekly
                    </button>
                    <button type="button" onclick="searchdata()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                        </svg>
                        Search
                    </button>
                    <button type="button" onclick="historysearchdata()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                        </svg>
                        History Search
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
              <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                  <div>
                      <label for="filter-year" class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                      <input type="number" id="filter-year" name="filter-year" min="2000" max="{{ date('Y') }}" class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                  </div>

                  <!-- Week Dropdown -->
                  <div>
                      <label for="filter-week" class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Week of the Year</label>
                      <select id="filter-week" name="filter-week" class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="">Select Week</option>
                          @for ($week = 1; $week <= 52; $week++)
                              <option value="{{ $week }}">{{ $week }}</option>
                          @endfor
                      </select>
                  </div>
                </div>
              </div>

            </div>


            <div class="overflow-x-auto">
                <table id="fishweekly-table" class="dataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">Year</th>
                            <th scope="col" class="p-4">Week</th>
                            <th scope="col" class="p-4">Fish Code</th>
                            <th scope="col" class="p-4">Common Name</th>
                            <th scope="col" class="p-4">Scientific Name</th>
                            <th scope="col" class="p-4">Available Qty</th>
                            <th scope="col" class="p-4">Qty Per Bag</th>
                            <th scope="col" class="p-4">Size</th>
                            <th scope="col" class="p-4">Size in cm</th>
                            <th scope="col" class="p-4">Unit Price(USD)</th>
                            <th scope="col" class="p-4">Special Offer</th>
                            <th scope="col" class="p-4">Discount(USD)</th>
                            <th scope="col" class="p-4">Image</th>
                            <th scope="col" class="p-4">Edit</th>
                            <th scope="col" class="p-4">Delete</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>
<!-- End block -->

<button id="edittoggle" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
Toggle modal
</button>



<!-- Edit fish size modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-50 rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Fish Weekly Record
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" id="edit-form">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input hidden="true" id="editid" name="editid"/>
                    <div>
                        <label for="fishcode-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Code</label>
                        <input type="text" name="fishcode-edit" id="fishcode-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly />
                    </div>
                    <div>
                        <label for="quantity-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="quantity-edit" id="quantity-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="unitprice-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit Price (USD)</label>
                        <input type="text" name="unitprice-edit" id="unitprice-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <button type="button" onclick="editfishhweeklyrecord()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> 

<button id="deletetoggle" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
Toggle modal
</button>

<!-- Delete Modal -->
<div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-50 rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <input hidden="true" id="deleteid" name="deleteid"/>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this record?</h3>
                <button onclick="deletefishweekly()" data-modal-hide="delete-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes
                </button>
                <button data-modal-hide="delete-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function(event) {
    searchdata();
  });
</script>

<script>

function searchdata() {
  let year = $('#filter-year').val(); // Get year filter value
  let week = $('#filter-week').val(); // Get week filter value

  $('#fishweekly-table').DataTable().destroy();

  $.ajax({
    url: "getfishweekly",
    type: "GET",
    dataSrc: "data",
    data: {
            year: year,
            week: week
        },
    success: function(data) {
      console.log("Data:", data);


        // Initialize the DataTable with the retrieved data
      $('#fishweekly-table').DataTable({
        "processing": true,
        "deferRender": true,
        "data": data,
        "columns": [
          { "data": "year" },
          { "data": "week" },
          { "data": "fish_code" },
          { "data": "common_name" },
          { "data": "scientific_name" },
          { "data": "quantity" },
          { "data": "qtyperbag" },
          { "data": "size" },
          { "data": "size_cm" },
          { "data": "gross_price" },
          { "data": "special_offer" },
          { "data": "discount" },
          { 
            "data": "image",
            "render": function(data) {
              return `<img src="storage/${data}" alt="Fish Image" class="w-16 h-16 object-cover">`;
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
            return '<td><div style="display: flex; justify-content: center; align-items: center;"><button type="button" onclick="editmodal(\'' + full.id + '\')" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="text-xs py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">'+
                        '<path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />'+
                        '<path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />'+
                    '</svg>'+
                    'Edit'+
                '</button></div></td>';
            }

          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
             return    '<td><div style="display: flex; justify-content: center; align-items: center;"><button type="button" onclick="deletemodal(\'' + full.id + '\')" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="text-xs flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">'+
                                            '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />'+
                                        '</svg>'+
                                        'Delete'+
                                    '</button></div></td>';
            }
          }
        ],
         "initComplete": function(settings, json) {
            $('.dt-info').addClass('text-sm font-normal text-gray-500 dark:text-gray-400 ml-3');
            $('.dt-paging').addClass('inline-flex items-stretch -space-x-px');
            $('.pagination').addClass('inline-flex items-stretch -space-x-px');
            $('#dt-search-1').addClass('bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-72 float-right pl-10 p-2 mb-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500').attr('placeholder', 'Search');
            $('.dt-length').addClass('ml-3');
            $('#dt-search-1').find('label').addClass('text-gray-700 dark:text-white');
            $('.dt-length').find('label').addClass('text-gray-700 dark:text-white');
            $('#dt-length-1').addClass('text-gray-700 dark:text-white bg-gray-50 dark:bg-gray-700');

        },
        "rowCallback": function(row, data, index) {
          if (data.quantity <= 100 ) {
            $(row).css('background-color', 'rgba(255, 99, 132, 0.2)');
          }
          // if (data.quantity <= 2000) {
          //     $(row).css('background-color', 'rgba(75, 192, 192, 0.2)'); // Set to a light green color
          // }

        },
        "columnDefs": [
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11] }
        ],
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'excelHtml5',
                title: 'Fish Weekly List - Week',
                text: 'Export to Excel',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11] 
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Fish Weekly List - Week',
                text: 'Export to PDF',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11]  
                }
            },
            {
                extend: 'print',
                title: 'Fish Weekly List - Week',
                text: 'Print',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11] 
                }
            }
        ],
        "pageLength": 25,
        "order": [[5, "desc"]],
        "searching": true
      });




    },
    "error": function(xhr, status, error) {
      console.error("Error:", error);
    }
  });
}

function historysearchdata() {

  let year = $('#filter-year').val(); // Get year filter value
  let week = $('#filter-week').val(); // Get week filter value


  $('#fishweekly-table').DataTable().destroy();

$.ajax({
  url: "{{url('getfishweeklyhistory')}}",
  type: "GET",
  dataSrc: "data",
  data: {
            year: year,
            week: week
        },
  success: function(data) {
    console.log("Data:", data);


      // Initialize the DataTable with the retrieved data
    $('#fishweekly-table').DataTable({
      "processing": true,
      "deferRender": true,
      "data": data,
      "columns": [
        { "data": "year" },
          { "data": "week" },
          { "data": "fish_code" },
          { "data": "common_name" },
          { "data": "scientific_name" },
          { "data": "quantity" },
          { "data": "qtyperbag" },
          { "data": "size" },
          { "data": "size_cm" },
          { "data": "gross_price" },
          { "data": "special_offer" },
          { "data": "discount" },
          { 
            "data": "image",
            "render": function(data) {
              return `<img src="storage/${data}" alt="Fish Image" class="w-16 h-16 object-cover">`;
            }
          },
        {
          sortable: false,
          "render": function(data, type, full, meta) {
          return '';
          }

        },
        {
          sortable: false,
          "render": function(data, type, full, meta) {
           return    '';
          }
        }
      ],
       "initComplete": function(settings, json) {
          $('.dt-info').addClass('text-sm font-normal text-gray-500 dark:text-gray-400 ml-3');
          $('.dt-paging').addClass('inline-flex items-stretch -space-x-px');
          $('.pagination').addClass('inline-flex items-stretch -space-x-px');
          $('#dt-search-1').addClass('bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-72 float-right pl-10 p-2 mb-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500').attr('placeholder', 'Search');
          $('.dt-length').addClass('ml-3');
          $('#dt-search-1').find('label').addClass('text-gray-700 dark:text-white');
          $('.dt-length').find('label').addClass('text-gray-700 dark:text-white');
          $('#dt-length-1').addClass('text-gray-700 dark:text-white bg-gray-50 dark:bg-gray-700');

      },
      "columnDefs": [
        { className: "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11] }
      ],
      "dom": 'Bfrtip',
      "buttons": [
          {
              extend: 'excelHtml5',
              title: 'Fish Weekly List Old - Week',
              text: 'Export to Excel',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11] 
              }
          },
          {
              extend: 'pdfHtml5',
              title: 'Fish Weekly List Old - Week',
              text: 'Export to PDF',
              orientation: 'landscape',
              pageSize: 'A4',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11]  
              }
          },
          {
              extend: 'print',
              title: 'Fish Weekly List Old - Week',
              text: 'Print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11] 
              }
          }
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


function addnewfishweeklypage() {
    location.href = "{{url('addfishweeklypage')}}";
}

function editmodal(id) {

  var priv = 'Update Data_2';
  $.ajax({
      url: "{{url('privcheck')}}",
      type: 'GET',
      data: { priv: priv },
      success: function (response) {
          if(response.status == "success") {
              
            document.getElementById('editid').value = id;
            document.getElementById('quantity-edit').value = '';
            document.getElementById('unitprice-edit').value = '';
            document.getElementById('fishcode-edit').value = '';

            $.ajax({
              url: "{{url('getfishweeklyrecord')}}" + "/" + id,
              type: 'GET',
              success: function (response) {
                document.getElementById('quantity-edit').value = response.quantity;
                document.getElementById('unitprice-edit').value = response.gross_price;
                document.getElementById('fishcode-edit').value = response.fish_code;
              }
            });
            $('#edittoggle').click();


          }else if(response.status == "error"){
              bootbox.alert({
                  message: response.message,
                  backdrop: true,
                  callback: function () {
                  }
              }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
          }
      }
  });



}


function editfishhweeklyrecord() {

    const form = document.getElementById('edit-form');
    const formData = new FormData(form);
    startspinner();
    $.ajax({
      url: '{{url('editfishweeklyrecord')}}',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        stopspinner();
        if (response.status == "success") {
            bootbox.alert({
            message: response.message,
            backdrop: true,
            callback: function () {
                $('#edittoggle').click();
                searchdata();
            }
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");
        }else if(response.status == "error"){
            bootbox.alert({
            message: response.message,
            backdrop: true,
            callback: function () {

            }
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        }
      }
    });
}


  function deletemodal(id) {
    var priv = 'Delete Data_2';
    $.ajax({
      url: "{{url('privcheck')}}",
      type: 'GET',
      data: { priv: priv },
      success: function (response) {
          if(response.status == "success") {
              
            document.getElementById('deleteid').value = id;
            $('#deletetoggle').click();

          }else if(response.status == "error"){
              bootbox.alert({
                  message: response.message,
                  backdrop: true,
                  callback: function () {
                  }
              }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
          }
      }
  });


}


function deletefishweekly() {
  const id = document.getElementById('deleteid').value;
  startspinner();
  $.ajax({
    url: 'deletefishweekly',
    type: 'GET',
    data: { id: id },
    success: function (response) {
      stopspinner();
        if(response.status == "success") {
            bootbox.alert({
                message: response.message,
                backdrop: true,
                callback: function () {
                    searchdata();
                }
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");

        }else if(response.status == "error"){
            bootbox.alert({
                message: response.message,
                backdrop: true,
                callback: function () {
                    searchdata();
                }
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        }
    }
  });
}

</script>
@endsection