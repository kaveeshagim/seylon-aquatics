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

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose fish week</h3>
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

                <h3 class="mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose upload method</h3>
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
                    </div>

                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600">

                    <button type="button" onclick="submitFishList('excel')" id="submitButton" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
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
                        <div class="grid gap-4 sm:grid-cols-6 sm:gap-6 w-full">
                        <div class="w-full">
                            <label for="fish_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fish Code</label>
                            <select name="fish_code" id="fish_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled selected>Select a Fish Code</option>
                                @foreach($fishvarietylist as $fish)
                                    <option value="{{ $fish->fish_code }}">{{ $fish->common_name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <div class="w-full">
                                <label for="gross_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gross Price</label>
                                <input type="text" name="gross_price" id="gross_price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
                            <div class="w-full">
                                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            </div>
                            <div class="w-full">
                                <label for="special_offer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Special Offer</label>
                                <select name="special_offer" id="special_offer" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discount</label>
                                <input type="text" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                            <div class="w-full">
                                <label for="stock_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Status</label>
                                <input type="text" name="stock_status" id="stock_status" value="in-stock" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                            </div>
                            <button type="button" onclick="addRecord()" class="inline-flex items-center px-5 py-2.5 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Add Record
                            </button>

                        </div>

                        <table id="recordsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fish Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gross Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Special Offer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Discount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
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
    const grossPrice = document.getElementById('gross_price').value;
    const quantity = document.getElementById('quantity').value;
    const specialOffer = document.getElementById('special_offer').value;
    const discount = document.getElementById('discount').value;

    // Check if all fields are filled
    if (fishCode && grossPrice && quantity && specialOffer && (specialOffer === 'no' || (specialOffer === 'yes' && discount))) {
        const record = { fishCode, grossPrice, quantity, specialOffer, discount };
        records.push(record);

        updateTable();
        clearForm();
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
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-50">${record.grossPrice}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-50">${record.quantity}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-50">${record.specialOffer}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-50">${record.discount}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button onclick="editRecord(${index})" type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    <button onclick="deleteRecord(${index})" type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</button>
                </td>
            </tr>
        `;
    });
}

function clearForm() {
    document.getElementById('weeklylistForm')[0].reset();
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
    const form = document.getElementById('weeklylistForm');
    const formData = new FormData(form);

    const selectedWeek = document.querySelector('input[name="week-radio"]:checked').value;
    formData.append('fish_week', selectedWeek);

    let ajaxUrl;

    if (method === 'excel') {
        ajaxUrl = '{{ url("fishweeklyuploadexcel") }}';
    } else if (method === 'form') {
        ajaxUrl = '{{ url("fishweeklyuploadform") }}';
    }

    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.status == "success"){
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {

                    }
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");

                } else if(response.status == "error"){
                bootbox.alert({
                    message: response.message,
                    backdrop: true,
                    callback: function () {
 
                    }
                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Form submission failed: ' + textStatus + ' ' + errorThrown);
        }
    });
}


function refresh() {
    $('#weeklylistForm')[0].reset();
    $('#excelForm').addClass('hidden');
    $('#formSubmission').addClass('hidden');
}

</script>


@endsection