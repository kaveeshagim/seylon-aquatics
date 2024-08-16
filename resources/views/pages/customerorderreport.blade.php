@extends('layouts.app')

@section('content')
<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">

    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Customer Order Report</span>
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

            <div class="overflow-x-auto">
                <table id="customerorderreport-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Order Date</th>
                            <th scope="col" class="px-6 py-3">Order Number</th>
                            <th scope="col" class="px-6 py-3">Customer Name</th>
                            <th scope="col" class="px-6 py-3">Executive Name</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Total Orders</th>
                            <th scope="col" class="px-6 py-3">Total Bags</th>
                            <th scope="col" class="px-6 py-3">Total Boxes</th>
                            <th scope="col" class="px-6 py-3">Total Fish</th>
                            <th scope="col" class="px-6 py-3">Order Total</th>
                            <th scope="col" class="px-6 py-3">Discount Applied</th>
                            <th scope="col" class="px-6 py-3">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated by DataTables -->
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

    let dateRangeText = '';
    dateRangeText = `Report Date: ${fromDate} to ${toDate}`;

    $('#customerorderreport-table').DataTable().destroy();

    $.ajax({
        url: "getcustomerorderreport",
        type: "GET",
        data: {
            from_date: fromDate,
            to_date: toDate,
            status: status
        },
        success: function(response) {
            console.log("Data:", response);

            // Initialize the DataTable with the retrieved data
            $('#customerorderreport-table').DataTable({
                "processing": true,
                "deferRender": true,
                "data": response,
                "columns": [
                    { "data": "order_date"},
                    { "data": "order_no"},
                    { "data": "customer_name"},
                    { "data": "executive_name"},
                    {
                        "data": "status",
                        sortable: false,
                        "render": function(data, type, full, meta) {
                            if(full.status == 'pending') {
                            return '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">' + full.status + '</span>';

                            }else if(full.status == 'confirmed') {
                            return '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">' + full.status + '</span>';

                            }else if(full.status == 'cancelled') {
                            return '<span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-red-900 dark:text-red-300">' + full.status + '</span>';

                            }else if(full.status == 'completed') {
                            return '<span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">' + full.status + '</span>';

                            }
                        }
                    },
                    { "data": "tot_orders"},
                    { "data": "tot_bags"},
                    { "data": "tot_boxes"},
                    { "data": "tot_fish"},
                    { "data": "order_total"},
                    { "data": "discount_applied"},
                    { "data": "remarks" }
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        title: 'Customer Order Report',
                        messageTop: dateRangeText,
                        text: 'Export to Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Customer Order Report',
                        messageTop: dateRangeText,
                        text: 'Export to PDF',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        title: 'Customer Order Report',
                        messageTop: dateRangeText,
                        text: 'Print'
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
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] }
        ],
                "pageLength": 25,
                "searching": true
            });
        }
    });
}

</script>
@endsection