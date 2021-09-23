<!DOCTYPE html>
<html>
    <head>
        <title>Add User</title>
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
<form action="{{route('user.update',$allContent->id)}}" method="post" id="user_edit">
    @csrf
    {{ method_field('PUT') }}
    <h1>Update User</h1>
    <div class="form-group">
    <label for="uname"><b>User Name</b></label>
    <input type="text" name="user_name" id="uname" class="form-control" value="{{$allContent->user_name}}">
    <span class="has-error-cstm"> {{$errors->first('user_name')}}</span>
    </div>
    
    <div class="form-group">
    <label for="email"><b>Email</b></label>
    <input type="email" id="email-add" name="email" class="form-control" value="{{$allContent->email}}">
    <span class="has-error-cstm"> {{$errors->first('email')}}</span>
    </div>  

    <div class="form-group">
    <label for="contactno"><b>Contact No</b></label>
    <input type="text" name="phone" id="contactno" class="form-control" value="{{$allContent->phone}}">
    <span class="has-error-cstm"> {{$errors->first('phone')}}</span>
    </div>

    <div class="form-group">
    <strong>Gender</strong>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="gender" id="male" value="male" @if ($allContent->gender=='male'){{ "checked=checked" }}  @endif>
      <label class="form-check-label" for="gender">
      Male
      </label>
      <input class="form-check-input" type="radio" name="gender" id="female" value="female" @if ($allContent->gender=='female') {{ "checked=checked" }}  @endif>
      <label class="form-check-label" for="gender">
      Female
      </label>
    </div>
    </div> 

    <div class="clearfix">
      <button type="submit" class="btn btn-default signupbtn">Update</button>
    </div>
</form>
</div>
</body>
<footer>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! $validator->selector('#user_edit') !!}
</footer>
</html>