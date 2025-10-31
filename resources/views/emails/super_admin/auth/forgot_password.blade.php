<!DOCTYPE html>
<html>

<head>
    <title>Forget Password</title>
</head>

<body>
    <h3>Your Forget Password Secret :</h3>
    <code><b>{{ $details['token'] }}</b></code>
    <div>
        <a target="_blank" href="{{ $details['redirect_url'] }}">Click Here</a>
    </div>
</body>

</html>
