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
          .has-error-cstm,.already-exist{color: red;}
        </style>
    </head>
<body>
<div class="container">
<form action="{{route('user.store')}}" method="post" id="user_add">
    @csrf
    {{ method_field('POST') }}
    <h1>Add User</h1>
    <div class="form-group">
    <label for="uname"><b>User Name</b></label>
    <input type="text" name="user_name" id="uname" class="form-control">
    <span class="has-error-cstm"> {{$errors->first('user_name')}}</span>
    </div>
    
    <div class="form-group">
    <label for="email"><b>Email</b></label>
    <input type="email" id="email-add" name="email" class="form-control">
    <span class="has-error-cstm"> {{$errors->first('email')}}</span>
    </div>  

    <div class="form-group">
    <label for="contactno"><b>Contact No</b></label>
    <input type="text" name="phone" id="contactno" class="form-control">
    <span class="has-error-cstm"> {{$errors->first('phone')}}</span>
    <span class="already-exist"></span>
    </div>

    <div class="form-group">
    <strong>Gender</strong>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
      <label class="form-check-label" for="gender">
      Male
      </label>
      <input class="form-check-input" type="radio" name="gender" id="female" value="female">
      <label class="form-check-label" for="gender">
      Female
      </label>
    </div>
    </div>

    <div class="form-group">
    <label for="psw"><b>Password</b></label>
    <input type="password" name="password" class="form-control">
    <span class="has-error-cstm"> {{$errors->first('password')}}</span>
    </div>    

    <div class="clearfix">
      <button type="button" onclick="submitForm();" class="btn btn-default signupbtn">Sign Up</button>
    </div>
</form>
</div>
</body>
<footer>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! $validator->selector('#user_add') !!}
<script type="text/javascript">
  function submitForm(){
    var cno = $('#contactno').val();
    var _token = $('input[name="_token"]').val();
    $('.already-exist').html("");
    $.ajax({
        method: "POST",
        url: '{{url('/checkcontact')}}',
        data: {
          cno:cno, 
          _token:_token
        },
        success: function(result) {
            if(result == 1){
              $('.already-exist').html("The Contact No has already been taken");
              $('#contactno').focus();
            }
            else{
              $('#user_add').submit();
            }
           
        }   
    });
  }
</script>
</footer>
</html>