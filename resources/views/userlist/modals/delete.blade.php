<div class="modal" id="deleteExpenseTypeModal" tabindex="-1">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                </svg>
                <h3>Are you sure?</h3>
                <div class="text-secondary deleteModalMessageField"></div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.users.destroy', ':id') }}" method="POST" class="w-100" id="deleteUserForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="user_id" id="deleteUserId">
                    <div class="w-100">
                        <div class="d-flex flex-wrap gap-2">
                            <div class="flex-fill">
                                <button class="btn w-100" data-bs-dismiss="modal"
                                    type="button">Cancel</button>
                            </div>
                            <div class="flex-fill">
                                <button class="btn btn-danger w-100" id="deleteModalSubmitButton">Delete User</button>
                                <button class="btn btn-danger w-100 deleteloadingButton" type="button"
                                    style="display: none" disabled>
                                    <span class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                    <span role="status" class="ps-2"> Deleting...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>