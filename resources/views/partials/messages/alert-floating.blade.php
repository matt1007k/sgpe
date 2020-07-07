    @if(session('message'))
    <div x-data="{ open: true }">
        <div 
            class="alert-floating alert-floating-success"
            x-show="open"
            @click.away="open = false" 
            x-transition:enter="transition"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition"
            x-transition:leave-end="opacity-0 -translate-y-3"
            >
            <div class="icon">
                <i class="material-icons">check</i>
            </div>
            <span>
                {{ session('message') }}
            </span>
            <div class="close" @click="open = false">
                <i class="material-icons">close</i>
            </div>
        </div>

    </div>
    @endif