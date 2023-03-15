@if(session()->has('message'))

    <div id='flash-message'>
        <p>{{session('message')}}</p>
    </div>

@endif