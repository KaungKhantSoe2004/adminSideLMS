<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Thanks For register</h1>

<form action="{{route('mailSent')}}"  method="POST">
@csrf
<input type="text" placeholder="Enter Your name" name="name" />
<input type="email" placeholder=" Enter Your Email" name="email">
<input type="subject" placeholder="Enter Your Subject" name="subject"/>
<textarea name="desc" placeholder="Enter Your Description" id="" cols="30" rows="10"></textarea>
<button type="input">Submit</button>
</form>

</body>
</html>
