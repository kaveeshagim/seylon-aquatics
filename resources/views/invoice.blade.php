@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mx-auto max-w-5xl">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Invoice summary</h2>

      <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">

        <div class="mt-6 grow sm:mt-8 lg:mt-0">
          <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
            <div class="space-y-2">
            <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Invoice no</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">#I4532238</dd>
              </dl>
                <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Order no</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">#7564804</dd>
              </dl>
                <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Customer name</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">Mr. Adam James</dd>
              </dl>
                <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Shipment due</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">30/06/2024</dd>
              </dl>
              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">$6,592.00</dd>
              </dl>

              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Discount</dt>
                <dd class="text-base font-medium text-green-500">-$299.00</dd>
              </dl>
            </div>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
              <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
              <dd class="text-base font-bold text-gray-900 dark:text-white">$7,293.00</dd>
            </dl>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
@endsection