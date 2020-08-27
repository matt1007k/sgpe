@if($status === 'verified')
    <span class="badge badge-primary">
        Verificado
    </span>
@elseif($status === 'unverified')
    <span class="badge badge-danger">
        Sin Verificar
    </span>
@endif
