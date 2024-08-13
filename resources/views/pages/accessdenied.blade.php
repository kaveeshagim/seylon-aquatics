@extends('layouts.app')

@section('content')
<div>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto lg:py-16">

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-red-600 dark:text-red-500">403</h1>
            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Access Denied.</p>
            <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, you don't have permission to access this page.</p>
            <a href="javascript:history.back()" class="inline-flex text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-red-900 my-4 no-underline">Back</a>
        </div>   
    </div>




  </div>
</section>

@endsection