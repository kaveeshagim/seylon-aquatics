@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Notifications</h2>

    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
      <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
        <div class="space-y-6">

        @foreach($notifications as $notification)
            <div id="notification-{{ $notification->id }}" class="notification-box flex items-center justify-between p-4 mb-4 border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
              <div class="flex-1">
                <!-- Notification message -->
                <p class="text-gray-900 dark:text-white text-sm">{{ $notification->notification }}</p>
              </div>
              <div class="flex items-center space-x-4">
                <!-- Datetime -->
                <span class="text-gray-500 dark:text-gray-400 text-xs">{{ $notification->created_at }}</span>
                
                <!-- Remove button -->
                <button type="button" class="text-red-600 dark:text-red-500 text-xs font-medium hover:underline"
                        onclick="removenotif({{ $notification->id }}, this)">
                  <svg class="w-4 h-4 inline-block mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                  </svg>
                  Remove
                </button>
              </div>
            </div>
          @endforeach



        </div>

      </div>

    </div>
  </div>
</section>


<script>
    function removenotif(id, button) {
        $.ajax({
            url: '{{ url('removenotif') }}',
            type: 'get',
            data: {
                id: id            },
            success: function (response) {
                if (response.status === 'success') {
                    // Find the parent notification box and fade it out
                    $(button).closest('.notification-box').fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    console.error('Failed to remove notification:', response.message);
                }
            },
            error: function (xhr) {
                console.error('Error removing notification:', xhr.responseText);
            }
        });
    }
</script>

  </script>
@endsection