@extends('layout.app')
@section('content')

    <!-- About section-->
    <div class="container-fluid bg-light">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4 ">Add partner</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Add new partner with: name, link to the website (no need of http://)</p>
            </div>
        </div>
    </div>

    <!--Partner form-->
    <div class="container-fluid">
        <div class="row jumbotron">
            <div class="container">
                @csrf

                {!! Form::open(['action' => 'PartnersController@store','method'=>'POST' ]) !!}
                <div class="form-group">
                    {{Form::label('title','Name:')}}
                    {{Form::text('name','',['class'=>'form-control','placeholder'=>'Insert partner name'])}}
                    {{ csrf_field() }}
                </div>
                <div class="form-group">
                    {{Form::label('title','Link to the website:')}}
                    {{Form::text('url','',['class'=>'form-control','placeholder'=>'Insert name of the website'])}}
                </div>

                {{Form::submit('Add partner',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}

                <a href="./" class="btn btn-secondary mt-4" >Cancel</a>
            </div>

        </div>
    </div>
@endsection
