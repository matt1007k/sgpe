@props(['status'])

@if($status == 'activo')
<span class="badge badge-success">
    {{ ucfirst($status) }}
</span>
@elseif($status == 'sobreviviente')
<span class="badge badge-primary">
    {{ ucfirst($status) }}
</span>
@elseif($status == 'cesante')
<span class="badge badge-danger">
    {{ ucfirst($status) }}
</span>
@endif