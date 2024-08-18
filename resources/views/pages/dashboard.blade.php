@extends('layouts.app')

@section('content')
<div class="rounded-lg h-20 mb-1"></div>


<div class="flex items-center justify-between">
  <h4 class="text-2xl font-bold dark:text-white">Realtime Analytics Dashboard</h4>

  <span class="w-full md:w-auto flex flex-col md:flex-row md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
    <button id="download-pdf" class="no-underline text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Download PDF</button>
    <button id="print-page" class="no-underline text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Print</button>
  </span>
</div>



<hr class="w-full h-1 my-4 bg-gray-900 border-0 rounded md:my-10 dark:bg-gray-700">

<div id="analytics-dashboard">

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-4">

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="pendingorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">PENDING ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="confirmedorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">CONFIRMED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="shippedorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">SHIPPED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="cancelledorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">COMPLETED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="completedorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">CANCELLED ORDERS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="totalorders" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">TOTAL ORDERS</dd>
      </dl>
    </div>
  </a>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-4">

<a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="pendinginvoices" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">PENDING INVOICES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="completedinvoices" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">COMPLETED INVOICES</dd>
      </dl>
    </div>
  </a>


  <a href="" class="no-underline rounded-lg shadow">
    
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="pendingshipments" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">PENDING SHIPMENTS</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="intransitshipments" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">IN-TRANSIT SHIPMENTS</dd>
      </dl>
    </div>
  </a>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

<a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishvarietycount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH VARIETIES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishspeciescount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH SPECIES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishfamilycount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH FAMILIES</dd>
      </dl>
    </div>
  </a>

  <a href="" class="no-underline rounded-lg shadow">
    <div class="rounded-lg dark:border-gray-600 h-32 md:h-40">
      <dl class="bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center w-full h-full hover:bg-gray-100 dark:hover:bg-gray-700">
        <dt id="fishhabitatcount" class="mb-2 text-3xl font-extrabold text-gray-500 dark:text-gray-50">0</dt>
        <dd class="text-gray-500 dark:text-gray-400">FISH HABITATS</dd>
      </dl>
    </div>
  </a>


</div>


<div class="grid grid-cols-2 gap-4 mb-4">

 <!-- chart -->
  <div class="rounded-lg  h-50 md:h-72">

    <div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
      
      <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
              <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
              <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
            </svg>
          </div>
          <div>
            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">3.4k</h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Leads generated per week</p>
          </div>
        </div>
        <div>
          <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
            </svg>
            42.5%
          </span>
        </div>
      </div>

      <div class="grid grid-cols-2">
        <dl class="flex items-center">
            <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Money spent:</dt>
            <dd class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
        </dl>
        <dl class="flex items-center justify-end">
            <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Conversion rate:</dt>
            <dd class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
        </dl>
      </div>

      <div id="column-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
          <div class="flex justify-between items-center pt-5">
            <!-- Button -->
            <button
              id="dropdownDefaultButton"
              data-dropdown-toggle="lastDaysdropdown"
              data-dropdown-placement="bottom"
              class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
              type="button">
              Last 7 days
              <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="lastDaysdropdown" class="z-10 hidden bg-gray-50 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                  </li>
                </ul>
            </div>
            <a
              href="#"
              class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
              Leads Report
              <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
            </a>
          </div>
        </div>
    </div>
  
  </div>
  <!-- chart -->


  <!-- chart -->
  <div class="rounded-lg h-50 md:h-72">
      
  
