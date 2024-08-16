<div class="btn-group">
@can("$entity update")
    <a href="{{ route("admin.$entity.edit", [$objectId]) }}" class="btn btn-xs btn-success mx-1 shadow"
            alt="Edit" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </a>
@endcan

@can("$entity delete")
    <button type="button" class="btn btn-xs btn-danger mx-1 shadow confirm-delete-btn"
            
            data-entity="{{ $entity }}"
            data-object-id="{{ $objectId }}"
            data-toggle="modal" data-target="#deleteConfirmationModal"
            alt="Delete" title="Delete">
        <i class="fa fa-lg fa-fw fa-trash"></i>
    </button>
@endcan
</div>
