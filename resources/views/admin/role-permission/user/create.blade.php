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
                        <form action="{{ route('admin.user.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                                <small>The user may have alphanumeric with upper and lower case, also can accept the special char "-"</small>
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}"/>
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>