<div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between mb-5">
    <div class="grid gap-4 grid-cols-2">
      <div>
        <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">Clicks
          <svg data-popover-target="clicks-info" data-popover-placement="bottom" class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <div data-popover id="clicks-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-50 border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
                  <h3 class="font-semibold text-gray-900 dark:text-white">Clicks growth - Incremental</h3>
                  <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                  <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                  <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                  <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg></a>
              </div>
              <div data-popper-arrow></div>
          </div>
        </h5>
        <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">42,3k</p>
      </div>
      <div>
        <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">CPC
        <svg data-popover-target="cpc-info" data-popover-placement="bottom" class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <div data-popover id="cpc-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-50 border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
                  <h3 class="font-semibold text-gray-900 dark:text-white">CPC growth - Incremental</h3>
                  <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                  <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                  <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                  <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg></a>
              </div>
              <div data-popper-arrow></div>
          </div>
        </h5>
        <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">$5.40</p>
      </div>
    </div>
    <div>
      <button id="dropdownDefaultButton"
        data-dropdown-toggle="lastDaysdropdown"
        data-dropdown-placement="bottom" type="button" class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Last week <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg></button>
    <div id="lastDaysdropdown" class="z-10 hidden bg-gray-50 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
            </li>
          </ul>
      </div>
    </div>
  </div>
  <div id="line-chart"></div>
  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
    <div class="pt-5">      
      <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
          <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z"/>
          <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
        </svg>
        View full report
      </a>
    </div>
  </div>
</div>

      
  </div>
  <!-- chart -->

    <!-- chart -->
    <div class="rounded-lg h-50 md:h-72">

    
<div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

  <div class="flex justify-between items-start w-full">
      <div class="flex-col items-center">
        <div class="flex items-center mb-1">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Fish Distribution for This Week</h5>
            <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
            </svg>
            <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-50 border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <div class="p-3 space-y-2">
                    <!-- <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3> -->
                    <!-- <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p> -->
                    <!-- <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3> -->
                    <!-- <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p> -->
                    <!-- <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"> -->
                <!-- <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/> -->
              <!-- </svg></a> -->
            </div>
            <div data-popper-arrow></div>
        </div>
      </div>


    </div>
    <div class="flex justify-end items-center">


  </div>
  </div>

  <!-- Line Chart -->
  <div class="py-6" id="pie-chart-2"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
    <div class="flex justify-between items-center pt-5">

    </div>
  </div>
</div>


    </div>
    <!-- chart -->

    <!-- chart -->
    <div class="rounded-lg h-50 md:h-72">

    
<div class="w-full bg-gray-50 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

  <div class="flex justify-between items-start w-full">
      <div class="flex-col items-center">
        <div class="flex items-center mb-1">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Order Status Distribution for This Week</h5>
            <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
            </svg>
            <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-50 border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <div class="p-3 space-y-2">
                    <!-- <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3> -->
                    <!-- <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p> -->
                    <!-- <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3> -->
                    <!-- <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p> -->
                    <!-- <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"> -->
                <!-- <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/> -->
              <!-- </svg></a> -->
            </div>
            <div data-popper-arrow></div>
        </div>
      </div>


    </div>
    <div class="flex justify-end items-center">


  </div>
  </div>

  <!-- Line Chart -->
  <div class="py-6" id="pie-chart"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
    <div class="flex justify-between items-center pt-5">

    </div>
  </div>
</div>


    </div>
    <!-- chart -->
        
</div>



