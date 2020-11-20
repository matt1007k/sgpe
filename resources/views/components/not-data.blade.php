@props(['color'])
<div class="flex flex-col align-center justify-center">
    <div class="mb-1">
        <i class="material-icons ic icon-big {{ $color == 'red' ? 'icon-danger' : 'icon-blue' }}">sentiment_dissatisfied</i>
    </div>
    <h4>{{ $slot }}</h4>
</div>