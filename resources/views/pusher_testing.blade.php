<!DOCTYPE html>
<html>
<head>
    <title>Pusher Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('ce22c7cd664d93e27230', {
            cluster: 'mt1',
            forceTLS: true
        });

        var channel = pusher.subscribe('noti');
        channel.bind('testing', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
</head>
<body>
<h1>Pusher Test</h1>
<p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
</p>
</body>

</html>