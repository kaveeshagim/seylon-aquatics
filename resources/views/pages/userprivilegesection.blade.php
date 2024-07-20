@extends('layouts.app')

@section('content')
<div>
    <div id="alertArea" class="z-2"></div>

    <h4 class="text-2xl font-bold dark:text-white">Add User Privilege</h4>
    <hr class="w-full h-1 my-4 bg-gray-900 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="mb-5"></div>

    <form id="privilegeForm">
    @csrf     
    
        <div>
            <label for="usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
            <select onchange="load_cat_data()"  id="usertype" name="usertype" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select usertype -</option>
                @foreach($usertypelist as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select onchange="load_sub_category()" id="category" name="category" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select category -</option>
                @foreach($categorylist as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="subcategory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category</label>
            <select id="subcategory" name="subcategory" onchange="load_sections()" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">- Select subcategory -</option>
            </select>
        </div>
        
        <br>

        <div class="row" style="margin-top:30px">
            <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12" style="padding-left:0px;">
                <table id="sec_table" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background-color:#9cc1ea">
                            <th width="40%" class="text-center"><p>Section Name</p></th>
                            {{--<th width="10%" class="text-center"><span class="glyphicon glyphicon-ok" ></span></th>--}}
                            <th width="10%" style="padding-left: 30px"><input id="select_all" name="select_all" type="checkbox" onclick="Test()"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">

        </div>
    
        <button type="button" onclick="save_privilege()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        <button onclick="refresh()" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Cancel</button>
    </form>

</div>


<script>

$(document).ready(function() {
    $('#privilegeForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'addprivilegesection',
            type: 'POST',
            data: $(this).serialize(), 
            success: function(response) {
                console.log(response);
                var alertArea = document.getElementById('alertArea');

                if(response === "failed"){

                    var errorAlert = `<div id="alert-border-3" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                        Username already exists.
                        </div>
                        <button id="dismiss-button" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        </button>
                    </div>`;

                    alertArea.innerHTML = errorAlert;


                }else{

                    var successAlert = `<div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                        User added.
                        </div>
                        <button id="dismiss-button" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        </button>
                    </div>`;

                    alertArea.innerHTML = successAlert;
                    window.location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Form submission failed:', textStatus, errorThrown);
            }
        });
    });
});

    
</script>


