<x-admin-layout>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <x-admin.index-header :entity="$entity" :action="'list'" :buttons="['create']"/>
                    
                    <div class="card-body"></div>
                    <x-adminlte-datatable id="table" :heads="$head" head-theme="dark" theme="light" striped bordered hoverable>
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $user->username !!}</td>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <h5><label class="badge bg-primary mx-1">{{ $rolename }}</label></h5>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <x-admin.index-actions :entity="$entity" :objectId="$user->id" />
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                    </div>
                </div>
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this {{ $entity }}? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route("admin.$entity.destroy", ["oId"]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin.index-scripts :entity="$entity"/>

</x-admin-layout>