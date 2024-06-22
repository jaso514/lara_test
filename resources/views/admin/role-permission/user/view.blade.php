<x-admin.view-base :entity="$entity" :action="'update'">
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
</x-admin.view-base>