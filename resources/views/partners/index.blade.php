@extends('layout.app')
@section('content')

    <!-- Parners section-->
    <div class="container-fluid bg-light">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4 ">Partners</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Here are our dear partners!</p>
            </div>
        </div>
    </div>
    @if(Gate::allows('admins-only'))
        <div class="container">
            <a href="partners/create"><button class="btn btn-primary m-3 mt-4" style="float:right" >Create partner</button></a>
        </div>
    @endif
    <div class="partners-container">

        @forelse($partners as $partner)
            <div class="partner mb-4">
                <h3>Partnerio pavadinimas: {{$partner -> name}}</h3>
                Partnerio tinklapis: <a href="https://{{$partner -> url}}" style="text-decoration: none">{{$partner->url}}</a>

                @if(Gate::allows('admins-only'))
                    <div class="row">
                        <a href="./partners/{{$partner->id}}/edit"><button class="btn btn-secondary">Settings</button></a>
                    </div>

                @endif
            </div>
        @empty
            <p>No articles found</p>
        @endforelse
    </div>
@endsection

