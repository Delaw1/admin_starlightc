<html>
<head>
    <title>Starlightpremiumcontent.com</title>
</head>

<body>
    <h2>Hello {{ $details['last_name'] }} {{ $details['first_name'] }},</h2> 
    <p>Welcome to {{ env('APP_NAME') }} @if($details['role'] == 'writer') as a writer. Your request will be verified and you will receive an email from the admin once you are approved. @endif</p>
</body>
</html>