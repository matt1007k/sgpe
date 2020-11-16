{{-- <div x-data="{ open: false }">
    <a class="btn btn-primary" @click="open = true">
        <i class="material-icons">add</i>
        Nuevo mensaje
    </a>
    <div class="modal" 
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition"
        x-transition:leave-end="opacity-0 -translate-y-3"
        >
        <div class="modal-content" style="
        width: 600px;">
            <div class="close" @click="open = false">
                <i class="material-icons">close</i>
            </div>
            <div class="card">
                <h3>Redactar un correo</h3>
                <x-form method="post" :action="route('inboxes.store')">
                    <x-field 
                        label="Para"
                        name="to"
                        :value="old('to')" 
                        type="email"
                        help="example@gmail.com"
                        />

                    <x-field 
                        label="Asunto"
                        name="subject"
                        :value="old('subject')" 
                        />

                    <x-text-area 
                        label="Mensaje"
                        name="body"
                        >
                        {{ old('body') }}
                    </x-text-area>
                    
                    <div class="actions">
                        <a
                            class="btn btn-outline-secondary"  
                            @click="open = false"
                            >Cancelar</a>
                        <button class="btn btn-primary">
                            <i class="material-icons-two-tone left">send</i>
                            Enviar
                        </button>
                    </div>
                </x-form>
            </div>

        </div>
    </div>
</div> --}}
    <sent-message>
    </sent-message>
{{-- @push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<style>
.CodeMirror, .CodeMirror-scroll {
	min-height: 100px;
}
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script> 
<script>
    var simplemde = new SimpleMDE({ element: document.getElementById("body"),
        placeholder: "Escribe tu mensaje aquí..."
    });
    // simplemde.value('New input for **EasyMDE**');
</script>
@endpush --}}