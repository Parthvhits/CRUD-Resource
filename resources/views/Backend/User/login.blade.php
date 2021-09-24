<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .has-error-cstm{color: red;}
    </style>
</head>

<body>
    <div class="container">
        <form action="{{route('login')}}" method="post" id="user_login">
            @csrf
            {{ method_field('POST') }}
            <h1>Login</h1>
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" id="email-add" name="email" class="form-control">
                <span class="has-error-cstm"> {{$errors->first('email')}}</span>
            </div>

            <div class="form-group">
                <label for="psw"><b>Password</b></label>
                <input type="password" name="password" class="form-control">
                <span class="has-error-cstm"> {{$errors->first('password')}}</span>
            </div>

            <div class="clearfix">
                <button type="submit" class="btn btn-default signupbtn">Login</button>
            </div>
        </form>
        <a href="{{route('user.create')}}">Register Here</a>
    </div>
</body>
<footer>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! $validator->selector('#user_login') !!}
</footer>

</html>