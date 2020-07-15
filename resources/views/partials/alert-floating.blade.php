@if(session('message'))
    <alert-floating :open="@if(session('message')) 'true' @endif">
        {{ session('message')}}
    </alert-floating>
    
@endif