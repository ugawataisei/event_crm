@if(\Illuminate\Support\Facades\Session::get('status') === 'info')
    <div class="alert alert-success" role="alert">
        {{ \Illuminate\Support\Facades\Session::get('message') }}
    </div>
@elseif(\Illuminate\Support\Facades\Session::get('status') === 'alert')
    <div class="alert alert-danger" role="alert">
        {{ \Illuminate\Support\Facades\Session::get('message') }}
    </div>
@endif
