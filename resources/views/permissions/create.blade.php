@extends('layouts.admin')

@section('content')
<!-- CREATE NEW USER-->
<div class="container">
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Create Role</h5>
        <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @error('name')
            <div class="alert alert-danger alert-dismissible" role="alert">
                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">x</span></span>
                {{ $message }}
            </div>
            @enderror
            @error('roles')
            <div class="alert alert-danger alert-dismissible" role="alert">
                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">x</span></span>
                {{ $message }}
            </div>
            @enderror

            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group"><label for="name" class="">Permissions Name</label><input
                            name="name" id="name" placeholder="Permissions name" type="text" class="form-control"
                            value="{{ old('name') }}">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group"><label for="category" class="">Assign a
                            role to this permission</label><br />
                        @if ($roles->count() < 1) <h4>No Roles available, please create roles</h4>
                            @elseif($roles->count() >= 1)
                            @foreach ($roles as $role)
                            <label class="form-check-label">
                                <input type="checkbox" value='{{ $role->id }}'
                                    name="roles[]">{{ ucfirst($role->name) }}
                            </label>
                            @endforeach
                            @endif
                    </div>
                </div>

            </div>
            <button type="submit" class="mt-2 btn btn-primary">Create Permission</button>
        </form>
    </div>
</div>
</div>
<!-- CREATE NEW USER-->
@endsection