<script>
     document.addEventListener("DOMContentLoaded", function(event) {

      
const fetchDataAndRenderChart = () => {
  $.ajax({
    url: '{{ url('getOrderStats')}}',
    method: 'GET',
    success: function(data) {
      const chartOptions = getChartOptions2(data);
      const chart = new ApexCharts(document.getElementById("pie-chart"), chartOptions);
      chart.render();
    },
    error: function(error) {
      console.error('Error fetching order stats:', error);
    }
  });
}

const fetchTopFishDataAndRenderChart = () => {
  $.ajax({
    url: '{{ url('getTopFishVarieties') }}',
    method: 'GET',
    success: function(data) {
      const chartOptions = getTopFishChartOptions(data);
      const chart = new ApexCharts(document.getElementById("pie-chart-2"), chartOptions);
      chart.render();
    },
    error: function(error) {
      console.error('Error fetching top fish varieties:', error);
    }
  });
};



      fetchDataAndRenderChart();
      fetchTopFishDataAndRenderChart();
 

      $.ajax({
          url: '{{url('update-status')}}',
          type: 'get',
          processData: false,
          contentType: false,
          success: function(response) {

          },
          error: function(jqXHR, textStatus, errorThrown) {

          }
      });


      const socket = io('http://localhost:6050', {transports: ['websocket']});
      
      
      socket.on('connect', () => {
        console.log('WebSocket connected');
      });



    socket.on('updateOrders', (data) => {
      console.log('Received orders data:', data);
        document.getElementById('pendingorders').textContent = data.pendingorders;
        document.getElementById('confirmedorders').textContent = data.confirmedorders;
        document.getElementById('shippedorders').textContent = data.shippedorders;
        document.getElementById('cancelledorders').textContent = data.cancelledorders;
        document.getElementById('completedorders').textContent = data.completedorders;
        document.getElementById('totalorders').textContent = data.totalorders;

        document.getElementById('pendinginvoices').textContent = data.pendinginvoices;
        document.getElementById('completedinvoices').textContent = data.completedinvoices;

        document.getElementById('pendingshipments').textContent = data.pendingshipments;
        document.getElementById('intransitshipments').textContent = data.intransitshipments;

        document.getElementById('fishvarietycount').textContent = data.fishvarietycount;
        document.getElementById('fishspeciescount').textContent = data.fishspeciescount;
        document.getElementById('fishfamilycount').textContent = data.fishfamilycount;
        document.getElementById('fishhabitatcount').textContent = data.fishhabitatcount;
    });

    socket.on('disconnect', () => {
        console.log('WebSocket disconnected');
    });
    
const options = {
  colors: ["#1A56DB", "#FDBA8C"],
  series: [
    {
      name: "Organic",
      color: "#1A56DB",
      data: [
        { x: "Mon", y: 231 },
        { x: "Tue", y: 122 },
        { x: "Wed", y: 63 },
        { x: "Thu", y: 421 },
        { x: "Fri", y: 122 },
        { x: "Sat", y: 323 },
        { x: "Sun", y: 111 },
      ],
    },
    {
      name: "Social media",
      color: "#FDBA8C",
      data: [
        { x: "Mon", y: 232 },
        { x: "Tue", y: 113 },
        { x: "Wed", y: 341 },
        { x: "Thu", y: 224 },
        { x: "Fri", y: 522 },
        { x: "Sat", y: 411 },
        { x: "Sun", y: 243 },
      ],
    },
  ],
  chart: {
    type: "bar",
    height: "320px",
    fontFamily: "Inter, sans-serif",
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "70%",
      borderRadiusApplication: "end",
      borderRadius: 8,
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: {
      fontFamily: "Inter, sans-serif",
    },
  },
  states: {
    hover: {
      filter: {
        type: "darken",
        value: 1,
      },
    },
  },
  stroke: {
    show: true,
    width: 0,
    colors: ["transparent"],
  },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -14
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    floating: false,
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
  fill: {
    opacity: 1,
  },
}

if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("column-chart"), options);
  chart.render();
}

const options2 = {
  chart: {
    height: "100%",
    maxWidth: "100%",
    type: "line",
    fontFamily: "Inter, sans-serif",
    dropShadow: {
      enabled: false,
    },
    toolbar: {
      show: false,
    },
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 6,
  },
  grid: {
    show: true,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -26
    },
  },
  series: [
    {
      name: "Clicks",
      data: [6500, 6418, 6456, 6526, 6356, 6456],
      color: "#1A56DB",
    },
    {
      name: "CPC",
      data: [6456, 6356, 6526, 6332, 6418, 6500],
      color: "#7E3AF2",
    },
  ],
  legend: {
    show: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
}

if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
  const chart2 = new ApexCharts(document.getElementById("line-chart"), options2);
  chart2.render();
}




