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
                
            <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                    <div>
                        <label for="from-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">From Date</label>
                        <input type="date" id="from-date" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="to-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">To Date</label>
                        <input type="date" id="to-date" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>

            </div>


            <div class="overflow-x-auto">
                <table id="orderhistory-table" class="dataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">Date</th>
                            <th scope="col" class="p-4">Order No</th>
                            <th scope="col" class="p-4">Customer</th>
                            <th scope="col" class="p-4">Executive in charge</th>
                            <th scope="col" class="p-4">Shipping Address</th>
                            <th scope="col" class="p-4">Total orders</th>
                            <th scope="col" class="p-4">Total bags</th>
                            <th scope="col" class="p-4">Total boxes</th>
                            <th scope="col" class="p-4">Shipment Date</th>
                            <th scope="col" class="p-4">Tot Discount applied</th>
                            <th scope="col" class="p-4">Order Total</th>
                            <th scope="col" class="p-4">Status</th>
                            <th scope="col" class="p-4">View Order</th>
                            <th scope="col" class="p-4">View Invoice</th>
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

  const fromDate = $('#from-date').val();
    const toDate = $('#to-date').val();
    const status = $('#status').val();

  $('#orderhistory-table').DataTable().destroy();

  $.ajax({
    url: "getorderhistory",
    type: "GET",
    dataSrc: "data",
    data: {
            from_date: fromDate,
            to_date: toDate,
            status: status
        },
    success: function(response) {
      console.log("Data:", response);


        // Initialize the DataTable with the retrieved data
      $('#orderhistory-table').DataTable({
        "processing": true,
        "deferRender": true,
        "data": response.data,
        "columns": [
          { "data": "created_at" },
          { "data": "order_no" },
          { "data": "customer" },
          { "data": "executive" },
          { "data": "shipping_address" },
          { "data": "total_orders" },
          { "data": "total_bags" },
          { "data": "total_boxes" },
          { "data": "delivery_date" },
          { "data": "discount_applied" },
          { "data": "order_total" },

          {
              sortable: false,
              "render": function(data, type, full, meta) {
                if(full.status == 'pending') {
                  return '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">' + full.status + '</span>';

                }else if(full.status == 'confirmed') {
                  return '<span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">' + full.status + '</span>';

                }else if(full.status == 'in-transit') {
                  return '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">' + full.status + '</span>';

                }else if(full.status == 'cancelled') {
                  return '<span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">' + full.status + '</span>';

                }else if(full.status == 'completed') {
                  return '<span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">' + full.status + '</span>';

                }
              }
          },

          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><div style="display: flex; justify-content: center; align-items: center;"><button type="button" onclick="vieworder(\'' + full.id + '\')" class="text-xs py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">'+
                    '<svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">'+
  '<path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>'+
  '<path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>'+
'</svg>'+
                '</button></div></td>';
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {

              if(full.status == 'pending' || full.status == 'cancelled') {
                return '';
              }else{
                return '<td><div style="display: flex; justify-content: center; align-items: center;"><button type="button" onclick="viewinvoice(\'' + full.id + '\')" class="text-xs py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">'+
                    '<svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">'+
                      '<path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>'+
                      '<path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>'+
                    '</svg>'+
                '</button></div></td>';
              }

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
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] }
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

        var priv = 'Add Data_21';

        $.ajax({
            url: "{{url('privcheck')}}",
            type: 'GET',
            data: { priv: priv },
            success: function (response) {
                if(response.status == "success") {

                    location.href= "{{ url('addorderpage') }}";


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

function vieworder(id) {
    location.href= "{{ url('vieworderdetpage') }}" + "/" + id;
}

function viewinvoice(id) {

  var priv = 'View Invoice Data_19';
    $.ajax({
      url: "{{url('privcheck')}}",
      type: 'GET',
      data: { priv: priv },
      success: function (response) {
          if(response.status == "success") {

              $.ajax({
                    url: "{{ url('viewinvoicedetpage') }}" + "/" + id,
                    type: 'GET',
                    data: { },
                    success: function (response) {
                        if(response.status == "success") {

                          location.href = "{{ url('viewinvoice') }}" + "/" + id;


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

</script>

@endsection