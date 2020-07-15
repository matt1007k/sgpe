<div class="items-count">

    <div class="card card-items-count flex align-center justity-between">
        <div class="flex align-center">
            <div class="ic icon-medium icon-dash-blue">
                <i class="material-icons-two-tone">people</i>
            </div> 

            <div class="ml-2">
                <h2>{{ $users_count }}</h2>
                <p class="text-light-blue font-medium">Total de usuarios</p>
            </div>
        </div>
        <a href="{{ route('users.index') }}" class="more">
            <i class="material-icons">chevron_right</i>
        </a>
    </div>

    <div class="card card-items-count flex align-center justity-between">
        <div class="flex align-center">
            <div class="ic icon-medium icon-dash-blue">
                <i class="material-icons-two-tone">send</i>
            </div> 

            <div class="ml-2">
                <h2>{{ $sended_me_count }}</h2>
                <p class="text-light-blue font-medium">Total de correos enviados</p>
            </div>
        </div>
        <a href="{{ route('inboxes.index') }}" class="more">
            <i class="material-icons">chevron_right</i>
        </a>
    </div>

    <div class="card card-items-count flex align-center justity-between">
        <div class="flex align-center">
            <div class="ic icon-medium icon-dash-blue">
                <i class="material-icons-two-tone">email</i>
            </div> 

            <div class="ml-2">
                <h2>{{ $recivied_me_count }}</h2>
                <p class="text-light-blue font-medium">Total de correos recibidos</p>
            </div>
        </div>

        <a href="{{ route('inboxes.index') }}" class="more">
            <i class="material-icons">chevron_right</i>
        </a>
    </div>

    {{-- <x-dashboard.card-count></x-dashboard.card-count> --}}

</div>