<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Reset Password OTP</h1>
<p> You have registered a request for reset password<br></p>

<p> <strong>Here is your OTP:</strong>{{$resetdata['otp']}} <br>
    <strong>Here is your link:</strong>{{$resetdata['link']}} <br>
</p>
<P> Enter this OTP when asked</p>

    
</body>
</html>