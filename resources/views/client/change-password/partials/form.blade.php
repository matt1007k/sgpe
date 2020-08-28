
    <x-field 
        label="Contraseña Actual" 
        name="current_password" 
        type="password"
        :value="old('current_password')" required /> 

    <x-field 
        label="Contraseña Nueva" 
        name="password" 
        type="password"
        :value="old('password')" required /> 

    <x-field 
        label="Repetir Contraseña" 
        name="password_confirmation" 
        type="password"
        :value="old('password_confirmation')" required /> 
    
    <div class="divider-x"></div>

    <div class="mt-4 flex justity-end">
        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">Cancelar</a>
        <button class="ml-2 btn btn-primary">{{ $btnText }}</button>
    </div>
