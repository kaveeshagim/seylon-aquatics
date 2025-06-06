@extends('layouts.app')

@section('content')
<div>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">

    <form id="privilegeForm">
    @csrf        
    <!-- <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"> -->
    <div class="p-4 mb-4 bg-gray-50 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Add privilege</h3>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            
            <div class="w-full">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category<span class="text-red-500">*</span></label>
                <select onchange="load_sub_category()"  id="category" name="category" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">- Select category -</option>
                    @foreach($categorylist as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full">
                <label for="subcategory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category<span class="text-red-500">*</span></label>
                <select id="subcategory" name="subcategory" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">- Select subcategory -</option>

                </select>
            </div>

            <div class="w-full">
                <label for="privilegesection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Privilege Section<span class="text-red-500">*</span></label>
                <input onchange="gen_route_name()" type="text" id="privilegesection" name="privilegesection" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required/>
            </div>

            <div class="w-full">
                <label for="routename" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Route Name<span class="text-red-500">*</span></label>
                <input type="text" id="routename" name="routename" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly required/>
            </div>
            </div>
        
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">

    
            <button type="button" onclick="submitForm()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            <button onclick="refresh()" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Cancel</button>
        </div>
        </form>

        </div>
        </section>


        <script>
            function validateRequiredFields(fields) {
                for (let field of fields) {
                    if (!document.getElementById(field).value.trim()) {
                        return false; // Return false if any field is empty
                    }
                }
                return true; // Return true if all fields are filled
            }


function submitForm() {
    const requiredFields = ['category', 'subcategory', 'privilegesection', 'routename'];

    if (!validateRequiredFields(requiredFields)) {
        // Display bootbox alert if any required field is empty
        bootbox.alert({
            message: "All fields are required. Please fill out all the fields.",
            backdrop: true,
            callback: function () {}
        }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
    } else {
        // Proceed with AJAX submission if all fields are filled
        const form = document.getElementById('privilegeForm');
        const formData = new FormData(form);

        $.ajax({
            url: '{{url('addprivilegesection')}}',
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from automatically transforming the data into a query string
            contentType: false, // Set content type to false so that jQuery doesn't override it
            success: function(response) {
                if (response.status === "success") {
                    bootbox.alert({
                        message: response.message,
                        backdrop: true,
                        callback: function () {
                            refresh();
                        }
                    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");
                } else if (response.status === "error") {
                    bootbox.alert({
                        message: response.message,
                        backdrop: true,
                        callback: function () {}
                    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Form submission failed:', textStatus, errorThrown);
            }
        });
    }
}
</script>



<script>
    function gen_route_name() {

        var category = document.getElementById('subcategory').value;

        if(category !== ''){
            var sec_name = document.getElementById('privilegesection').value;
            var sub_cat_id = document.getElementById('subcategory').value;

            document.getElementById('routename').value = sec_name + '_' + sub_cat_id;
        }else {

            bootbox.alert({
                message: "Please Select Sub Category",
                backdrop: true,
                size: 'small',
                callback: function () {
                    document.getElementById('privilegesection').value = '';
                }
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
        }

    }
</script>

<script>
    function load_sub_category() {

        document.getElementById("privilegesection").value = '';
        document.getElementById("routename").value = '';
        var cat_id = document.getElementById("category").value;

        $.ajax({
            url: 'get_sub_categories',
            type: 'GET',
            data: {cat_id: cat_id},
            success: function (response) {

                var model = $('#subcategory');
                model.empty();

                var datalist = "<option value=''> -- Select -- </option>";
                $.each(response.data, function (index, element) {
                    datalist += "<option value='" + element.id + "'>" + element.name + "</option>";
                });

                model.html(datalist);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }
</script>

<script>
    function refresh() {
        // Reset the form fields
        $('#privilegeForm')[0].reset();
        
        // Clear the subcategory select options
        var subcategorySelect = document.getElementById('subcategory');
        subcategorySelect.innerHTML = "<option value=''>- Select subcategory -</option>";
    }
</script>




@endsection