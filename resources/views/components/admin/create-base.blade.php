<x-admin-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <x-admin.index-header :entity="$entity" :action="'create'" :buttons="['index']"/>

                    <div class="card-body">
                    {{ $slot }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>