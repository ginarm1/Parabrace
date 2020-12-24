@if(count($errors) >0)
    @if(session('negalima') =='negaliu' || session('negalima') =='gintis' || session('negalima') =='lab')
        <div class="container">
            <div class="alert alert-danger">
                <p>Buvo įvestas vienas iš žodžių: negaliu gintis lab4</p>
            </div>
        </div>
    @else
        @foreach($errors->all() as $error)
            <div class="container">
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            </div>
        @endforeach
    @endif
    {{session()->forget('name')}}
@endif


@if(session('success'))
    <div class="container">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>

@endif
@if(session('error'))
    <div class="container">
        <div class="alert alert-danger">
            <p>Jūsų sistemoje yra klaidų</p>
            {{session('error')}}
        </div>
    </div>

@endif

