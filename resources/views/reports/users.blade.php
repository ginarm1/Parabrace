@extends('layout.app')
@section('content')
    <div class="container p-4">
        <h5>Legend:</h5>
        <p>U - user</p>

        <a href="{{route('sales')}}"><button class="btn btn-dark my-4">Sales</button></a>

        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">U name</th>
                    <th scope="col">U surname</th>
                    <th scope="col">U email</th>
                    <th scope="col">U country</th>
                    <th scope="col">U city</th>
                    <th scope="col">U address</th>
                    <th scope="col">U phone nr.</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="text-center">
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> surname}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{$user -> country}}</td>
                    <td>{{$user -> city}}</td>
                    <td>{{$user -> address}}</td>
                    <td>{{$user -> phone_nr}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
