<div class="card-header">
    <h4>{{ Str::title(Str::plural($entity)) }}</h4>
    @can("$entity create")
    <a href="{{ route("admin.$entity.create") }}" class="btn btn-primary float-end">Add {{ Str::title($entity) }}</a>
    @endcan
</div>
