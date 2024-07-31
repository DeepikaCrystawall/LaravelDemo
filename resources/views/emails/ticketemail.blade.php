<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Created</title>
</head>
<body>
        <div style="background-color: white;border: 2px solid #0f0870;box-shadow: 20px -13px 1px 1px #0f0870;
        width: fit-content;padding: 1rem 1rem;font-family: system-ui;">
            <h4 style="text-align: center; font-size: large;"> New Ticket</h4>
            <h4 style="font-size: medium"> Name: {{ $ticket->title }}</h4>
            <p style="font-size: medium">Description : {{ $ticket->description }}</p>
            <p style="font-size: medium">Created By:{{ $ticket->user->name }}</p>
            <small>Created At: {{$ticket->created_at}}</small>
    </div>
</body>
</html>