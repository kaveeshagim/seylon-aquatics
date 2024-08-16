@extends('layouts.app')

@section('content')

<!-- Start block -->
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased mt-12">


    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

        <div class="bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500 dark:text-white">Add Order</span>
                    </h5>
                    
                </div>
            </div>


            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Enter shipping address</h3>
                <div class="w-full">
                    <textarea name="shippingaddress" id="shippingaddress"  rows="2"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required></textarea>
                </div>

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose upload method</h3>
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
                <form id="orderForm" enctype="multipart/form-data">
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
                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

                    <button type="button" onclick="submitOrderExcel('excel')" id="submitButtonExcel" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800" disabled="true">
                        Submit
                    </button>
                    <button type="button" onclick="refresh()" class="inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                        Cancel
                    </button>
                    <a href="{{ route('downloadSampleOrderExcel') }}" class="no-underline inline-flex items-center px-5 py-2.5 mt-4 ml-2 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Download Sample Excel
                    </a>
                </form>
            </div>



                <div id="formSubmission" class="hidden flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <form id="orderForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="grid gap-4 sm:grid-cols-6 sm:gap-6 w-full">


                        <div class="w-full">
                            <label for="custom-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Code</label>
                            <div class="relative">
                                <!-- Custom Dropdown Container -->
                                <div id="custom-dropdown-container" class="relative">
                                    <!-- Search Input -->
                                    <input type="text" id="search-fish-code" class="block w-full p-2.5 mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search Fish Code...">

                                    <!-- Custom Dropdown -->
                                    <div id="custom-dropdown" class="absolute w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <ul id="custom-dropdown-options" class="max-h-60 overflow-auto p-1">
                                            <!-- Options will be dynamically inserted here -->
                                            @foreach($fishweeklylist as $fish)
                                                <li data-value="{{ $fish->fish_code }}" class="cursor-pointer px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">{{ $fish->fish_code }} - {{ $fish->common_name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Hidden Real Select for Form Submission -->
                                <select name="fish_code" id="fish_code" class="hidden">
                                    <option value="" disabled selected>Select a Fish Code</option>
                                    @foreach($fishweeklylist as $fish)
                                        <option value="{{ $fish->fish_code }}">{{ $fish->fish_code }} - {{ $fish->common_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                            <div class="w-full">
                                <label for="qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                <input type="text" name="qty" id="qty" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>

                            </div>

                            <button type="button" onclick="addRecord()" class="inline-flex items-center px-5 py-2.5 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add Record
                            </button>

                        </div>

                        <table id="recordsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fish Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="recordsBody">
                                <!-- Dynamic rows go here -->
                            </tbody>
                        </table>



                        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

                        <button type="button" onclick="submitOrderForm('form')" id="submitButton" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
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
<style>
#custom-dropdown-container {
    position: relative;
}

#custom-dropdown {
    display: none; /* Hidden by default, shown on focus */
    z-index: 1000;
}

#custom-dropdown-options li {
    cursor: pointer;
}

/* #custom-dropdown-options li:hover {
    background-color: #e5e7eb; 
} */


    </style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadRadios = document.querySelectorAll('input[name="upload-radio"]');

    uploadRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            toggleForms(this.value);
        });
    });


});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-fish-code');
    const dropdown = document.getElementById('custom-dropdown');
    const optionsContainer = document.getElementById('custom-dropdown-options');
    const selectElement = document.getElementById('fish_code');

    // Toggle dropdown visibility
    searchInput.addEventListener('focus', function() {
        dropdown.style.display = 'block';
    });

    searchInput.addEventListener('blur', function() {
        // Delay hiding to allow click on options
        setTimeout(() => {
            dropdown.style.display = 'none';
        }, 200);
    });

    // Filter options based on search input
    searchInput.addEventListener('input', function() {
        const filter = searchInput.value.toLowerCase();
        const options = optionsContainer.querySelectorAll('li');

        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            if (text.includes(filter)) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    });

    // Select option and update real select
    optionsContainer.addEventListener('click', function(event) {
        if (event.target.tagName === 'LI') {
            const selectedValue = event.target.getAttribute('data-value');
            searchInput.value = event.target.textContent;
            selectElement.value = selectedValue;
            dropdown.style.display = 'none'; // Hide dropdown after selection
        }
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




function fetchFishData(validatedRows) {
    const fishCodes = validatedRows.map(row => row.fish_code);

    $.ajax({
        url: '{{url('fetchfishweeklydata')}}',
        type: 'POST',
        dataType: 'json',
        data: {
            fish_codes: fishCodes,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status == 'error') {
                showBootboxAlert(response.message, 'red');
            } else {
                showBootboxAlert(response.message, 'green');
                $('#submitButtonExcel').prop('disabled', false);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fish data:', error);
            showBootboxAlert('An error occurred while fetching fish data.', 'red');
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
            const requiredHeaders = ['fish_code', 'quantity',];

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

                const [fish_code, quantity] = row;

                if (!fish_code || !quantity ) {
                    showBootboxAlert('Required fields are missing in a row.', 'red');
                    return;
                }


                if (isNaN(quantity) || parseInt(quantity) <= 0) {
                    showBootboxAlert('Invalid quantity.', 'red');
                    return;
                }

                // Push validated row
                validatedRows.push({ fish_code, quantity});
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
    const quantity = document.getElementById('qty').value;


    // Check if all fields are filled
    if (fishCode && quantity ) {

            // Check if a record with the same fish code already exists
            const recordExists = records.some(record => record.fishCode === fishCode);

            if (recordExists) {
                bootbox.alert({
                    message: "A record with this fish code already exists. Please use a different fish code.",
                    size: 'small'
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            } else {
                const record = { fishCode, quantity};
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
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-50">${record.fishCode}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-50">${record.quantity}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button onclick="editRecord(${index})" type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    <button onclick="deleteRecord(${index})" type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</button>
                </td>
            </tr>
        `;
    });
}

function clearForm() {

    // Reset the custom dropdown search input
    const searchInput = document.getElementById('search-fish-code');
    searchInput.value = ''; // Clear search input

    // Reset the custom dropdown
    const dropdown = document.getElementById('custom-dropdown');
    const optionsContainer = document.getElementById('custom-dropdown-options');

    // Clear the displayed options
    const options = optionsContainer.querySelectorAll('li');
    options.forEach(option => {
        option.style.display = 'block'; // Show all options again
    });

    // Reset the hidden real select element
    document.getElementById('fish_code').selectedIndex = 0; // Reset select to first option

    // Clear other form fields if needed
    document.getElementById('qty').value = '';
}




function editRecord(index) {
    const record = records[index];
    document.getElementById('search-fish-code').value = record.fishCode;
    document.getElementById('fish_code').value = record.fishCode;
    document.getElementById('qty').value = record.quantity;

    records.splice(index, 1);
    updateTable();
}

function deleteRecord(index) {
    records.splice(index, 1);
    updateTable();
}


function submitOrderForm(method) {

if (records.length === 0) {
    bootbox.alert({
        message: "No records to submit. Please add at least one record before submitting.",
        size: 'small'
    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
    return;
}

// CSRF token
const csrfToken = document.querySelector('input[name="_token"]').value;

// Get shipping address from input field
const shippingAddress = document.querySelector('textarea[name="shippingaddress"]').value;

// Check if shipping address is empty
if (!shippingAddress) {
    bootbox.alert({
        message: "Please enter a shipping address before submitting.",
        size: 'small'
    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
    return;
}

// Extract table data
const tableRows = document.querySelectorAll('#recordsTable tbody tr');
const tableData = [];

tableRows.forEach(row => {
    const cells = row.querySelectorAll('td');
    const rowData = {
        fish_code: cells[0].textContent.trim(),
        quantity: cells[1].textContent.trim(),
    };
    tableData.push(rowData);
});

// Prepare the payload with shipping address
const payload = {
    table_data: tableData,
    shipping_address: shippingAddress // Include shipping address in payload
};

let ajaxUrl;

if (method === 'excel') {
    ajaxUrl = '{{ url("orderuploadexcel") }}';
} else if (method === 'form') {
    ajaxUrl = '{{ url("orderuploadform") }}';
}

$.ajax({
    url: ajaxUrl,
    type: 'POST',
    contentType: 'application/json',
    headers: {
        'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
    },
    data: JSON.stringify(payload),
    success: function(response) {
        if(response.status == "success"){
            bootbox.alert({
                message: response.message,
                backdrop: true,
                callback: function () {
                    records = [];
                    updateTable();
                    clearForm();
                    location.href = "{{ url('vieworderdetpage') }}" + "/" + response.id;
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
        alert('Form submission failed: ' + textStatus + ' ' + errorThrown);
    }
});
}

function submitOrderExcel(method) {
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

    // Get shipping address from input field
    const shippingAddress = document.querySelector('textarea[name="shippingaddress"]').value;

        // Check if shipping address is empty
        if (!shippingAddress) {
        bootbox.alert({
            message: "Please enter a shipping address before submitting.",
            size: 'small'
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        return;
    }

    // Create FormData object to send file and other data
    const formData = new FormData();
    formData.append('excel_input', fileInput.files[0]);
    formData.append('shippingaddress', shippingAddress);

    // Set the URL based on the method
    let ajaxUrl;
    if (method === 'excel') {
        ajaxUrl = '{{ url("orderuploadexcel") }}';
    }

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
            if (response.status === "success") {
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {
                        location.href = "{{ url('vieworderdetpage') }}" + "/" + response.id; // Assuming refresh clears the form or updates the UI
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
            bootbox.alert({
                message: 'Form submission failed: ' + textStatus + ' ' + errorThrown,
                backdrop: true
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        }
    });
}


document.getElementById('fish_code').addEventListener('change', function() {
    const fishCode = this.value;

    // Make AJAX request to get the size data based on the selected fish code
    $.ajax({
        url: '{{url('getfishsizedata')}}',
        type: 'GET',
        data: { fish_code: fishCode },
        success: function(response) {
            if (response.status === 'success') {
                $('#size').val(response.data.size || '').trigger('change');
                $('#size_cm').val(response.data.size_cm || '').trigger('change');
            } else {
                // Handle the error (optional)
                console.error('Failed to retrieve size data:', response.message);
            }
        },
        error: function() {
            console.error('An error occurred while fetching the size data.');
        }
    });
});


function refresh() {
    // Clear the form fields
    document.getElementById('orderForm').reset();

    // Clear the table body content
    // document.getElementById('recordsBodyExcel').innerHTML = '';

    // Disable the Submit button
    document.getElementById('submitButtonExcel').disabled = true;
}

function vieworder(id) {
    location.href= "{{ url('vieworderdetpage') }}" + "/" + id;
}

</script>


@endsection