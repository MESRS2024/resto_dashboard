
<a wire:click="{{$action}}({{ $recordId }})"
         onclick="confirm('Are you sure you want to perform this action?') || event.stopImmediatePropagation()">

@if ($status)
<i style="width: 25px;">
    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block  @if ($successValue === true) text-green @else text-red @endif"  style="width: 25px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>

</i>
@else
    <i style="width: 25px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block @if ($successValue === false) text-red @else text-green @endif" style="width: 25px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </i>

@endif
</a>

