@extends('layouts.app')

@section('content')

<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Add Fish Weekly List</span>
                    </h5>
                    
                </div>
            </div>


            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose fish week<span class="text-red-500">*</span></h3>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-gray-50 border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="currentweek" type="radio" value="currentweek" name="week-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="currentweek" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Current</label>
                        </div>
                    </li>
                    <li class="w-full dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="newweek" type="radio" value="newweek" name="week-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="newweek" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">New</label>
                        </div>
                    </li>
                </ul>

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose upload method<span class="text-red-500">*</span></h3>
                <p class="mb-4 text-xs font-medium text-gray-600 dark:text-gray-400">
                    <span class="font-semibold text-gray-900 dark:text-gray-300">Note:</span> 
                    The 'Excel upload' method is better suited for bulk data, while the 'Form submission' is more convenient for smaller entries.
                </p>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-gray-50 border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="excelupload" type="radio" value="excelupload" name="upload-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="excelupload" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Excel Upload</label>
                        </div>
                    </li>
                    <li class="w-full dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="formsub" type="radio" value="formsub" name="upload-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="formsub" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Form Submission</label>
                        </div>
                    </li>
                </ul>

            </div>
            <!-- <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700"> -->

            <div id="excelForm" class="hidden flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                <form id="weeklylistForm" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-4 sm:gap-6 w-full">
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="excel_input">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="excel_input_help" id="excel_input" name="excel_input" type="file" onchange="validateFile()">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="excel_input_help">Supported formats: .xlsx, .xls. Max file size: 5MB.</p>
                        </div>
                        <div class="w-full">
                            <button type="button" onclick="validateExcel()" id="validateButton" class="inline-flex items-center px-3 py-2 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                                Validate Excel
                            </button>
                        </div>
                    </div>

                    <table id="recordsTableExcel" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-5">
                            <thead>
                            <tr>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fish Code</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Common Name</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Size</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Size in cm</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gross Price(USD)</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Special Offer</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Discount(%)</th>
                                </tr>
                            </thead>
                            <tbody id="recordsBodyExcel">
                                <!-- Dynamic rows go here -->
                            </tbody>
                        </table>

                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

                    <button type="button" onclick="submitFishListExcel('excel')" id="submitButtonExcel" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800" disabled="true">
                        Submit
                    </button>
                    <button type="button" onclick="refresh()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                        Cancel
                    </button>
                    <a href="{{ route('downloadsampleexcel') }}" class="no-underline inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Download Sample Excel
                    </a>
                </form>
            </div>



                <div id="formSubmission" class="hidden flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <form id="weeklylistForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="grid gap-4 sm:grid-cols-6 sm:gap-6 w-full">
                            <div class="w-full">
                                <label for="fish_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Code</label>
                                <select name="fish_code" id="fish_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="" disabled selected>Select a Fish Code</option>
                                    @foreach($fishvarietylist as $fish)
                                        <option value="{{ $fish->fish_code }}">{{ $fish->fish_code }} - {{ $fish->common_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full">
                                <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                <input readonly type="text" name="size" id="size" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>

                            </div>

                            <div class="w-full">
                                <label for="size_cm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                <input readonly type="text" name="size_cm" id="size_cm" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>

                            </div>

                            <div class="w-full">
                                <label for="gross_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit Price(USD)</label>
                                <input type="text" name="gross_price" id="gross_price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
                            <div class="w-full">
                                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
                            <div class="w-full">
                                <label for="special_offer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Special Offer</label>
                                <select name="special_offer" id="special_offer" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discount(%)</label>
                                <input type="text" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                            <button type="button" onclick="addRecord()" class="inline-flex items-center px-5 py-2.5 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add Record
                            </button>

                        </div>

                        <table id="recordsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fish Code</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Size</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Size in cm</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Price(USD)</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Special Offer</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Discount(%)</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="recordsBody">
                                <!-- Dynamic rows go here -->
                            </tbody>
                        </table>



                        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

                        <button type="button" onclick="submitFishList('form')" id="submitButton" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
                            Submit
                        </button>
                        <button type="button" onclick="refresh()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                            Cancel
                        </button>
                    </form>
                </div>
            <!-- </div> -->
            </div>


    </div>
</section>
<!-- End block -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadRadios = document.querySelectorAll('input[name="upload-radio"]');

    uploadRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            toggleForms(this.value);
        });
    });
});

