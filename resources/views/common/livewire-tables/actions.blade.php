@role('admin')
<div class='btn-group'>
    <a href="#popUp" href="{{ $editUrl }}"
       class='btn btn-default btn-xs' onclick="loadeditform('{{ $showUrl }}', '  {{__('crud.show') . ' ' . $title }}')">
        <i class="fa fa-eye"></i>
    </a>
    @if(isset($passwordUrl))
        <a href="#popUp" href="{{ $passwordUrl }}"
           class='btn btn-default btn-xs' onclick="loadeditform('{{ $passwordUrl }}', '  {{__('crud.show') . ' ' . $title }}')">
            <i class="fa fa-user-secret"></i>
        </a>
    @endif
    <a href="#popUp" href="{{ $editUrl }}"
        class='btn btn-default btn-xs' onclick="loadeditform('{{ $editUrl }}', '{{__('crud.edit') . ' ' . $title }}')">
        <i class="fa fa-edit"></i>
    </a>
    <a class='btn btn-danger btn-xs' wire:click="deleteRecord({{ $recordId }})"
       onclick="confirm('Are you sure you want to remove this Record?') || event.stopImmediatePropagation()">
        <i class="fa fa-trash"></i>
    </a>
</div>
@endrole
@role('dfm')
<a href="#popUp" href="{{ $flixyUrl }}"
   class='btn btn-success' onclick="loadeditform('{{ $flixyUrl }}', '{{__('crud.flixy') . ' ' . $title }}')">
    <i class="fa fa-plus"></i> {{__('crud.flixy')}}
</a>
@endrole
