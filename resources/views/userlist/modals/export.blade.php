<div class="modal modal-blur fade" id="exportUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="exportUsersForm" action="{{ route('admin.users.export') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Export Type -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold">Export Type</label>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="export_data_type" value="user_details" id="exportDetails" checked>
                                    <label class="form-check-label" for="exportDetails">User Details</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="export_data_type" value="user_expenses" id="exportExpenses">
                                    <label class="form-check-label" for="exportExpenses">User Expenses</label>
                                </div>
                            </div>
                        </div>

                        <!-- File Format -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold">File Format</label>
                            <select class="form-select" name="file_type" required>
                                <option value="csv">CSV (csv)</option>
                                <!-- <option value="docx">Document (docx)</option> -->
                            </select>
                        </div>

                        <!-- Selected Users Info -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Selected Users</label>
                            <p class="text-muted mb-1">Number of users selected: <span id="selectedUsersCount" class="fw-semibold">0</span></p>
                            <input type="hidden" name="selected_users" id="selectedUsersInput">
                        </div>

                        <!-- Date Range -->
                        <div class="col-12" id="dateRangeContainer">
                            <label class="form-label fw-bold">Date Range</label>
                            <div class="row g-2">
                                <div class="col-12 col-md-6">
                                    <input type="date" class="form-control" name="from_date" id="fromDateInput">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="date" class="form-control" name="to_date" id="toDateInput">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>