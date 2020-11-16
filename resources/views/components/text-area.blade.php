<div class="group-input">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="input @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}                                   
    style="height: 200px;">{{ $slot }}</textarea>
    @error($name)
    <div class="text-invalid">
        {{ $message }}
    </div>
    {{-- @else
    <div class="text-help">
        {{ $help }}
    </div> --}}
    @enderror
</div>