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
                <div class="card" style="opacity: 1; height: 45vh; border: 1px solid black">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {!! Form::open(['action' => ['ProfileController@update',$user->id],'method'=>'POST' ]) !!}
                            <div class="form-group">
                                {{Form::label('title','Phone nr.')}}
                                {{Form::text('phone_nr',$user->phone_nr,['class'=>'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title','City')}}
                                {{Form::text('city',$user->city,['class'=>'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title','Address')}}
                                {{Form::text('address',$user->address,['class'=>'form-control'])}}
                            </div>
                            {{Form::hidden('_method','POST')}}
                            {{Form::submit('Update user',['class'=>'btn btn-dark'])}}
                            {!! Form::close() !!}

                            <a href="./" class="btn btn-secondary d-inline" >Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
