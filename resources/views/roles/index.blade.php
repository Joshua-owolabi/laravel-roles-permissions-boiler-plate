@extends('layouts.admin')

@section('content')
    
<!-- ALL ROLES TABLE-->
<div class="container text-center mt-5">
    <h3>All Roles Table</h3>
<table class="table table-dark table-hover">
    <thead>
      <tr>
        <th scope="col">S/N</th>
        <th scope="col">Roles</th>
        <th scope="col">Permissions</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>
    <tbody>
        @if ($roles->count() >= 1)
            @foreach ($roles as $role)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ ucfirst($role->name) }}</td>
                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name'))}}</td>
                <td> 
                    <div class="dropdown d-inline-block">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                        class="mb-2 mr-2  btn btn-success"><i class="fa fa-ellipsis-v"></i></button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"
                        x-placement="bottom-start"
                        style="position: absolute; transform: translate3d(-196px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                        
                        <button type="button" tabindex="0" class="dropdown-item" data-toggle="modal"
                            data-target="#edit-roles-{{ $role->id }}">Edit Roles</button>

                        <button type="button" tabindex="0" class="dropdown-item" data-toggle="modal"
                            data-target="#delete-roles-{{ $role->id }}">Delete
                            Roles
                        </button>
                    </div>
                </div></td>
              </tr>
            @endforeach
        @endif
      
    </tbody>
  </table>
  @foreach($roles as $role)
    @include('modals.edit-role')
    @include('modals.delete-role')
  @endforeach
</div>
<!-- ALL ROLES TABLE-->
@endsection