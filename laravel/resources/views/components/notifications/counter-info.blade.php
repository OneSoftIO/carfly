@php ($plus = !isset($plus) ? '+' : ($plus ? '+' : '' ))

@if ($counter > 0)
    <span class="label label-info">{{ $plus.$counter }}</span>
    {{--<span class="arrow badge badge-default">{{ $plus.$counter }}</span>--}}
@endif