@extends('layouts.app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Seylon Aquatics Pvt Ltd</h2>
      <p class="mb-4 text-xl font-extrabold leading-none text-gray-900 md:text-2xl dark:text-white">Sri Lanka</p>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Parent Company</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->name}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Address</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->address}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Website</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->web_url}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Contact One</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->contact_no_one}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Contact Two</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->contact_no_two}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Email Person One</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->email_one}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Email Person Two</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->email_two}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Country</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->country}}</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Packing Charges</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->perbox_cost}} USD per box</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Handling Fee (Document & Airway Bills)</dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{$data->document_fee}} USD</dd>
      </dl>
      <dl>
          <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"></dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">All orders will be dispatched within 5 days on receipt.</dd>
      </dl>
      <!-- <div class="flex items-center space-x-4">
          <button type="button" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
              Edit
          </button>   
          <button type="button" class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
              <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
              Delete
          </button> 
      </div> -->
  </div>
</section>
@endsection