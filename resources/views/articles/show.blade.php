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
                <h1 class="display-4 ">Articles</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">About the bracelets and more!</p>
            </div>
        </div>
    </div>

    <!--About paracord-->
    <div class="container-fluid">
        <div class="row jumbotron">

            <div class="card-show" >
                <h1>{{$article -> name}}</h1>
                @if($article -> image != null)
                    <img src="{{asset('storage/img/articles/'.$article->image)}}" alt="art-img">
                @endif

                <h4 class="mt-4 mb-4">{{$article -> intro}}</h4>
                <p>{{$article -> text}}</p>

                <a href="./" class="more-articles-show"><button class="btn btn-dark">More articles...</button></a>
                @if(Gate::allows('admins-only'))
                    <a href="./{{$article -> id}}/edit" class="edit-article"><button class="btn btn-light">Edit</button></a>
                    {{--                Fake delete, after confirmation, real delet btn appears--}}
                    <button class="btn btn-danger mt-3" id="btn_delete" style="height: 5vh">Delete</button>
                    {{--                Real delete--}}
                    {{Form::open(['action'=>['ArticlesController@destroy',$article-> id],'method'=>'POST', 'class'=>'mt-3'])}}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('DELETE',['class'=>'btn btn-danger','id'=>'btn_delete_real'])}}
                @endif
            </div>

        </div>
    </div>
@endsection

