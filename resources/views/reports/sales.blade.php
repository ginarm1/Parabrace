@extends('layout.app')
@section('content')
    <div class="container p-4">
        <h5>Legend:</h5>
        <p>U - user, D - delivery</p>

        <a href="{{route('users-report')}}"><button class="btn btn-dark my-4">Users</button></a>
        <h5>Total earned: {{$total_earned}}</h5>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">O total cost</th>
                    <th scope="col">U name</th>
                    <th scope="col">U surname</th>
                    <th scope="col">D country</th>
                    <th scope="col">D city</th>
                    <th scope="col">D address</th>
                    <th scope="col">D phone nr.</th>
                    <th scope="col">Order last updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="text-center">
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order -> total_cost}}</td>
                        @foreach($users as $user)
                            @if($order->user_id == $user->id)
                                <td>{{$user->name}}</td>
                                <td>{{$user->surname}}</td>
                            @endif
                        @endforeach
                        <td>{{$order -> country}}</td>
                        <td>{{$order -> city}}</td>
                        <td>{{$order -> address}}</td>
                        <td>{{$order -> phone_nr}}</td>
                        <td>{{$order -> updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
