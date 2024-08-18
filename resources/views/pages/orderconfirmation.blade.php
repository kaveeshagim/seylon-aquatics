@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-2xl px-4 2xl:px-0">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Order Confirmed! Thanks for your order!</h2>
      <!-- <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#" class="font-medium text-gray-900 dark:text-white hover:underline">#7564804</a> will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.</p> -->
      <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#" class="font-medium text-gray-900 dark:text-white hover:underline">{{$orderdetail->order_no}}</a> is confirmed. Click the 'view invoice' button to generate your invoice.</p>
      
      <div id="order-details" class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
      <div class="mb-6 text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="mx-auto">                
            </div>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">DateTime</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->created_at}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Customer Name</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->customer}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Order Number</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->order_no}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Order Status</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->status}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">No of items</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->tot_orders}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Shipping Address</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->shipping_address}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Executive In charge</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->executive}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Contact No</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->contact}}</dd>
          </dl>
      </div>
      
      <div class="flex items-center space-x-4">
          <button id="download-pdf" class="no-underline text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Download PDF</button>
          <a href="{{ route('vieworderdetpage', ['id' => $orderdetail->id]) }}" class="no-underline py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              View all orders
            </a>
        <button onclick="viewinvoicedetpage({{$orderdetail->id}})" class="no-underline text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">View Invoice</button>
          <!-- <a href="{{ route('viewinvoicedetpage', ['id' => $orderdetail->id]) }}" class="no-underline py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-red-700 dark:bg-red-800 dark:text-white dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">View Invoice</a> -->
      </div>
  </div>
</section>

<!-- Add the script to handle PDF download -->

    <script>

        document.getElementById('download-pdf').addEventListener('click', function () {
            const element = document.getElementById('order-details');
            html2pdf()
                .from(element)
                .set({
                    margin: 1,
                    filename: 'order-details.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                })
                .save();
        });
    </script>

    <script>

        function viewinvoicedetpage(id) {

            $.ajax({
                url: "{{ url('viewinvoicedetpage') }}" + "/" + id,
                type: 'GET',
                data: { id: id },
                success: function (response) {
                    if(response.status == "success") {

                        location.href = "{{ url('viewinvoicee') }}" + "/" + id;

                    }else if(response.status == "error"){
                        bootbox.alert({
                            message: response.message,
                            backdrop: true,
                            callback: function () {
                                
                            }
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


                
                
        </script>

@endsection