function validateFile() {
        const fileInput = document.getElementById('excel_input');
        const file = fileInput.files[0];
        const validExtensions = ['xlsx', 'xls'];
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes

        if (file) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const fileSize = file.size;

            if (!validExtensions.includes(fileExtension)) {
                bootbox.alert({
                    message: "Invalid file format. Please upload a .xlsx or .xls file.",
                    size: 'small'
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                fileInput.value = ''; // Clear the input
                return;
            }

            if (fileSize > maxSize) {
                bootbox.alert({
                    message: "File size exceeds the 5MB limit. Please upload a smaller file.",
                    size: 'small'
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                fileInput.value = ''; // Clear the input
                return;
            }
        }
    }

    function showBootboxAlert(message, color) {
    bootbox.alert({
        message: message,
        size: 'small'
    }).find('.modal-content').addClass(`flex items-center p-4 mb-4 text-sm text-${color}-800 border border-${color}-300 rounded-lg bg-${color}-50 dark:bg-gray-800 dark:text-${color}-400 dark:border-${color}-800`);
}


function displayTable(fishData, rows) {
    console.log('Displaying table data:', fishData, rows); // Debugging line
    const tbody = document.getElementById('recordsBodyExcel');
    
    if (!tbody) {
        console.error('Could not find tbody with ID "recordsBodyExcel"');
        return;
    }
    
    tbody.innerHTML = ''; // Clear existing rows

    rows.forEach(row => {
        const fishDetails = fishData[row.fish_code] || { size: 'N/A', size_cm: 'N/A' };
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${row.fish_code}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${fishDetails.common_name}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${fishDetails.size || ''}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${fishDetails.size_cm}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${row.gross_price}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${row.quantity}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${row.special_offer}</td>
            <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${row.discount}</td>
        `;
        tbody.appendChild(tr);
    });

    console.log('Table populated successfully'); // Debugging line
}


function fetchFishData(validatedRows) {
    const fishCodes = validatedRows.map(row => row.fish_code.trim());
    startspinner();
    $.ajax({
        url: '{{url('fetchfishweeklyexceldata')}}',
        type: 'POST',
        dataType: 'json',
        data: {
            fish_codes: fishCodes,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            stopspinner();
            console.log(response.fishData);

            if(response.status == 'success') {
                displayTable(response.fishData, validatedRows);
                $('#submitButtonExcel').prop('disabled', false);
            }else if(response.status == 'error') {
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {}
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
                // Parse the JSON response to get the error messages
                var response = jqXHR.responseJSON;

                // Default error message
                var errorMessage = 'Form submission failed.';

                // Check if there are validation errors
                if (response && response.errors) {
                    // Collect all error messages
                    var errorMessages = [];
                    var errors = response.errors;
                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMessages.push(errors[field][0]); // Add each error message to the array
                        }
                    }

                    // Join all error messages into a single string
                    errorMessage = errorMessages.join('<br>'); // Using <br> to create new lines between messages
                }

                // Show the error message(s) in a bootbox alert
                bootbox.alert({
                    message: errorMessage,
                    backdrop: true,
                    callback: function () {}
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }
    });
}




function validateExcel() {

    const fileInput = document.getElementById('excel_input');
    const file = fileInput.files[0];

    if (!file) {
        showBootboxAlert('Please select an Excel file.', 'red');
        return;
    }

    if (!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(file.type)) {
        showBootboxAlert('Invalid file type. Please upload an .xlsx or .xls file.', 'red');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        showBootboxAlert('File size exceeds 5MB.', 'red');
        return;
    }

    const reader = new FileReader();

    reader.onload = function(event) {
        try {
            const data = new Uint8Array(event.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const sheetName = workbook.SheetNames[0];
            const worksheet = workbook.Sheets[sheetName];
            const json = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

            if (json.length === 0) {
                showBootboxAlert('Excel file is empty.', 'red');
                return;
            }

            const headers = json[0];
            const requiredHeaders = ['fish_code', 'gross_price', 'quantity', 'special_offer', 'discount'];

            if (!requiredHeaders.every(header => headers.includes(header))) {
                showBootboxAlert('Invalid column headers.', 'red');
                return;
            }

            const rows = json.slice(1);
            if (rows.length === 0) {
                showBootboxAlert('There must be at least one data row.', 'red');
                return;
            }

            const validatedRows = [];
            for (const row of rows) {
                if (row.length !== headers.length) {
                    showBootboxAlert('Invalid number of columns in a row.', 'red');
                    return;
                }

                // Trim whitespace from each cell in the row
                const [fish_code, gross_price, quantity, special_offer, discount] = row.map(cell => cell ? cell.toString().trim() : '');

                if (!fish_code || !gross_price || !quantity || !special_offer) {
                    showBootboxAlert('Required fields are missing in a row.', 'red');
                    return;
                }

                if (isNaN(gross_price) || parseFloat(gross_price) <= 0) {
                    showBootboxAlert('Invalid gross price.', 'red');
                    return;
                }

                if (isNaN(quantity) || parseInt(quantity) <= 0) {
                    showBootboxAlert('Invalid quantity.', 'red');
                    return;
                }

                if (!['yes', 'no'].includes(special_offer)) {
                    showBootboxAlert('Invalid special offer value. Must be "yes" or "no".', 'red');
                    return;
                }

                if (special_offer === 'no' && discount !== '') {
                    showBootboxAlert('Discount should be empty when special offer is "no".', 'red');
                    return;
                }

                if (special_offer === 'yes' && (discount === '' || isNaN(discount) || parseFloat(discount) < 0)) {
                    showBootboxAlert('Invalid discount value. It must be a non-negative, greater than 0 number if special offer is "yes".', 'red');
                    return;
                }

                // Push validated row
                validatedRows.push({ fish_code, gross_price, quantity, special_offer, discount });
            }

            // Fetch size and size_cm for each fish_code using jQuery AJAX
            fetchFishData(validatedRows);

        } catch (error) {
            console.error('Error reading Excel file:', error);
            showBootboxAlert('An error occurred while processing the Excel file.', 'red');
        }
    };

    reader.readAsArrayBuffer(file);
}




function toggleForms(uploadMethod) {
    const excelForm = document.getElementById('excelForm');
    const formSubmission = document.getElementById('formSubmission');

    if (uploadMethod === 'excelupload') {
        excelForm.classList.remove('hidden');
        formSubmission.classList.add('hidden');
    } else if (uploadMethod === 'formsub') {
        excelForm.classList.add('hidden');
        formSubmission.classList.remove('hidden');
    }
}

let records = [];

function addRecord() {
    const fishCode = document.getElementById('fish_code').value;
    const size = document.getElementById('size').value;
    const sizeCm = document.getElementById('size_cm').value;
    const grossPrice = document.getElementById('gross_price').value;
    const quantity = document.getElementById('quantity').value;
    const specialOffer = document.getElementById('special_offer').value;
    let discountValue = document.getElementById('discount').value;

    // Sanitize discount value by removing any non-numeric characters except the decimal point
    discountValue = discountValue.replace(/[^\d.]/g, '');
    const discount = discountValue === '' ? 0 : parseFloat(discountValue);

    // Check if all required fields are filled
    if (fishCode && grossPrice && quantity && specialOffer) {
        // If special offer is 'yes', validate discount
        if (specialOffer === 'yes') {
            if (isNaN(discount) || discount <= 0) {
                bootbox.alert({
                    message: "Please provide a valid discount greater than 0 when special offer is 'yes'.",
                    size: 'small'
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                return;
            }

            // Check if discount is greater than 100%
            if (discount > 100) {
                bootbox.alert({
                    message: "Discount cannot be greater than 100%. Please enter a valid discount.",
                    size: 'small'
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                return;
            }
        } else {
            // If special offer is 'no', discount should be 0
            if (discount !== 0) {
                bootbox.alert({
                    message: "Discount should be empty when special offer is 'no'.",
                    size: 'small'
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                return;
            }
        }

        // Check if a record with the same fish code already exists
        const recordExists = records.some(record => record.fishCode === fishCode);

        if (recordExists) {
            bootbox.alert({
                message: "A record with this fish code already exists. Please use a different fish code.",
                size: 'small'
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        } else {
            const record = { fishCode, size, sizeCm, grossPrice, quantity, specialOffer, discount };
            records.push(record);

            updateTable();
            clearForm();
        }
    } else {
        // Display Bootbox alert if any required field is empty
        bootbox.alert({
            message: "Please fill in all required fields before adding the record.",
            size: 'small'
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
    }
}



function updateTable() {
    const tableBody = document.getElementById('recordsBody');
    tableBody.innerHTML = '';

    records.forEach((record, index) => {
        tableBody.innerHTML += `
            <tr>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.fishCode}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.size}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.sizeCm}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.grossPrice}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.quantity}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.specialOffer}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap text-gray-900 dark:text-gray-50">${record.discount}</td>
                <td class="px-2 py-2 text-xs whitespace-nowrap">
                    <button onclick="editRecord(${index})" type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    <button onclick="deleteRecord(${index})" type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</button>
                </td>
            </tr>
        `;
    });
}

function clearForm() {

    // Manually clear each form element by their ID
    document.getElementById('fish_code').selectedIndex = 0; // Reset select to first option
    document.getElementById('size').value = '';
    document.getElementById('size_cm').value = '';
    document.getElementById('gross_price').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('special_offer').selectedIndex = 0; // Reset select to first option
    document.getElementById('discount').value = '';

    // Optionally, if you have additional fields or dynamic content, you can reset them here
}




function editRecord(index) {
    const record = records[index];
    document.getElementById('fish_code').value = record.fishCode;
    document.getElementById('gross_price').value = record.grossPrice;
    document.getElementById('quantity').value = record.quantity;
    document.getElementById('special_offer').value = record.specialOffer;
    document.getElementById('discount').value = record.discount;

    records.splice(index, 1);
    updateTable();
}

function deleteRecord(index) {
    records.splice(index, 1);
    updateTable();
}


function submitFishList(method) {

    if (records.length === 0) {
        bootbox.alert({
            message: "No records to submit. Please add at least one record before submitting.",
            size: 'small'
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        return;
    }

    //csrf token
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Extract the selected week
    const selectedWeekRadio = document.querySelector('input[name="week-radio"]:checked');
    
    if (!selectedWeekRadio) {
        bootbox.alert({
            message: "Please select a week before submitting.",
            size: 'small'
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        return;
    }

    const selectedWeek = selectedWeekRadio.value;

    // Extract table data
    const tableRows = document.querySelectorAll('#recordsTable tbody tr');
    const tableData = [];

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowData = {
            fish_code: cells[0].textContent.trim(),
            size: cells[1].textContent.trim(),
            size_in_cm: cells[2].textContent.trim(),
            gross_price: cells[3].textContent.trim(),
            quantity: cells[4].textContent.trim(),
            special_offer: cells[5].textContent.trim(),
            discount: cells[6].textContent.trim()
        };
        tableData.push(rowData);
    });

    // Prepare the payload
    const payload = {
        fish_week: selectedWeek,
        table_data: tableData
    };

    let ajaxUrl;

    if (method === 'excel') {
        ajaxUrl = '{{ url("fishweeklyuploadexcel") }}';
    } else if (method === 'form') {
        ajaxUrl = '{{ url("fishweeklyuploadform") }}';
    }


    startspinner();

    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
        },
        data: JSON.stringify(payload),
        success: function(response) {
            stopspinner();
            if(response.status == "success"){
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {
                        records = [];
                        updateTable();
                        clearForm();
                    }
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");

            } else if(response.status == "error"){
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {}
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            stopspinner();
                // Parse the JSON response to get the error messages
                var response = jqXHR.responseJSON;

                // Default error message
                var errorMessage = 'Form submission failed.';

                // Check if there are validation errors
                if (response && response.errors) {
                    // Collect all error messages
                    var errorMessages = [];
                    var errors = response.errors;
                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMessages.push(errors[field][0]); // Add each error message to the array
                        }
                    }

                    // Join all error messages into a single string
                    errorMessage = errorMessages.join('<br>'); // Using <br> to create new lines between messages
                }

                // Show the error message(s) in a bootbox alert
                bootbox.alert({
                    message: errorMessage,
                    backdrop: true,
                    callback: function () {}
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }
    });
}

function submitFishListExcel(method) {
    // Check if file is selected
    const fileInput = document.getElementById('excel_input');
    if (!fileInput.files.length) {
        bootbox.alert({
            message: "Please upload an Excel file before submitting.",
            size: 'small'
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        return;
    }

    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Extract the selected week
    const selectedWeekRadio = document.querySelector('input[name="week-radio"]:checked');
    
    if (!selectedWeekRadio) {
        bootbox.alert({
            message: "Please select a week before submitting.",
            size: 'small'
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        return;
    }

    const selectedWeek = selectedWeekRadio.value;

    // Create FormData object to send file and other data
    const formData = new FormData();
    formData.append('excel_input', fileInput.files[0]);
    formData.append('fish_week', selectedWeek);

    // Set the URL based on the method
    let ajaxUrl;
    if (method === 'excel') {
        ajaxUrl = '{{ url("fishweeklyuploadexcel") }}';
    }

    startspinner();
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
            stopspinner();
            if (response.status === "success") {
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {
                        refresh(); // Assuming refresh clears the form or updates the UI
                    }
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");
            } else if (response.status === "error") {
                bootbox.alert({
                    message: response.message,
                    backdrop: true
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            stopspinner();
                // Parse the JSON response to get the error messages
                var response = jqXHR.responseJSON;

                // Default error message
                var errorMessage = 'Form submission failed.';

                // Check if there are validation errors
                if (response && response.errors) {
                    // Collect all error messages
                    var errorMessages = [];
                    var errors = response.errors;
                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMessages.push(errors[field][0]); // Add each error message to the array
                        }
                    }

                    // Join all error messages into a single string
                    errorMessage = errorMessages.join('<br>'); // Using <br> to create new lines between messages
                }

                // Show the error message(s) in a bootbox alert
                bootbox.alert({
                    message: errorMessage,
                    backdrop: true,
                    callback: function () {}
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }
    });
}

document.getElementById('fish_code').addEventListener('change', function() {
    const fishCode = this.value;
    startspinner();
    // Make AJAX request to get the size data based on the selected fish code
    $.ajax({
        url: '{{url('getfishsizedata')}}',
        type: 'GET',
        data: { fish_code: fishCode },
        success: function(response) {
            stopspinner();
            if (response.status === 'success') {
                $('#size').val(response.data.size || '').trigger('change');
                $('#size_cm').val(response.data.size_cm || '').trigger('change');
            } else {
                // Handle the error (optional)
                console.error('Failed to retrieve size data:', response.message);
            }
        },
        error: function() {
            stopspinner();
            console.error('An error occurred while fetching the size data.');
        }
    });
});


function refresh() {
    // Clear the form fields
    document.getElementById('weeklylistForm').reset();

    // Clear the table body content
    document.getElementById('recordsBodyExcel').innerHTML = '';

    // Disable the Submit button
    document.getElementById('submitButtonExcel').disabled = true;

}


</script>


@endsection