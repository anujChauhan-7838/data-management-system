
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    @if($isAddedUser == 1)
    <h1>Welcome to Admin Panel Family.</h1>
    @else
    <h1>Hi {{$data['first_name'].' '.$data['last_name']}},</h1>
    <h1>Your details has been modified. Please have a look below</h1>
    @endif
    <p><strong>Please find the details below:</strong>
    <p><strong>Name</strong>:{{$data['first_name'].' '.$data['last_name']}}</p>
    <p><strong>Email</strong>:{{$data['email']}}</p>
    @if($data['password'])
    <p><strong>Password</strong>:{{$data['password']}}</p>
    @endif
    <p><strong>User Role</strong>:{{$data['userRole'] == 2?'Admin':'Sales Admin'}}</p>
    <p>Thank you</p>
    <p>Team Admin Panel</p>
</body>
</html>