const getChartOptions = () => {
  return {
    series: [35.1, 23.5, 2.4, 5.4],
    colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"],
    chart: {
      height: 320,
      width: "100%",
      type: "donut",
    },
    stroke: {
      colors: ["transparent"],
      lineCap: "",
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            name: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: 20,
            },
            total: {
              showAlways: true,
              show: true,
              label: "Unique visitors",
              fontFamily: "Inter, sans-serif",
              formatter: function (w) {
                const sum = w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
                return '$' + sum + 'k'
              },
            },
            value: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: -20,
              formatter: function (value) {
                return value + "k"
              },
            },
          },
          size: "80%",
        },
      },
    },
    grid: {
      padding: {
        top: -2,
      },
    },
    labels: ["Direct", "Sponsor", "Affiliate", "Email marketing"],
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return value + "k"
        },
      },
    },
    xaxis: {
      labels: {
        formatter: function (value) {
          return value  + "k"
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
  }
}


const getTopFishChartOptions = (data) => {
  return {
    series: data.map(item => item.total_quantity),
    colors: ["#1C64F2", "#16BDCA", "#9061F9", "#F4A300", "#E94E77"], // Adjust colors as needed
    chart: {
      height: 420,
      width: "100%",
      type: "pie",
    },
    stroke: {
      colors: ["white"],
    },
    plotOptions: {
      pie: {
        labels: {
          show: true,
        },
        size: "100%",
        dataLabels: {
          offset: -25
        }
      },
    },
    labels: data.map(item => item.common_name), // Use common names from the data
    dataLabels: {
      enabled: true,
      style: {
        fontFamily: "Inter, sans-serif",
      },
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
  };
};

if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
  chart.render();

  // Get all the checkboxes by their class name
  const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');

  // Function to handle the checkbox change event
  function handleCheckboxChange(event, chart) {
      const checkbox = event.target;
      if (checkbox.checked) {
          switch(checkbox.value) {
            case 'desktop':
              chart.updateSeries([15.1, 22.5, 4.4, 8.4]);
              break;
            case 'tablet':
              chart.updateSeries([25.1, 26.5, 1.4, 3.4]);
              break;
            case 'mobile':
              chart.updateSeries([45.1, 27.5, 8.4, 2.4]);
              break;
            default:
              chart.updateSeries([55.1, 28.5, 1.4, 5.4]);
          }

      } else {
          chart.updateSeries([35.1, 23.5, 2.4, 5.4]);
      }
  }

  // Attach the event listener to each checkbox
  checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', (event) => handleCheckboxChange(event, chart));
  });
}



const getChartOptions2 = (data) => {
  return {
    series: [data.pending, data.confirmed, data.cancelled, data.completed],
    colors: ["#FF4560", "#00E396", "#FEB019", "#775DD0"], // Adjust colors as needed
    chart: {
      height: 420,
      width: "100%",
      type: "pie",
    },
    stroke: {
      colors: ["white"],
    },
    plotOptions: {
      pie: {
        labels: {
          show: true,
        },
        size: "100%",
        dataLabels: {
          offset: -25
        }
      },
    },
    labels: ["Pending", "Confirmed", "Cancelled", "Completed"], // Adjust labels as needed
    dataLabels: {
      enabled: true,
      style: {
        fontFamily: "Inter, sans-serif",
      },
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
  };
}



 });
</script>

<script>
document.getElementById('download-pdf').addEventListener('click', function () {
    const element = document.body; // Capture the entire body of the document
    html2pdf()
        .from(element)
        .set({
            margin: 0, // No margins for a full-page capture
            filename: 'analytics-dashboard.pdf',
            image: { type: 'jpeg', quality: 1 }, // Highest quality image
            html2canvas: { 
                scale: 2, // Higher scale for better quality
                logging: true, // Log details for debugging
                useCORS: true, // Handle cross-origin issues if any assets are loaded from external sources
                windowWidth: document.documentElement.scrollWidth, // Ensure the full width is captured
                windowHeight: document.documentElement.scrollHeight // Ensure the full height is captured
            },
            jsPDF: { 
                unit: 'px', // Using pixels for more control over size
                format: [document.documentElement.scrollWidth, document.documentElement.scrollHeight], // Match the PDF size to the content size
                orientation: 'portrait' // Portrait orientation
            }
        })
        .save();
});


    document.getElementById('print-page').addEventListener('click', function () {
        window.print();
    });
</script>

@endsection