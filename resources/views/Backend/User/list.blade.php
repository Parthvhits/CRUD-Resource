<!DOCTYPE html>
<html>
    <head>
        <title>List</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">        
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Contact No</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @php
            $cnt=1;
            @endphp
            @foreach($allContent as $user)
                <tr>
                <th>{{ $cnt }}</th>
                <td>{{ $user->user_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->phone }}</td>
                <td><a href="{{route('user.edit', $user->id)}}" class="btn btn-default">Edit</a></td>
                <td>
                    <form action="{{route('user.destroy',$user->id)}}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-default" onclick="return confirm('Are you sure you want to delete this user?');" type="submit">Delete</button>
                    </form>
                </td>
                </tr>
            @php
            $cnt++;
            @endphp
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('logout') }}">Logout</a>
    </div>
    </body>
    <footer>
    </footer>
</html>