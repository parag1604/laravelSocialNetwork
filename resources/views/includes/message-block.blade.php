<div class="row">
    <div class="col-md-10 col-md-offset-1">
        {{-- Warning message --}}
        @if (count($errors)>0)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3><strong>Warning!</strong></h3>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::has('message'))
            @if(Session::get('status')=="faliure")
            {{-- Error message --}}
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3><strong>Error!</strong></h3>
                {{Session::get('message')}}
                @if (Session::has('link'))
                {{-- Or, you can try to recover you credentials <a class="alert-link" href={{ URL::to(Session::get('link')) }}>here</a> --}}
                <br>Or, you can try to recover you credentials <a class="alert-link" href='/public/{{ Session::get('link') }}'>here</a>
                @endif
            </div>
            @else
            {{-- Success message --}}
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3><strong>Success!</strong></h3>
                {{Session::get('message')}}        
            </div>
            @endif
        @endif
    </div>
</div>