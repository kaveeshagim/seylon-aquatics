@extends('layouts.app')

@section('content')

<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">


        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Order History</span>
                    </h5>
                    
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="addneworderButton" onclick="addneworderpage()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add New Order
                    </button>
                    <button type="button" onclick="searchdata()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                        </svg>
                        Search
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                

            </div>


            <div class="overflow-x-auto">
                <table id="orderhistory-table" class="dataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">Date</th>
                            <th scope="col" class="p-4">Order No</th>
                            <th scope="col" class="p-4">Status</th>
                            <th scope="col" class="p-4">View</th>
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

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
    searchdata();
  });
</script>

<script>

function searchdata() {
  $('#orderhistory-table').DataTable().destroy();

  $.ajax({
    url: "getorderhistory",
    type: "GET",
    dataSrc: "data",
    success: function(data) {
      console.log("Data:", data);


        // Initialize the DataTable with the retrieved data
      $('#orderhistory-table').DataTable({
        "processing": true,
        "deferRender": true,
        "data": data,
        "columns": [
        { "data": "created_at" },
          { "data": "order_id" },
            {
              sortable: false,
              "render": function(data, type, full, meta) {
                  return '<span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-red-900 dark:text-red-300">' + full.status + '</span>';
              }
          },

          {
            sortable: false,
            "render": function(data, type, full, meta) {
            //   return '<td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><button onclick="deletemodal(\'' + full.id + '\')" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">'+
            //                                     '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">'+
            //                                         '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />'+
            //                                     '</svg>'+
            //                                 '</button></td>';
             return    '<td><button type="button" onclick="deletemodal(\'' + full.id + '\')" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="text-xs flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">'+
                                            '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />'+
                                        '</svg>'+
                                        'Delete'+
                                    '</button>';
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

            const tbody = $('table tbody');
            const rows = tbody.find('tr');

            rows.each(function() {
                // $(this).addClass('border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700');
                
                const cells = $(this).find('td');
                cells.each(function() {
                    $(this).addClass('p-2 w-4');
                });
            });
        },
        "columnDefs": [
          { className: "text-center", "targets": [0, 1] }
        ],
        // "dom": 'Bfrtip',
        // "buttons": [
        //     {
        //         extend: 'excelHtml5',
        //         title: 'My Excel Export',
        //         text: 'Export to Excel'
        //     },
        //     {
        //         extend: 'pdfHtml5',
        //         title: 'My PDF Export',
        //         text: 'Export to PDF',
        //         orientation: 'landscape',
        //         pageSize: 'A4'
        //     }
        // ],
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

function addneworderpage() {
    location.href= "{{ url('addorderpage') }}";
}

</script>

@endsection