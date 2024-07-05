<x-admin.view-base :entity="$entity" :action="'update'">
    <x-adminlte-datatable id="table" :heads="$head" head-theme="dark" theme="light" striped bordered hoverable>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->firstanme !!}</td>
                <td>{!! $user->lastname !!}</td>
                <td>{!! $user->email !!}</td>
                <td>
                    <x-admin.index-actions :entity="$entity" :objectId="$customerUser->id" />
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
</x-admin.view-base>