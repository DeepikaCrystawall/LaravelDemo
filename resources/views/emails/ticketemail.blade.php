<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Created</title>
</head>
<body>
   <p>Hey!... A New Ticket Created ..Please Check Details...</p>
     <p>Name::{{ $mailData['title'] }}</p>
    <p>Description::{{ $mailData['description'] }}</p>
  
    <p>Created At::{{$mailData['created_at']}}</p>
     
    <p>Thank you</p>

</body>
</html>