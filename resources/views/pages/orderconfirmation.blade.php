@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-2xl px-4 2xl:px-0">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Order Confirmed! Thanks for your order!</h2>
      <!-- <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#" class="font-medium text-gray-900 dark:text-white hover:underline">#7564804</a> will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.</p> -->
      <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#" class="font-medium text-gray-900 dark:text-white hover:underline">{{$orderdetail->order_no}}</a> will be processed within 24 hours during working days. We will notify you by email once your invoice has been finalized.</p>
      
      <div id="order-details" class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">DateTime</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->created_at}}</dd>
          </dl>
          <dl class="sm:flex items-center justify-between gap-4">
              <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Customer Name</dt>
              <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$orderdetail->customer}}</dd>
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
          <a href="{{ route('viewinvoicedetpage', ['id' => $orderdetail->id]) }}" class="no-underline py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-red-700 dark:bg-red-800 dark:text-white dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">View Invoice</a>
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

@endsection
