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
                <h1 class="display-4 ">Edit articles</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Edit the article. Partner input is not necessary! Partner delete is not working..</p>
            </div>
        </div>
    </div>

    <!--About paracord-->
    <div class="container-fluid">
        <div class="row jumbotron">

            <div class="container">
                @csrf
                {!! Form::open(['action' => ['ArticlesController@update',$article -> id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title','Name')}}
                    {{Form::text('name',$article -> name,['class'=>'form-control','placeholder'=>'Insert article name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Intro')}}
                    {{Form::textarea('intro',$article -> intro,['class'=>'form-control','placeholder'=>'Insert intro'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Main text')}}
                    {{Form::textarea('text',$article -> text,['class'=>'form-control','placeholder'=>'Insert main text'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Update an image (optional):')}}
                    {{Form::file('image')}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Partner name (optional)')}}
                    {{Form::text('partner-name','',['class'=>'form-control','placeholder'=>'Add partner'])}}
                </div>

                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Save article',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}

                <hr class="light">

                @foreach($article->partners as $partner)
                    <div class="form-group">
                        <p>Partner name: {{$partner->name}}</p>
                    </div>
                    <div class="form-group">
                        <p>Partner website: {{$partner->url}}</p>
                    </div>
                    {{--                For deleting partner from a partner--}}
                    {!! Form::open(['action' => ['ArticlesController@removePartner',$article->id,$partner->id],'method'=>'POST' ]) !!}
{{--                    {{Form::hidden('_method','PUT')}}--}}
                    {{Form::submit('Remove partner from article',['class'=>'btn btn-danger'])}}
                    {!! Form::close() !!}
                    <hr class="light">
                @endforeach
                <a href="{{route('articles')}}"><button class="btn btn-light mt-3">Cancel</button></a>
            </div>

        </div>
    </div>
@endsection
