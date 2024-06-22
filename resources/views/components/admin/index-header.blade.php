<div class="card-header row mx-1">
    <h4 class="col-sm-6">{{ Str::title($action . " " . Str::plural($entity)) }}</h4>
    @can("$entity create")
    <div class="col-sm-6">
        @if(in_array('create', $buttons))
        <a href="{{ route("admin.$entity.create") }}" class="btn btn-primary float-right">
        Add {{ Str::title($entity) }}</a>       
        @endif
        @if(in_array('index', $buttons))
        <a href="{{ route("admin.$entity.index") }}" class="btn btn-danger float-right">Back</a>
        @endif
    </div>
    @endcan
</div>
