<x-admin.view-base :entity="$entity" :action="'update'">
    <x-adminlte-datatable id="table" :heads="$head" head-theme="dark" theme="light" striped bordered hoverable>
        @foreach ($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->guard_name }}</td>
            <td>{{ $role->created_at }}</td>
            <td>
            <x-admin.index-actions :entity="$entity" :objectId="$role->id" />
            </td>
        </tr>
        @endforeach
    </x-adminlte-datatable>
</x-admin.view-base>