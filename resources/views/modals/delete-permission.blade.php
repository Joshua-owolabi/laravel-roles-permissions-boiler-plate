<div class="modal fade " id="delete-roles-{{ $permission->id }}" tabindex="-1" role="dialog"
    aria-labelledby="delete-user" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content delete-modal">
            <form action="/permissions/delete" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="permission_id" value="{{$permission->id}}">
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="float-right mr-3 mt-1">&times;</span>
                </button>
                <div class="modal-body delete-modal__body">
                    <h1><i class="pe-7s-delete-user mt-2 delete-modal__icon"></i></h1>
                    <h3>You Should Read This</h3>
                    <p>Are you sure you want to delete this Permission, decide carefully !!!</p>
                </div>
                <div>
                    <button type="submit" class="btn delete-modal__btn float-left ml-4 mb-3">Delete Permission</button>
                    <button type="button" class="btn delete-modal__close float-right mr-4 mb-3 "
                        data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
