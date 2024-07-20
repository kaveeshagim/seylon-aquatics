<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Dashboard</title>
    @vite('resources/js/app.js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div>
        <h1>Realtime Dashboard</h1>
        <div id="pending-orders">Pending Orders: 0</div>
        <div id="completed-orders">Completed Orders: 0</div>
    </div>

 <script>
        // Ensure Echo is loaded and available
         $(document).ready(function() {
        if (typeof Echo !== 'undefined') {
            // Fetch initial counts using jQuery AJAX
            // $.ajax({
            //     url: '{{ url('orderscount')}}',
            //     method: 'GET',
            //     success: function(data) {
            //         $('#pending-orders').text('Pending Orders: ' + data.pending);
            //         $('#completed-orders').text('Completed Orders: ' + data.completed);
            //     }
            // });

            // Listen for real-time updates using Laravel Echo
            window.Echo.channel('testorders')
                .listen('OrderStatusChanged', function(e) {
                    $.ajax({
                        url: '{{ url('orderscount')}}',
                        method: 'GET',
                        success: function(data) {
                            $('#pending-orders').text('Pending Orders: ' + data.pending);
                            $('#completed-orders').text('Completed Orders: ' + data.completed);
                        }
                    });
                });
        } else {
            console.error('Echo is not defined');
        }
    });
    </script>
</body>
</html>
