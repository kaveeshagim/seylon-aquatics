@extends('layouts.app')

@section('content')
<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">


        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Sales Report</span>
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
                
            <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
              <div class="flex items-center flex-1 space-x-4">
                  <h5>
                      <span class="text-gray-500">Total sales:</span>
                      <span id="total-sales" class="dark:text-white">Loading...</span>
                  </h5>
                  <h5>
                      <span class="text-gray-500">Total discounts:</span>
                      <span id="total-discounts" class="dark:text-white">Loading...</span>
                  </h5>
              </div>

          </div>

<form class="max-w-sm mx-auto">
  <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an duration</label>
  <select onchange="searchdata()" id="date-filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option value="day">By day</option>
  <option value="week">By Week</option>
  <option value="month">By Month</option>
  <option value="year">By Year</option>
  </select>
</form>
            </div>


            <div class="overflow-x-auto">
                <table id="salesreport-table" class="dataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                        <th scope="col" class="p-4">Date</th>
            <th scope="col" class="p-4">Discounts</th>
            <th scope="col" class="p-4">Total Sales</th>
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
    let dateFilter = $('#date-filter').val();
    $('#salesreport-table').DataTable().destroy();

    $.ajax({
        url: "getsalesreport",
        type: "GET",
        data: { date_filter: dateFilter },
        success: function(response) {
            console.log("Data:", response);

            const totalSales = parseFloat(response.total_sales) || 0;
            const totalDiscounts = parseFloat(response.total_discounts) || 0;

            // Update total sales and total discounts
            $('#total-sales').text(totalSales.toFixed(2));
            $('#total-discounts').text(totalDiscounts.toFixed(2));

            // Define the date range based on the selected filter
            let dateRangeText = '';
            let currentDate = new Date();

            switch (dateFilter) {
                case 'day':
                    dateRangeText = `Report Date: ${currentDate.toISOString().split('T')[0]}`;
                    break;
                case 'week':
                    let startOfWeek = new Date(currentDate.setDate(currentDate.getDate() - currentDate.getDay()));
                    let endOfWeek = new Date(startOfWeek);
                    endOfWeek.setDate(startOfWeek.getDate() + 6);
                    dateRangeText = `Report Week: ${startOfWeek.toISOString().split('T')[0]} to ${endOfWeek.toISOString().split('T')[0]}`;
                    break;
                case 'month':
                    let year = currentDate.getFullYear();
                    let month = currentDate.toLocaleString('default', { month: 'long' });
                    dateRangeText = `Report Month: ${month} ${year}`;
                    break;
                case 'year':
                    dateRangeText = `Report Year: ${currentDate.getFullYear()}`;
                    break;
                default:
                    dateRangeText = 'All Time Report';
            }

            // Initialize the DataTable with the retrieved data
            $('#salesreport-table').DataTable({
                "processing": true,
                "deferRender": true,
                "data": response.data,
                "columns": [
                    { "data": "date_time", "title": "Date" }, // Add the date column
                    { "data": "total_gross", "title": "Total Gross" },
                    { "data": "total_final", "title": "Total Final" }
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
                        const cells = $(this).find('td');
                        cells.each(function() {
                            $(this).addClass('p-2 w-4');
                        });
                    });
                },
                "columnDefs": [
                    { className: "text-center", "targets": [0, 1] }
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        title: 'Sales Report',
                        messageTop: dateRangeText,
                        text: 'Export to Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Sales Report',
                        messageTop: dateRangeText,
                        text: 'Export to PDF',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        title: 'Sales Report',
                        messageTop: dateRangeText,
                        text: 'Print'
                    }
                ],
                "pageLength": 25,
                "searching": true
            });
        }
    });
}


</script>
@endsection