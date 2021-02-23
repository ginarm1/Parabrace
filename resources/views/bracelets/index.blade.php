@extends('layout.app')
@section('content')
    <!--Bracelets container-->
    <div class="bracelets-container my-4 py-3">

        @if($bracelets != null)
            @forelse($bracelets as $bracelet)
                @guest
                    <div class="bracelets">
                        <img class="card-bracelet-img" src="{{ asset('storage/img/bracelets/'.$bracelet -> image)}}"  alt="bracelet-photo">
                        <h5 class="p-3" style="color: black">{{$bracelet  -> name}}</h5>
                        @if($bracelet -> lower_cost!= null && $bracelet -> lower_cost < $bracelet -> cost)
                            <h5 class="text-danger mr-2 pl-5" style="display: inline">€ {{$bracelet->lower_cost}}</h5>
                            <p style="display: inline">€ <del>{{$bracelet->cost}}</del></p>
                        @else
                            <p>€ {{$bracelet->cost}}</p>
                        @endif
                        <p>Login to order a bracelet</p>

                    </div>
                @else
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
                            <?php
                            $bracelet_in_cart = false;
                            $count_same_bracelets = 0;
                            ?>

                            @if($bracelet->on_stock_quantity > 0)
{{--                                --}}
                                @if(!$empty_cart)
                                    @foreach($items as $item)
                                        @if($item -> name === $bracelet->name)
                                            <?php
                                            $bracelet_in_cart = true;
                                            $count_same_bracelets = $item -> quantity;
                                            ?>
                                        @endif
                                    @endforeach

                                    @if($bracelet_in_cart)

                                        <p class="mt-3" style="color: black"><b>Now in cart: {{ $count_same_bracelets}}</b></p>
    {{--                                    <p>User id: {{$user_id}}</p>--}}
    {{--                                    <p>Bracelet id: {{$bracelet->id}}</p>--}}
                                        {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],
                                                'method'=>'POST' , 'class' => 'mt-3']) !!}
                                        {{Form::hidden('_method','POST')}}
                                        {{Form::submit('Add one more',['class' => 'btn btn-danger mb-4'])}}
                                        {!! Form::close() !!}

                                        {!! Form::open(['action' => ['Api\CartController@minusOneFromCart', $bracelet->id],
                                                'method'=>'POST' , 'class' => 'mt-3']) !!}
                                        {{Form::hidden('_method','POST')}}
                                        {{Form::submit('Remove 1 quantity',['class' => 'btn btn-dark mb-4'])}}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],
                                                'method'=>'POST' , 'class' => 'mt-3']) !!}
                                        {{Form::hidden('_method','POST')}}
                                        {{Form::submit('To the car',['class' => 'btn btn-danger mb-4'])}}
                                        {!! Form::close() !!}
                                    @endif
                                @else
                                    {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],
                                      'method'=>'POST' , 'class' => 'mt-3']) !!}
                                    {{Form::hidden('_method','POST')}}
                                    {{Form::submit('To the car',['class' => 'btn btn-danger mb-4'])}}
                                    {!! Form::close() !!}
                                @endif
                            @else
                                <p>No bracelets left</p>
{{--                                --}}
                            @endif
                        </div>
                    </a>
                @endguest
            @empty
                <p>There are no bracelets</p>
            @endforelse

            <div class="row d-inline text-center">
                @if(Gate::allows('admins-only'))
                    <a href="{{route('bracelets')}}/create" class="mt-3" style="height: 60%"><button class="btn btn-dark">Add Bracelet</button></a>
                @endif
                <div class="bracelet-link mt-4">
                    {{$bracelets->links()}}
                </div>
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

