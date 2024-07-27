<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email Notification</title>
</head>
<body>
   <p>Hey!... A New Enquiry ..Please Check Client Details...</p>
     <p>Name::{{ $mailData['name'] }}</p>
    <p>Email::{{ $mailData['email'] }}</p>
  
    <p>Message::{{$mailData['message']}}</p>
     
    <p>Thank you</p>

</body>
</html>