<x-admin.view-base :entity="$entity" :action="'update'">
    <x-adminlte-datatable id="role-table" :heads="$head" head-theme="dark" theme="light" striped bordered hoverable>
        @foreach ($roles as $role)
        <tr data-role-name="{{ $role->name }}">
            <td>{{ $role->name }}</td>
            <td>{{ $role->guard_name }}</td>
            <td>{{ $role->created_at }}</td>
            <td>
            <x-admin.index-actions :entity="$entity" :objectId="$role->id" />
            </td>
        </tr>
        @endforeach
    </x-adminlte-datatable>

    @push('js')
    @can("$entity delete")
    <script>
    $(document).ready(function() {
        $('#role-table tr[data-role-name="super-admin"]').find(".confirm-delete-btn").prop('disabled', true).removeAttr('data-object-id');
        $('#role-table tr[data-role-name="admin"]').find(".confirm-delete-btn").prop('disabled', true).removeAttr('data-object-id');
    });
    </script>
    @endcan
    @endpush
</x-admin.view-base>