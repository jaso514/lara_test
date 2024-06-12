
@can("$entity update")
<a href="{{ route("admin.$entity.edit", [$objectId]) }}" class="btn btn-success">Edit</a>
@endcan

@can("$entity delete")
<form method="POST" action="{{ route("admin.$entity.destroy", [$objectId]) }}">
    @method('DELETE')
    @csrf
    <button type="submit">{{ __('Delete') }}</button>
</form>
@endcan
