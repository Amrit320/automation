
<div class="modal" id="importUserModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="importUserForm" action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload File</label>
                        <input type="file" class="form-control" name="import_file" accept=".csv, .xlsx" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Format</label>
                        <div class="alert alert-info" role="alert">
                            Please upload a file in CSV or Excel format. <br>
                            Ensure that the column names match the required fields.
                        </div>
                    </div>

                    <div class="mb-0s text-end">
                        <a href="{{ asset('samples/user-excel-sheet-sample.csv') }}" class="btn btn-outline-primary btn-sm p-2 rounded-2" Download>
                            Download Sample CSV
                        </a>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-primary" id="importUserData">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 11l5 -5l5 5" />
                                <path d="M12 4v12" />
                            </svg> Import Data
                        </button>
                        <button class="btn btn-primary loadingButton" type="button" style="display: none" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status" class="ps-2"> Loading...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('importUserForm').addEventListener('submit', function(event) {
        let fileInput = document.querySelector('input[name="import_file"]');
        if (!fileInput.files.length) {
            alert("Please select a file before submitting.");
            event.preventDefault(); // Prevent form submission
            return;
        }

        document.getElementById('importUserData').style.display = 'none';
        document.querySelector('.loadingButton').style.display = 'block';
    });
</script>
