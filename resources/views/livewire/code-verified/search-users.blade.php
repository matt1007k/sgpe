<div>
    <div class="group-input code">
        <div class="input1">
            <label for="dni">DNI</label>
            <input type="text" id="dni" class="input" name="dni"  value="{{ old('dni') }}" required wire:model="dni">
            @error('dni')
            <div class="text-invalid">
            {{ $message }} 
            </div>
            @enderror
        </div>
        <div class="input2">
            <label for="code_verified">Código Verificada</label>
            <input type="text" id="code_verified" class="input"  value="{{ old('code_verified') }}" required wire:model="code_verified">                        
            @error('code_verified')
            <div class="text-invalid">
            {{ $message }} 
            </div>
            @enderror
        </div>
        <div class="flex align-end">
        <button wire:click.prevent="searchUser" class="btn btn-primary" {{ empty($dni) || empty($code_verified) ? 'disabled' : ''}}>
            <i class="material-icons">search</i>
        </button>
        </div>
    </div>
    <div wire:loading wire.target="dni" class="alert alert-info w-full">
        Buscando...
    </div>
    @if(!empty($user))
        @if($user['codVerifica'] === $code_verified)
            <div class="group-input">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" class="input"  value="{{ old('name', $full_name) }}"  required disabled>
                @error('name')
                <div class="text-invalid">
                   {{ $message }} 
                </div>
                @enderror
            </div>
            <div class="group-input code">
                <div class="input1 w-full md:w-1/2">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"  class="input" required>
                    @error('email')
                    <div class="text-invalid">
                    {{ $message }} 
                    </div>
                    @enderror
                </div>
                <div class="input2 w-full md:w-1/2">
                    <label for="phone">Telefóno o Celular</label>
                    <input type="text" id="phone" name="phone" class="input"  value="{{ old('phone') }}" required>                        
                    @error('phone')
                    <div class="text-invalid">
                    {{ $message }} 
                    </div>
                    @enderror
                </div>
            </div>
            <x-field
                label="Adjuntar Archivo"
                name="file" 
                :value="old('file')"
                type="file"
                help="El archivo no debe de superar los 10MB"
            />

            <div class="group-checkbox">
                <label for="accept">
                    <input type="checkbox" name="accept" id="accept" {{ old('accept') ? 'checked' : '' }}>

                    <span>
                    Acepto los  <a href="#" class="ml-1"> Términos y Condiciones</a>
                    </span>
                </label>
            </div>

            <button class="btn btn-primary btn-full">Registrarse</button>
        @else
        <div class="alert alert-danger w-full">
            Código Verificada no es válido
        </div>
        @endif
    @elseif(empty($user) && !empty($dni) && $searched)
        <div class="alert alert-danger w-full">
            Usuario no ha sido encontrado con el DNI: {{ $dni }}
        </div>
    @endif
</div>