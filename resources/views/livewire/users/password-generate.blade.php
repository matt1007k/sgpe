<div class="w-100 mt-2 flex justify-stretch align-end">
    <div class="w-100">
        <label for="password">Contraseña</label>
        <input type="text" id="password" class="input" wire:model="password" name="password">
        @error('password')
        <div class="text-invalid" > 
            {{ $message }}
        </div>
         @enderror
    </div>
    <div class="ml-1 flex align-center">
        <button class="btn btn-outline-teal" wire:click.prevent="passwordGenerate">Generar</button>
    </div>
</div>

<div class="actions">
    <button 
        class="btn btn-outline-secondary"  
        @click.prevent="open = false"
        >Cancelar</button>
    <button class="btn btn-primary">
        <i class="material-icons-two-tone left">edit</i>
        Cambiar
    </button>
</div>
