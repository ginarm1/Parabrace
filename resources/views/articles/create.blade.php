@extends('layout.app')
@section('content')

    <!-- About section-->
    <div class="container-fluid bg-light">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4 ">Add Article</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Add new article with: name, intro, text, (optional: photo)</p>
            </div>
        </div>
    </div>

    <!--About paracord-->
    <div class="container-fluid">
        <div class="row jumbotron">
                <div class="container">
                    @csrf
                    {!! Form::open(['action' => 'ArticlesController@store','method'=>'POST', 'enctype'=>'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{Form::label('title','Name')}}
                        {{Form::text('name','',['class'=>'form-control','placeholder'=>'Insert article name'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title','Intro')}}
                        {{Form::textarea('intro','',['class'=>'form-control','placeholder'=>'Insert intro'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title','Main text')}}
                        {{Form::textarea('text','',['class'=>'form-control','placeholder'=>'Insert main text'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title','Insert an image (optional)')}}
                        {{Form::file('image')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('title','Partner name (optional)')}}
                        {{Form::text('partner-name','',['class'=>'form-control','placeholder'=>'Add partner'])}}
                    </div>

                    {{Form::submit('Add article',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>

        </div>
    </div>
@endsection
