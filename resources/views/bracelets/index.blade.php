@extends('layout.app')
@section('content')
    <!--Bracelets container-->
    <div class="bracelets-container" style="margin-top: 30px; margin-bottom: 80px">
        @if(Gate::allows('admins-only'))
{{--            <a href="./bracelets/create" class="mt-3" style="height: 60%"><button class="btn btn-dark">Add Bracelet</button></a>--}}
            <a href="{{route('bracelets')}}/create" class="mt-3" style="height: 60%"><button class="btn btn-dark">Add Bracelet</button></a>
        @endif

        @if($bracelets != null)
            @forelse($bracelets as $bracelet)
                @guest
                    <div class="bracelets h-25">
                        <img class="card-bracelet-img" src="{{ asset('storage/img/bracelets/'.$bracelet -> image)}}"  alt="bracelet-photo">
                        <h5 class="p-3" style="color: black">{{$bracelet  -> name}}</h5>
                        @if($bracelet -> lower_cost!= null && $bracelet -> lower_cost < $bracelet -> cost)
                            <h5 class="text-danger mr-2 pl-5" style="display: inline">€ {{$bracelet->lower_cost}}</h5>
                            <p style="display: inline">€ <del>{{$bracelet->cost}}</del></p>
                        @else
                            <p>€ {{$bracelet->cost}}</p>
                        @endif
                        <p>Login to order a bracelet</p>


                        {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                        {{Form::hidden('_method','POST')}}
                        {{Form::submit('To the car',['class' => 'btn btn-danger mb-4'])}}
                        {!! Form::close() !!}
{{--                        <button class="btn btn-danger mb-4" style="border-radius: 15px">To the cart</button>--}}
                    </div>
                @else
{{--                    <a href="./bracelets/{{$bracelet->id}}" class="bracelet-link" style="color: #990606">--}}
                    <a href="{{route('bracelets')}}/{{$bracelet->id}}" class="bracelet-link" style="color: #990606">
                        <div class="bracelets pt-3" style="background: #ffffff">
                            <img src="storage/img/bracelets/{{$bracelet -> image}}" style="width: 350px" alt="bracelet-photo">
                            <h5 style="color: black">{{$bracelet -> name}}</h5>
                            @if($bracelet -> lower_cost!= null && $bracelet -> lower_cost < $bracelet -> cost)
                                <h5 class="text-danger mr-2 pl-5" style="display: inline">€ {{$bracelet->lower_cost}}</h5>
                                <p style="display: inline">€ <del>{{$bracelet->cost}}</del></p>
                            @else
                                <p>€ {{$bracelet->cost}}</p>
                            @endif

                            {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                            {{Form::hidden('_method','POST')}}
                            {{Form::submit('To the car',['class' => 'btn btn-danger mb-4'])}}
                            {!! Form::close() !!}
                        </div>
                    </a>
                @endguest
            @empty
                <p>No articles found</p>
            @endforelse
            <div class="mt-4">
                {{$bracelets->links()}}
            </div>

        @else
            <p>Bracelets not found</p>
        @endif
    </div>

@endsection

<style>
{{--    Pagination arrows--}}
    .hidden > div:nth-child(1){
        margin-top: 1rem;
    }
    .hidden > div:nth-child(2){
         visibility: hidden;
     }
</style>

