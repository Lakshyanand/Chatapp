@extends('layouts.app')
@section('content')


<div class="content-wrapper">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <br>

    <div class="container mt-4 bg-light">
    
        
        <main class="form-signin text-center">
            <form method="GET" action="/adminpanel">
                @csrf
                <div class="form-floating mt-3 text-right">
                <h1 class="text-center">Agent List</h1> 
                    <input type="text" name="search" placeholder="search">
                    <button type="submit">Search</button>
                </div>                                  
            </form>
        </main>

    </div>


    <div class="container col-10 mt-4">
        <table class="table table-bordered text-center">
            <thead class = "table-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($lists as $list)
                    <tr>
                        <td>{{ $list['id'] }}</td>
                        <td>{{ $list['name'] }}</td>
                        <td>{{ $list['email'] }}</td>
                        <td>
                            <a href = "editagent/{{$list['id']}}/{{$list['name']}}"><button class = "btn btn-primary" type="button">Edit</button></a>
                            <a href = "deleteagent/{{$list['id']}}"><button class = "btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button></a>    
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <script type="text/javascript">
        setTimeout(function () {
            // Closing the alert
            $('.alert').alert('close');
        }, 5000);
    </script>

</div> 


@endsection