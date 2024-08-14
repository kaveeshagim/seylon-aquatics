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
                
                <form class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
                    <div>
                        <label for="from-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">From Date</label>
                        <input type="date" id="from-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="to-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">To Date</label>
                        <input type="date" id="to-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table id="customerorderreport-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Order Number</th>
                            <th scope="col" class="px-6 py-3">Customer Name</th>
                            <th scope="col" class="px-6 py-3">Customer ID</th>
                            <th scope="col" class="px-6 py-3">Executive ID</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Advanced Payment</th>
                            <th scope="col" class="px-6 py-3">Shipping Address</th>
                            <th scope="col" class="px-6 py-3">Total Orders</th>
                            <th scope="col" class="px-6 py-3">Total Bags</th>
                            <th scope="col" class="px-6 py-3">Total Boxes</th>
                            <th scope="col" class="px-6 py-3">Order Date</th>
                            <th scope="col" class="px-6 py-3">Delivery Date</th>
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
    let fromDate = $('#from-date').val();
    let toDate = $('#to-date').val();

    $('#customerorderreport-table').DataTable().destroy();

    $.ajax({
        url: "getcustomerorderreport",
        type: "GET",
        data: {
            from_date: fromDate,
            to_date: toDate
        },
        success: function(response) {
            console.log("Data:", response);

            // Initialize the DataTable with the retrieved data
            $('#customerorderreport-table').DataTable({
                "processing": true,
                "deferRender": true,
                "data": response,
                "columns": [
                    { "data": "order_no", "title": "Order Number" },
                    { "data": "customer_name", "title": "Customer Name" },
                    { "data": "cus_id", "title": "Customer ID" },
                    { "data": "executive_id", "title": "Executive ID" },
                    { "data": "status", "title": "Status" },
                    { "data": "advanced_payment", "title": "Advanced Payment" },
                    { "data": "shipping_address", "title": "Shipping Address" },
                    { "data": "tot_orders", "title": "Total Orders" },
                    { "data": "tot_bags", "title": "Total Bags" },
                    { "data": "tot_boxes", "title": "Total Boxes" },
                    { "data": "created_at", "title": "Order Date" },
                    { "data": "delivery_date", "title": "Delivery Date" },
                    { "data": "order_total", "title": "Order Total" },
                    { "data": "discount_applied", "title": "Discount Applied" },
                    { "data": "remarks", "title": "Remarks" }
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        title: 'Customer Order Report',
                        text: 'Export to Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Customer Order Report',
                        text: 'Export to PDF',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        title: 'Customer Order Report',
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
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14] }
        ],
                "pageLength": 25,
                "searching": true
            });
        }
    });
}

</script>
@endsection