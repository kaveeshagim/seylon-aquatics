@extends('layouts.app')

@section('content')
<div>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">

    <form id="userprivilegeForm">
    @csrf     
    <div class="p-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Add user privilege</h3>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
        
            <div class="w-full">
                <label for="usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
                <select onchange="load_cat_data()"  id="usertype" name="usertype" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">- Select usertype -</option>
                    @foreach($usertypelist as $value)
                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select onchange="load_sub_category()" id="category" name="category" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">- Select category -</option>
                    @foreach($categorylist as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full">
                <label for="subcategory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category</label>
                <select id="subcategory" name="subcategory" onchange="load_sections()" class="bg-gray-500 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">- Select subcategory -</option>
                </select>
            </div>
        </div>
        
        

        <div class="row" style="margin-top:30px">
            <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12" style="padding-left:0px;">
                <table id="sec_table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" width="100%" cellspacing="0">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th width="40%" class="text-center"><p>Section Name</p></th>
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
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-600">
        <button type="button" onclick="save_privilege()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        <button onclick="refresh()" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Cancel</button>
    </form>

</div>


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
            dataSrc: "data",
            url: '{{url('get_categories')}}',
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
            url: '{{url('get_sub_categories')}}',
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

        var cat_id = document.getElementById("category").value;
        var sub_cat_id = document.getElementById("subcategory").value;
        var user_type = document.getElementById('usertype').value;

        if(subcategory !== 'All'){

            $("#sec_table").dataTable().fnDestroy();

            $('#sec_table').DataTable({
                "processing": true,
                "ajax": {
                    url: '{{url('get_prev_section')}}',
                    type: 'GET',
                    data: {cat_id: cat_id, sub_cat_id: sub_cat_id, user_type: user_type},
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
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
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
            }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");

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
                dataSrc: "data",
                url: '{{url('save_user_prev')}}',
                type: 'GET',
                data: {selected: selected, cat_id: cat_id, sub_cat_id: sub_cat_id, deselected: deselected, user_type: user_type},
                success: function (response) {
                    bootbox.alert({
                        message: "User Privilege Added Successfully",
                        size: 'small',
                        callback: function () {
                            window.location.reload();
                        }
                    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");
                }
            });
        }

    }
</script>

<script>
    function refresh(){
// window.location.reload()
        $('#userprivilegeForm')[0].reset();
    }
</script>



@endsection