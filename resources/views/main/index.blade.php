<style>
    @media (max-width: 1110px) {
        .row{
            flex-direction: column;
            align-items: center;
        }
    }
</style>

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
            <h1 class="display-4 ">About</h1>
        </div>
        <hr>
        <div class="col-12">
            <p class="lead">Welcome to a store of handmade bracelets from paracord!</p>
        </div>
    </div>
</div>

<!--Newest 3 articles-->
<div class="container-fluid">
{{--    <a href="./articles" class="more-articles"><button class="btn btn-dark">More articles...</button></a>--}}
    <div class="row jumbotron">

        @foreach($articles as $article)

            <div class="card mr-4">
                    <h2>{{$article -> name}}</h2>
                        @if($article -> image != null)
                            <img src="storage/img/articles/{{$article ->image}}" alt="article-img">
                        @endif

                    <p>{{$article -> intro}}</p>
                    @foreach($article -> partners as $partner)
                        <p>Partner by: <a href="https://{{$partner->url}}" style="color: #d4cccc;text-decoration: none;">{{$partner -> name}}</a></p>
                    @endforeach
                    <a href="./articles/{{$article -> id}}"><button class="btn btn-light">Read more ></button></a>
            </div>
        @endforeach
            <a href="./articles" class="more-articles m-3"><button class="btn btn-dark">More articles...</button></a>
    </div>
</div>

@endsection

@section('js')
    {{--    JS--}}
    <script src="{{asset('js/script.js')}}"></script>
@endsection
