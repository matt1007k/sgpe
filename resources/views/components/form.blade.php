@props(['method'])

<form method="{{ strtolower($method) == 'get' ? 'get' : 'post' }}" {{ $attributes }}>
    @if($method != 'get')
        @csrf
    @endif
    @if(in_array(strtolower($method), ['put', 'patch', 'delete']))
        @method($method)
    @endif

    {{ $slot }}
</form>