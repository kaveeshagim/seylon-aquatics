@extends('layouts.app')

@section('content')

<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      <li class="inline-flex items-center">
        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
          <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
          </svg>
          <span style="padding-left: 5px;">Home</span>
        </a>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Admin</a>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Users</span>
        </div>
      </li>
    </ol>
  </nav>

<div class="px-4">
  
<h4 class="text-2xl font-bold dark:text-white">Users</h4>

<hr>

<div class="mb-4">
<a href="{{ route('adduserpage') }}">
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add new user</button>
</a>

<button onclick="searchdata()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2">Search</button>
</div>

<table class="table table-bordered dataTable display" id="users-table" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>User Type</th>
                <th>Active status</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
</table>



<div class="modal fade bd-example-modal-lg" id="UserDetailModel" tabindex="-1" role="dialog"
         aria-labelledby="UserDetailModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserDetailModelLabel">User Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="status_model">
                    <table style='font-size:14px' align="center" width='90%'>
                        <tr class='row'>
                            <td class='col-md-3' style="padding: 5px;" align="left"><label class='control-label labels'><strong>Login
                                        Time: </strong></label></td>
                            <td class='col-md-4' style="padding: 5px;"><span id="loginid"></span></td>
                            <td class='col-md-3' style="padding: 5px;" align='left'><label class='control-label labels'><strong>Total
                                        Idle: </strong></label></td>
                            <td class='col-md-3' style="padding: 5px;"><span id="idleid"></span></td>
                        </tr>
                        <tr class='row'>
                            <td class='col-md-3' style="padding: 5px;" align='left'><strong>Number of Outbound Calls: </strong>
                            </td>
                            <td class='col-md-3' style="padding: 5px;"><span id="outcalls"></span></td>
                            <td class='col-md-3' style="padding: 5px;" align='left'><label class='control-label labels'><strong>Total
                                        Break Time: </strong></label></td>
                            <td class='col-md-3' style="padding: 5px;"><span id="totalbreakid"></span></td>
                        </tr>
                        <tr class='row'>
                            <td class='col-md-3' style="padding: 5px;" align='left'><strong>Outbound Answered: </strong>
                            </td>
                            <td class='col-md-3' style="padding: 5px;"><span id="outanscalls"></span></td>
                            <td class='col-md-3' style="padding: 5px;" align='left'><label class='control-label labels'><strong>Total
                                        Busy: </strong></label></td>
                            <td class='col-md-3' style="padding: 5px;"><span id="busyid"></span></td>
                        </tr>
                        <tr class="row">
                            <td class='col-md-3' style="padding: 5px;" align='left'><label class='control-label labels'><strong>Number
                                        of Inbound Calls: </strong></label></td>
                            <td class='col-md-3' style="padding: 5px;"><span id="nocallsid"></span></td>
                        </tr>
                        <tr class='row'>
                            <td class='col-md-3' style="padding: 5px;" align='left'><label class='control-label labels'><strong>Inbound AHT: </strong></label></td>
                            <td class='col-md-3' style="padding: 5px;"><span id="ahtcallsid"></span></td>
                        </tr>
                    </table>
                    <br>
                    <table id="AgentBreaklist" align="center" width='70%'>

                        <thead class="table_head">
                        <tr>
                            <th style="padding: 7px;" class="text-center">Break</th>
                            <th style="padding: 7px;" class="text-center">Number of Breaks</th>
                            <th style="padding: 7px;" class="text-center">Time</th>
                        </tr>
                        </thead>
                        <tbody id="userData">
                        </tbody>

                    </table>
                </div>
                <div class="modal-footer" id="UserDetailModelfooter">

                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

                </div>
            </div>
        </div>
    </div>





</div>


<script>
    $(document).ready(function() {
        searchdata();
    });
</script>

<script>

function searchdata() {
  $('#users-table').DataTable().destroy();

  $.ajax({
    url: "getusers",
    type: "GET",
    dataSrc: "data",
    success: function(data) {
      console.log("Data:", data);

      // Initialize the DataTable with the retrieved data
      $('#users-table').DataTable({
        "processing": true,
        "deferRender": true,
        "data": data,
        "columns": [
          { "data": "username" },
          { "data": "usertype" },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              console.log(full.token);
                if(full.token != '' || full.token != null) {
                  return '<td><div class="flex items-center"><div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online</div></td>';
                }else{
                  return '<td><div class="flex items-center"><div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Offline</div></td>';
                }
              }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><a style="color: #000000" href="" onclick="userDetailModel(\'' + full.id + '\')"><span class="fas fa-eye"></span></a></td>';
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><button style="color: #000000" onclick="editusers(\'' + full.id + '\')"><span class="fas fa-pencil-alt"></span></button></td>';
            }
          },
          {
            sortable: false,
            "render": function(data, type, full, meta) {
              return '<td><a style="color: #000000" href="" onclick="deleteusers(\'' + full.id + '\')"><span class="fas fa-trash-alt"></span></a></td>';
            }
          }
        ],
        "columnDefs": [
          { className: "text-center", "targets": [0, 1, 2, 3, 4, 5] }
        ],
        "pageLength": 25,
        "order": [[0, "desc"]],
        "searching": true
      });
    },
    "error": function(xhr, status, error) {
      console.error("Error:", error);
    }
  });
}

function editusers(id) {
  location.href = "{{url('edituserpage')}}" + "/" + id;
}

function deleteusers(id) {
    $.ajax({
        url: 'deleteuser',
        type: 'GET',
        data: {id: id},
        success: function (response) {
            if(response == "deleted") {
               alert("user successfully deleted!"); 
               location.reload();
            }
        }
    });
}

function userDetailModel(id) {
        // body...

        // $.ajax({
        //     type: "GET",
        //     url: '{{url('userdetails')}}',
        //     data: {id:id},
        //     success: function (response) {

        //         var bodyData = '';

        //         $("#userData").empty();

        //         console.log(response);
        //         $.each(response, function (index, c) {

        //             $('#loginid').html(c.cre_datetime);
        //             $('#totalonlineid').html(c.ReadyTime);
        //             $('#busyid').html(response.TalkTime);
        //             $('#idleid').html(response.idleTime);
        //             $('#nocallsid').html(response.CallCount);
        //             $('#ahtcallsid').html(response.AHT);
        //             $('#ans_id').html(response.AnsCount);
        //             $('#totalbreakid').html(response.BreakTime);
        //             $('#outcalls').html(response.OutCount);
        //             $('#outanscalls').html(response.OutAnsCallCount);
        //         });

        //         $.each(response.data, function (index, row) {

        //             bodyData += "<tr>"
        //             bodyData += "<td style='padding: 6px'>" + row.description + "</td><td style='padding: 6px'>" + row.breakCount + "</td><td style='padding: 6px'>" + row.time + "</td>";
        //             bodyData += "</tr>";

        //         });

        //         $("#userData").append(bodyData).css({"text-align": "center"});

        //     }

        // });

        $('#StatusModel').modal('show');
    }
</script>
@endsection