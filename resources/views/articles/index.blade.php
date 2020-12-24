@extends('layout.app')
@section('content')
    <style>
        .hidden{
            width: 50px;
        }
    </style>
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
            @if(Gate::allows('admins-only'))

            <div class="row">
                <a href="{{url('./articles/create')}}"><button class="btn btn-primary">Create article</button></a>
            </div>
            @endif

            @forelse($articles as $article)

                <div class="card">
                    <h2>{{$article -> name}}</h2>
                    @if($article -> image != null)
                        <img src="storage/img/articles/{{$article ->image}}" alt="article-img" width="400px">
                    @endif
                    <p>{{$article -> intro}}</p>

                    @foreach($article -> partners as $partner)
                        <p>Powered by: <a href="http://{{$partner->url}}" class="pl-2" style="color: #daffff;text-decoration: none">{{$partner->name}}</a></p>
                    @endforeach

                    <a href="./articles/{{$article -> id}}"><button class="btn btn-light">Read More ></button></a>
                    @if(Gate::allows('admins-only'))
                        <a href="./articles/{{$article -> id}}/edit"><button class="btn btn-secondary mt-3">Edit</button></a>
                    @endif
                </div>
                @empty
                    <p>No articles found</p>
                @endforelse

        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/articles-page.js')}}"></script>
@endsection
