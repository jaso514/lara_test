<x-admin.view-base :entity="$entity" :action="'update'">
    <x-adminlte-datatable id="table" :heads="$head" head-theme="dark" theme="light" striped bordered hoverable>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->guard_name }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>
                <x-admin.index-actions :entity="$entity" :objectId="$permission->id" />
            </td>
        </tr>
        @endforeach
    </x-adminlte-datatable>
</x-admin>