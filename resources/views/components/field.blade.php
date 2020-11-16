<div class="group-input">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="input @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
    @error($name)
    <div class="text-invalid">
        {{ $message }}
    </div>
    @else
    <div class="help-text">
       
    </div>
    @enderror
</div>