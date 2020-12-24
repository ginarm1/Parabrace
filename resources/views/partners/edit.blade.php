@extends('layout.app')
@section('content')
    <div class="content">

        <div class="container-fluid h-50">
            <div class="col-12">
                <div class="title-caption">
                    <h1 class="display-2">Parabrace</h1>
                </div>
            </div>
        </div>
        {{--    <img src="img/lithuanian-pro-ver4.png" alt="">--}}
    </div>


    <!-- About section-->
    <div class="container-fluid bg-light">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4 ">Edit the partner</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Edit this partner!</p>
            </div>
        </div>
    </div>

    <!--About paracord-->
    <div class="container-fluid">
        <div class="row jumbotron">

            <div class="container">
                @csrf
                {!! Form::open(['action' => ['PartnersController@update',$partner -> id],'method'=>'POST']) !!}
                <div class="form-group">
                    {{Form::label('title','Name')}}
                    {{Form::text('name',$partner -> name,['class'=>'form-control','placeholder'=>'Insert partner name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Link to the website')}}
                    {{Form::text('url',$partner -> url,['class'=>'form-control'])}}
                </div>

                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Add partner',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}

                <button class="btn btn-danger mt-3" id="btn_delete">Delete</button>
                {!! Form::open(['action' => ['PartnersController@destroy', $partner->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('DELETE',['class' => 'btn btn-danger','id'=>'btn_delete_real'])}}
                {!! Form::close() !!}

                <a href="./"><button class="btn btn-light mt-3">Cancel</button></a>
            </div>

        </div>
    </div>
@endsection
