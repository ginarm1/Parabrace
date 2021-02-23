@extends('layout.app')
@section('content')

    <!--Bracelets container-->
    <div class="container-show-br" style="background: #faf4ed">
{{--        <div class="row">--}}

            <!--Single bracelet pic-->
{{--            <div class="single-br-pic">--}}
                    <img src="{{asset('storage/img/bracelets/'.$bracelet->image)}}" width="650px" alt="Main-img">
{{--            </div>--}}
            <!--Single bracelet info-->
            <div class="single-br-info">
                <div class="container">

                        <h2 name="bracelet-name" class="name">{{$bracelet->name}}</h2> <h2 class="mb-4">paracord bracelet</h2>
                        @if($bracelet -> lower_cost!= null && $bracelet -> lower_cost < $bracelet -> cost)
                            <h2 class="text-danger mr-2" style="display: inline">€ {{$bracelet->lower_cost}}</h2>
                            <h5 style="display: inline">€ <del>{{$bracelet->cost}}</del></h5>
                        @else
                            <h2 name="text-success" class="text-success">€ {{$bracelet->cost}}</h2>
                        @endif

                        <div class="discription mt-3">
                            @if($bracelet->on_stock_quantity < 8)
                                <p id="small-amount"><em>Small amount, (less than 8)</em></p>
                            @endif

                            <p>Suits for men and women</p>
                        </div>

                            {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],
                                            'method'=>'POST' , 'class' => 'mt-3']) !!}
                            {{Form::hidden('_method','POST')}}
                            {{Form::submit('To the car',['class' => 'btn btn-danger mb-4'])}}
                            {!! Form::close() !!}

                        @if(Gate::allows('admins-only'))
                            <a href="{{route('bracelets')}}/{{$bracelet->id}}/edit"><button class="btn btn-secondary">Edit</button></a>
                            <button class="btn btn-danger mt-3 ml-3" id="btn_delete">Delete</button>
                            {!! Form::open(['action' => ['BraceletsController@destroy', $bracelet->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('DELETE',['class' => 'btn btn-danger', 'id'=>'btn_delete_real'])}}
                            {!! Form::close() !!}
                        @endif
                             <a href="{{route("bracelets")}}" id="btn-bracelets-back"><button class="btn btn-light">Back</button></a>

                </div>
            </div>

    </div>
{{--    </div>--}}
@endsection

