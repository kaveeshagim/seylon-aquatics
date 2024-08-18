@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16" >
    <div class="mx-auto max-w-4xl px-4 2xl:px-0">
        <div id="invoice-details">
            <div class="mb-6 text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="mx-auto">                
            </div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Invoice Details</h2>

            <div  class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-0 sm:mb-0 text-gray-500 dark:text-gray-400">Customer Name</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->customer_name}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Invoice No</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->invoice_no}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Invoice Date</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->created_at}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Invoice Status</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->invoice_status}}</dd>
                </dl>
                <hr class="h-2 my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">No of orders</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->tot_orders}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">No fish pieces</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->tot_fish}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">No of boxes</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->tot_boxes}}</dd>
                </dl>
                <hr class="h-2 my-8 bg-gray-200 border-0 dark:bg-gray-700">

                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Order Number</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->order_no}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Order Status</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->status}}</dd>
                </dl>
                <hr class="h-2 my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Shiiping Address</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->shipping_address}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Shipment Date</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{$invoiceMaster->shipment_date}}</dd>
                </dl>
                <hr class="h-2 my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Sub Total</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">${{ number_format($invoiceMaster->gross_total, 2) }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Document Handling Fee & Airway Bill</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">+ ${{$invoiceMaster->handling_fee}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Packing Charges</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">+ ${{$invoiceMaster->packaging_fee}}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Discounts Applied</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">- ${{ number_format($invoiceMaster->discount_total, 2) }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Net Total</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">${{ number_format($invoiceMaster->final_total, 2) }}</dd>
                </dl>
                <hr class="h-2 my-8 bg-gray-200 border-0 dark:bg-gray-700">

                <dl class="sm:flex items-center justify-between gap-4 mt-5">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Payment Status</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $invoiceMaster->payment_status }}</dd>
                </dl>

                <p class="mb-4 text-xs font-medium text-gray-600 dark:text-gray-400">
                    <span class="font-semibold text-gray-900 dark:text-gray-300">Note:</span> 
                    Your invoice will be confirmed by the executive in charge after the payment is completed.
                </p>
            </div>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white sm:text-xl mb-2">Itemized Details</h3>
            <div class="rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Fish Code</th>
                            <th scope="col" class="px-6 py-3">Common Name</th>
                            <th scope="col" class="px-6 py-3">Size in cm</th>
                            <th scope="col" class="px-6 py-3">Size</th>
                            <th scope="col" class="px-6 py-3">Quantity</th>
                            <th scope="col" class="px-6 py-3">Unit Price</th>
                            <th scope="col" class="px-6 py-3">Discount (%)</th>
                            <th scope="col" class="px-6 py-3">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoiceDetails as $detail)
                            <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$detail->fish_code}}</td>
                                <td class="px-6 py-4">{{$detail->common_name}}</td>
                                <td class="px-6 py-4">{{$detail->size_cm}}</td>
                                <td class="px-6 py-4">{{$detail->size}}</td>
                                <td class="px-6 py-4">{{$detail->qty}}</td>
                                <td class="px-6 py-4">{{$detail->unit_price}}</td>
                                <td class="px-6 py-4">{{ $detail->discount }}</td>
                                <td class="px-6 py-4">{{ $detail->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
        
        <div class="flex items-center space-x-4">
            <button id="download-pdf" class="no-underline text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Download PDF</button>
            <button id="print-page" class="no-underline text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Print</button>
            <a href="{{ route('orderhistory') }}" class="no-underline py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">View all orders</a>
            <button id="edittoggle" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Update Status</button>
        </div>
    </div>
</section>


<!-- Edit fish size modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-50 rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Update Invoice
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" id="edit-form">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input hidden="true" id="invoiceid" name="invoiceid" value="{{$invoiceMaster->id}}"/>
                    <input hidden="true" id="orderid" name="orderid" value="{{$invoiceMaster->order_id}}"/>
                    <input hidden="true" id="orderno" name="orderno" value="{{$invoiceMaster->order_no}}"/>
                    <div>
                        <div class="mb-5">
                            <label for="paymentstatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Status</label>
                            <div class="flex items-center">
                            <input id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $invoiceMaster->payment_status == 'completed' ? 'checked' : '' }}>
                            <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Completed</label>
                            </div>
                        </div>



                        <!-- <div>
                            <label for="shipmentdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipment Date</label>
                            <input type="date" id="shipmentdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div> -->
                    </div>
                    <button type="button" onclick="updateinvoice()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- Add the script to handle PDF download -->

<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const element = document.getElementById('invoice-details');
        html2pdf()
            .from(element)
            .set({
                margin: 0.2,
                filename: 'invoice-details.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            })
            .save();
    });

    document.getElementById('print-page').addEventListener('click', function () {
        window.print();
    });
</script>

<script>

    function updateinvoice() {

        var priv = 'Update Data_19';
        var invoiceid = $('#invoiceid').val();
        var orderid = $('#orderid').val();
        var orderno = $('#orderno').val();
        let paymentStatus = document.getElementById('checked-checkbox').checked ? 'completed' : 'pending';

        $.ajax({
            url: "{{url('privcheck')}}",
            type: 'GET',
            data: { priv: priv },
            success: function (response) {
                if(response.status == "success") {
                   
                    $.ajax({
                        url: "{{url('updateinvoice')}}",
                        type: 'GET',
                        data: { invoiceid: invoiceid,  paymentstatus: paymentStatus, orderid: orderid, orderno, orderno},
                        success: function (response) {
                            if(response.status == "success") {
                            
                                bootbox.alert({
                                    message: response.message,
                                    backdrop: true,
                                    callback: function () {
                                        window.location.reload();
                                    }
                                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");

                            }else if(response.status == "error"){
                                bootbox.alert({
                                    message: response.message,
                                    backdrop: true,
                                    callback: function () {
                                    }
                                }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                            }
                        }
                    });

                }else if(response.status == "error"){
                    bootbox.alert({
                        message: response.message,
                        backdrop: true,
                        callback: function () {
                            window.location.reload();
                        }
                    }).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800");
                }
            }
        });

    }
    </script>


@endsection
