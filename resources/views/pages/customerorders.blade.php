@extends('layouts.app')

@section('content')


<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">


        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Customer Orders</span>
                    </h5>
                    
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
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
                <table id="orders-table" class="dataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">Date</th>
                            <th scope="col" class="p-4">Order No</th>
                            <th scope="col" class="p-4">Customer Name</th>
                            <th scope="col" class="p-4">Executive In charge</th>
                            <th scope="col" class="p-4">No. of items</th>
                            <th scope="col" class="p-4">Status</th>
                            <th scope="col" class="p-4">View Order</th>
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
  $('#orders-table').DataTable().destroy();

  $.ajax({
    url: "{{url('getcustomerorders')}}",
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
            { "data": "created_at" },
          { "data": "order_no" },
          { "data": "customer_name" },
          { "data": "executive_fname" },
          { "data": "tot_orders" },
          { "data": "status" },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><div style="display: flex; justify-content: center; align-items: center;"><button type="button" onclick="vieworder(\'' + full.id + '\')" class="text-xs py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">'+
                                  '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">'+
                    '<path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" clip-rule="evenodd"/>'+
                    '</svg>'+
                    'View Order'+
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

            // const tbody = $('table tbody');
            // const rows = tbody.find('tr');

            // rows.each(function() {
            //     // $(this).addClass('border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700');
                
            //     const cells = $(this).find('td');
            //     cells.each(function() {
            //         $(this).addClass('p-2 w-4');
            //     });
            // });
        },
        "columnDefs": [
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5] }
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

function vieworder(id) {
    location.href = "{{ url('vieworderdetpage') }}" + "/" + id;
}


</script>
@endsection