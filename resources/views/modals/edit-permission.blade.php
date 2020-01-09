<div class="modal fade " id="edit-roles-{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-user"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content profile-modal">
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="float-right mr-3 mt-1">&times;</span>
            </button>
            <div class="modal-body profile-modal__body">
                <form action="{{ route('updatePermission', $permission->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @error('name')
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">x</span></span>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="name" class="">Role
                                    Name</label><input name="name" id="name" type="text" class="form-control"
                                    value="{{ $permission->name }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-2 btn btn-primary">Update Role</button>
                </form>
            </div>
            <div>
                <button type="button" class="btn delete-modal__close float-right mr-4 mb-3 "
                    data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
