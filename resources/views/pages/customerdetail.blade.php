@extends('layouts.app')

@section('content')



<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

    <div class="px-4">

<div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Customer Detail</h1>
    </div>
    <!-- Right Content -->
    <div class="col-span-full xl:col-auto">
        <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                <img class="mb-4 rounded-full w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" src="{{ asset(session('avatar') ? 'storage/' . session('avatar') : 'images/userjpeg.jpeg') }}" alt="Jese picture">
                <div>
                <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">
                    {{ $data->title . ' ' . $data->fname . ' ' . $data->lname }}
                </h3>
                </div>
            </div>
        </div>
        <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">Order Summary</h3>
            <div class="mb-4">
                <div class="mb-1 text-sm font-medium text-gray-900 dark:text-white">No of Orders : {{ $ordercount}}</div>
                <div class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Completed Orders : {{ $completedordercount}}</div>
                <div class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Pending Orders : {{ $pendingordercount}}</div>
                <div class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Rejected Orders : {{ $rejectedordercount}}</div>
                <div class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Completed Invoices : {{ $completedinvoicecount}}</div>
            </div>
        </div>


    </div>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
            <form action="#">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ $data->fname}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ $data->lname}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                        <input type="text" name="country" id="country" value="{{ $data->country}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" id="address" value="{{ $data->address}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" value="{{ $data->email}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary Contact</label>
                        <input type="primary_contact" name="primary_contact" id="primary_contact" value="{{ $data->primary_contact}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Secondary Contact</label>
                        <input type="secondary_contact" name="secondary_contact" id="secondary_contact" value="{{ $data->secondary_contact}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="executive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Executive in Charge</label>
                        <input type="text" name="executive" id="executive" value="{{ $data->executive_id}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                        <input hidden type="text" name="cusid" id="cusid" value="{{ $data->id }}">
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button onclick="editcustomer()" type="button" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
    
</div>
<div class="grid grid-cols-1 px-4">
    <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0">
        <div class="flow-root">
            <h3 class="text-xl font-semibold dark:text-white">Order History</h3>
            <!-- <button type="button" onclick="searchdata()" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                        </svg>
                        Search
                    </button> -->
            <div class="overflow-x-auto">
                <table id="orders-table" class="dataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">Date</th>
                            <th scope="col" class="p-4">Order No</th>
                            <th scope="col" class="p-4">Status</th>
                            <th scope="col" class="p-4">Order Detail</th>
                            <th scope="col" class="p-4">Invoice Detail</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

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

  var id = $('#cusid').val();

  $.ajax({
    url: "{{ url('getorderdetail') }}/" + id,
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
          { "data": "id" },
          { "data": "status" },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
                  return '<td><button type="button" onclick="vieworder(\'' + full.id + '\')"class="text-xs py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">'+
                        '<path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />'+
                        '<path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />'+
                    '</svg>'+
                    'View Order'+
                '</button>';
            }

          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
             return    '<td><button type="button" onclick="viewinvoice(\'' + full.id + '\')"class="text-xs flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">'+
                                            '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />'+
                                        '</svg>'+
                                        'View Invoice'+
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

            // rows.each(function() {
            //     $(this).addClass('border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700');
                
            //     const cells = $(this).find('td');
            //     cells.each(function() {
            //         $(this).addClass('p-2 w-4');
            //     });
            // });
        },
        "columnDefs": [
          { className: "text-center", "targets": [0,1,2] }
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



</script>


<script>
    function editcustomer() {
    var id = $('#cusid').val();
    location.href = "{{url('editcustomerpage')}}" + "/" + id;
}
    </script>


@endsection