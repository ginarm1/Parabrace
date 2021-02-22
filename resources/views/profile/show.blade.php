<style>
    #app{
        background: lightgoldenrodyellow;
    }
</style>
@extends('layout.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4" style="opacity: 1; height: 45vh; border: 1px solid black">
                    <div class="card-header">{{ __('User information') }}</div>

                    <div class="card-body text-left">
                        <h5><b>Role:</b>  {{$role_id}}</h5>
                        <h5><b>User:</b> {{$user -> name}} {{$user->surname}}</h5>
                        <h5><b>Email:</b> {{$user-> email}}</h5>
                        <h5><b>Phone nr.:</b> {{$user-> phone_nr}}</h5>
                        <h5><b>Country:</b> {{$user-> country}}</h5>
                        <h5><b>City:</b> {{$user-> city}}</h5>
                        <h5><b>Address:</b> {{$user-> address}}</h5>
                        <a href="./{{$user->id}}/edit"><button class=" btn btn-dark mb-5 w-25">Edit</button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
