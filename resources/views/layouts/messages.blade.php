<div class="errors">
    @if ($errors->any())
    <div class="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="error-message">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="success">
    @if(session()->has('success_message'))
        <div class="success-message">
            {{session()->get('success_message')}}
        </div>
    @endif
    @if(session()->has('info_message'))
        <div class="info-message">
            {{session()->get('info_message')}}
        </div>
    @endif
</div>     

