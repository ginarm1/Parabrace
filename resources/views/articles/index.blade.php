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
{{--    Vue js--}}
    <div id="appv">
        <Articles></Articles>
    </div>


@endsection

@section('js')

    <script src="{{asset('js/articles-page.js')}}"></script>
    <script src="{{mix('js/app.js')}}"></script>
@endsection