<script>

    function Test() {

        var items = document.getElementById('sec_table');
        var total_rows = items.tBodies[0].rows.length;

        for (var i = 1; total_rows >= i; i++) {

            var row = items.rows[i];
            var select_all = items.rows[0].cells[1].childNodes[0].checked;

            if(select_all === true){
                row.cells[1].childNodes[0].checked = true;
            }else{
                row.cells[1].childNodes[0].checked = false;
            }
        }
    }

    function load_cat_data() {

        $.ajax({
            dataType: "json",
            url: 'get_categories',
            type: 'GET',
            success: function (response) {

                var model = $('#category');
                model.empty();

                var datalist;
                datalist += "<option value = 'All'> -- All -- </option>";
                $.each(response, function (index, element) {
                    $.each(element, function (colIndex, c) {
                        datalist += "<option value='" + c.id + "'>"+c.name +"</option>";
                    });
                });
                $('#category').html(datalist);
            }
        });
    }


    function load_sub_category() {

        var cat_id = document.getElementById("category").value;

        $.ajax({
            url: 'get_sub_categories',
            type: 'GET',
            data: {cat_id: cat_id},
            success: function (response) {

                var model = $('#subcategory');
                model.empty();

                var datalist;
                datalist += "<option value = 'All'> -- Select -- </option>";
                $.each(response, function (index, element) {
                    $.each(element, function (colIndex, c) {
                        datalist += "<option value='" + c.id + "'>"+c.name +"</option>";
                    });
                });
                $('#subcategory').html(datalist);
            }
        });
    }

    function load_sections() {

        var sub_cat_id = document.getElementById("subcategory").value;
        var user_type = document.getElementById('usertype').value;

        if(subcategory !== 'All'){

            $("#sec_table").dataTable().fnDestroy();

            $('#sec_table').DataTable({
                "processing": true,
                "ajax": {
                    url: 'get_prev_section',
                    type: 'GET',
                    data: {sub_cat_id: sub_cat_id, user_type: user_type},
                },
                "columns":
                    [
                        { "data": "sec_name" },
                        {
                            sortable: false,
                            "render": function(data, type, full, meta)
                            {
                                var id = "" + full.id;
                                var cat_id = "" + full.cat_id;
                                var sub_cat_id = "" + full.subcat_id;

                                if(full.permission){

                                    var permission = full.permission;

                                    if(permission == 1){

                                        return '<input checked="checked" value="'+id+'" id="sec_id" name="sec_id" type="checkbox">' +
                                            '<input value="'+cat_id+'" id="category" name="category" type="hidden">' +
                                            '<input value="'+sub_cat_id+'" id="sub_category" name="sub_category" type="hidden">';

                                    }else {

                                        return '<input value="'+id+'" id="sec_id" name="sec_id" type="checkbox">' +
                                            '<input value="'+cat_id+'" id="category" name="category" type="hidden">' +
                                            '<input value="'+sub_cat_id+'" id="sub_category" name="sub_category" type="hidden">';
                                    }

                                }else {

                                    return '<input value="'+id+'" id="sec_id" name="sec_id" type="checkbox">' +
                                        '<input value="'+cat_id+'" id="category" name="category" type="hidden">' +
                                        '<input value="'+sub_cat_id+'" id="sub_category" name="sub_category" type="hidden">';
                                }
                            },
                        },
                    ],
                "columnDefs": [{
                    className: "text-center",
                    "targets": [1]
                }],
                "order": [[ 0, "desc" ]],
                "paging": false,
                "searching": false,
            });

        }else{

            bootbox.alert({
                message: "Please select sub category",
                size: 'small',
            });
        }
    }

    function save_privilege() {

        var user_val = document.getElementById('usertype').value;
        var cat_val  = document.getElementById('category').value;
        var sub_val  = document.getElementById('subcategory').value;

        if(user_val === 'All' || cat_val === 'All' || sub_val === 'All'){

            bootbox.alert({
                message: "Please select required fields",
                size: 'small',
            });

        }else{

            var cat_id = document.getElementById('category').value;
            var sub_cat_id = document.getElementById('subcategory').value;
            var items = document.getElementById('sec_table');
            var user_type = document.getElementById('usertype').value;

            var selected_sec = [];
            var deselected_sec = [];
            var total_rows = items.tBodies[0].rows.length;

            for (var i = 1; total_rows >= i; i++) {

                var row = items.rows[i];

                if(row.cells[1].childNodes[0].checked === true) {

                    var select =  row.cells[1].childNodes[0].value;
                    selected_sec.push(select);
                }else{

                    var select =  row.cells[1].childNodes[0].value;
                    deselected_sec.push(select);
                }
            }

            if(deselected_sec.length !== 0){
                var deselected = deselected_sec;
            }else {
                var deselected = 'null';
            }
            if(selected_sec.length !== 0){
                var selected = selected_sec;
            }else {
                var selected = 'null';
            }

            $.ajax({
                dataType: "json",
                url: 'save_user_prev',
                type: 'GET',
                data: {selected: selected, cat_id: cat_id, sub_cat_id: sub_cat_id, deselected: deselected, user_type: user_type},
                success: function (response) {
                    bootbox.alert({
                        message: "User Privilege Added Successfully",
                        size: 'small',
                        callback: function () {
                            window.location.reload();
                        }
                    });
                }
            });
        }

    }
</script>

<script>
    function refresh(){
// window.location.reload()
        $('#subcategoryForm')[0].reset();
    }
</script>



@endsection