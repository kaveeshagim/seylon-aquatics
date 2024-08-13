@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-2xl px-4 2xl:px-0" id="invoice-details">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Invoice Details</h2>

        <div  class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Invoice Date</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->created_at}}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Order ID</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->order_id}}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Gross Total</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ number_format($invoiceMaster->gross_total, 2) }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Final Total (after discounts)</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ number_format($invoiceMaster->final_total, 2) }}</dd>
            </dl>
        </div>

        <h3 class="text-lg font-semibold text-gray-900 dark:text-white sm:text-xl mb-2">Itemized Details</h3>
        <div class="rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Fish Code</th>
                        <th scope="col" class="px-6 py-3">Common Name</th>
                        <th scope="col" class="px-6 py-3">Size</th>
                        <th scope="col" class="px-6 py-3">Quantity</th>
                        <!-- <th scope="col" class="px-6 py-3">Unit Price</th> -->
                        <th scope="col" class="px-6 py-3">Discount (%)</th>
                        <th scope="col" class="px-6 py-3">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoiceDetails as $detail)
                        <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{$detail->fish_code}}</td>
                            <td class="px-6 py-4">{{$detail->quantity}}</td>
                            <td class="px-6 py-4">{{ $detail->discount }}</td>
                            <td class="px-6 py-4">{{ number_format($detail->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="flex items-center space-x-4">
            <button id="download-pdf" class="no-underline text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Download PDF</button>
            <a href="{{ route('vieworderdetpage', ['id' => $invoiceMaster->order_id]) }}" class="no-underline py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">View all orders</a>
        </div>
    </div>
</section>

<!-- Add the script to handle PDF download -->

<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const element = document.getElementById('invoice-details');
        html2pdf()
            .from(element)
            .set({
                margin: 1,
                filename: 'invoice-details.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            })
            .save();
    });
</script>

@endsection
