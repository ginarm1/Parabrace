@extends('layout.app')
@section('content')
    <!--Bracelets container-->
    <div class="bracelets-container" style="margin-top: 30px; margin-bottom: 80px">
        @if(Gate::allows('admins-only'))
            <a href="./bracelets/create" class="mt-3" style="height: 60%"><button class="btn btn-dark">Add Bracelet</button></a>
        @endif

        @if($bracelets != null)
            @forelse($bracelets as $bracelet)
                @guest
                    <div class="bracelets pt-3" style="background: #ffffff">
                        <img src="{{ asset('storage/img/bracelets/'.$bracelet -> image)}}" style="width: 350px" alt="bracelet-photo">
                        <h5 class="pl-3 pt-3" style="color: black">{{$bracelet -> name}}</h5>
                        @if($bracelet -> lower_cost!= null && $bracelet -> lower_cost < $bracelet -> cost)
                            <h5 class="text-danger mr-2 pl-5" style="display: inline">€ {{$bracelet->lower_cost}}</h5>
                            <p style="display: inline">€ {{$bracelet->cost}}</p>
                        @else
                            <p>€ {{$bracelet->cost}}</p>
                        @endif
                        <p>Login to order a bracelet</p>
                    </div>
                @else
                    <a href="./bracelets/{{$bracelet->id}}" class="bracelet-link" style="color: #990606">
                        <div class="bracelets pt-3" style="background: #ffffff">
                            <img src="storage/img/bracelets/{{$bracelet -> image}}" style="width: 350px" alt="bracelet-photo">
                            <h5 class="pl-3" style="color: black">{{$bracelet -> name}}</h5>
                            @if($bracelet -> lower_cost!= null && $bracelet -> lower_cost < $bracelet -> cost)
                                <h5 class="text-danger mr-2 pl-5" style="display: inline">€ {{$bracelet->lower_cost}}</h5>
                                <p style="display: inline">€ {{$bracelet->cost}}</p>
                            @else
                                <p>€ {{$bracelet->cost}}</p>
                            @endif
                        </div>
                    </a>
                @endguest
            @empty
                <p>No articles found</p>
            @endforelse
                <div class="links" style="height: 50%">
                    {{$bracelets->links()}}
                </div>
        @else
            <p>Bracelets not found</p>
        @endif

    </div>
@endsection

<style>
    .hidden > div:nth-child(1){
        margin-top: 1rem;
    }
    .hidden > div:nth-child(2){
         visibility: hidden;
     }
</style>

