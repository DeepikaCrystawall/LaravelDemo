<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Created</title>
</head>
<body>
   <p>Hey!... A New Ticket Created ..Please Check Details...</p>
     <p>Name::{{ $ticket['title'] }}</p>
    <p>Description::{{ $ticket['description'] }}</p>
  
    <p>Created At::{{$ticket['created_at']}}</p>
     
    <p>Thank you</p>

</body>
</html>