@extends('layout.app')
@section('content')

    <!-- About section-->
    <div class="container-fluid bg-light">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4 ">Edit Bracelet</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Edit bracelet</p>
            </div>
        </div>
    </div>

    <!--Partner form-->
    <div class="container-fluid">
        <div class="row jumbotron">
            <div class="container">
                @csrf

                {!! Form::open(['action' => ['BraceletsController@update',$bracelet->id],'method'=>'POST','enctype'=>'multipart/form-data' ]) !!}
                <div class="form-group">
                    {{Form::label('title','Name:')}}
                    {{Form::text('name',$bracelet->name,['class'=>'form-control','placeholder'=>'Insert name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','On stock quantity:')}}
                    {{Form::number('on_stock_quantity',$bracelet->on_stock_quantity,['class'=>'form-control','placeholder'=>'Insert bracelet quantity'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Cost')}}
                    {{Form::number('cost',$bracelet->cost,['class'=>'form-control','placeholder'=>'Insert bracelet cost'])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Update an image (optional):')}}
                    {{Form::file('image')}}
                </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Update bracelet',['class'=>'btn btn-dark'])}}
                {!! Form::close() !!}

                <a href="{{route('bracelets')}}" class="btn btn-secondary mt-4" >Cancel</a>
            </div>

        </div>
    </div>
@endsection
