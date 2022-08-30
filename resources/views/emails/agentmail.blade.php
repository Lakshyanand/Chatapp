<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Registration Successfull</h1>
<p> You have been successfully registered as an Agent<br>Your login credentials are given below. You can login using this password only once, after logging in for the first time you will get the option of resetting the password. Reset the password and set your own password for later on.</p>
<p> <strong>Here are your credentials:</strong><br>Email: {{$maildata['email']}} <br> Password: {{$maildata['password']}} </p>

    
</body>
</html>