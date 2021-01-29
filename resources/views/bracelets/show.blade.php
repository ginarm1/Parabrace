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
                         @if(Gate::allows('admins-only'))
                            {!! Form::open(['action' => ['Api\CartController@addToCart', $bracelet->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                            {{Form::hidden('_method','POST')}}
                            {{Form::submit('To the car',['class' => 'btn btn-danger mb-4'])}}
                            {!! Form::close() !!}

                            <a href="./{{$bracelet->id}}/edit"><button class="btn btn-secondary">Edit</button></a>
                            <button class="btn btn-danger mt-3 ml-3" id="btn_delete">Delete</button>
                            {!! Form::open(['action' => ['BraceletsController@destroy', $bracelet->id],'method'=>'POST' , 'class' => 'mt-3']) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('DELETE',['class' => 'btn btn-danger', 'id'=>'btn_delete_real'])}}
                            {!! Form::close() !!}
                        @endif
                             <a href="{{asset("bracelets")}}" id="btn-bracelets-back"><button class="btn btn-light">Back</button></a>
{{--                        <!--Customer info-->--}}
{{--                        <div class="customer-info">--}}
{{--                            <h3 class="mb-3">Wrist extent</h3>--}}
{{--                            <!--Sizes info-->--}}

{{--                            <select name="wrist-size" class="custom-select mb-3" value="">--}}
{{--                                <option selected value="S">S(15 cm - 16,5 cm)</option>--}}
{{--                                <option value="M">M(16,5 cm - 18 cm)</option>--}}
{{--                                <option value="L">L(18 cm - 19,5 cm)</option>--}}
{{--                                <option value="XL">XL(19,5 cm - 21 cm)</option>--}}
{{--                            </select>--}}

{{--                            <h4>Count</h4>--}}
{{--                            <div class="row">--}}
{{--                                <div class="m-3">--}}
{{--                                    <select name="count" class="custom-select"  >--}}

{{--                                        <?php--}}
{{--                                        //  get the quantity from database and convert to option--}}
{{--                                        // echo "<br>".  $bracelet -> show_bracelet(3,['on_stock_quantity']);--}}

{{--                                        for($i=1;$i <= 10;$i++){--}}
{{--                                            if($i == 1){--}}
{{--                                                echo "<option selected value='$i'>$i</option>";--}}
{{--                                            }else{--}}
{{--                                                echo "<option value='$i'>$i</option>";--}}
{{--                                            }--}}
{{--                                        }--}}
{{--                                        ?>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="mini-container"></div>--}}
{{--                                <div class="col-9" style="margin-bottom: 25px">--}}

{{--                                    <button type="submit" name='put-to-cart' class="btn btn-success"  >Put to the cart</button>--}}


{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}


                </div>
            </div>

    </div>
{{--    </div>--}}
@endsection

