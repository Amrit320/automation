<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="view_first_name" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="view_last_name" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="view_email_id" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" id="view_role" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Department</label>
                        <select class="form-select" id="view_department_id" name="department_id" disabled>
                            <option value="">Select Department</option>
                            @foreach ($data['departments'] as $department)
                            <option value="{{ $department->department_id }}">
                                {{ $department->department_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Branch</label>
                        <input type="text" class="form-control" id="view_branch_name" readonly>
                        <input type="hidden" id="view_branch_id">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Manager</label>
                        <input type="text" class="form-control" id="view_manager" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" id="view_emp_id" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="view_status" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="view_account_number" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email Text</label>
                        <textarea class="form-control" id="view_email_body" readonly></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Debit Ac Number</label>
                        <input type="text" class="form-control" id="view_debit_ac_number" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">CRN Remark</label>
                        <input type="text" class="form-control" id="view_crn_remark" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Receiver IFSC</label>
                        <input type="text" class="form-control" id="view_receiver_ifsc" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Receiver Account Type</label>
                        <input type="text" class="form-control" id="view_receiver_ac_type" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Approved By</label>
                        <input type="text" class="form-control" id="view_approved_by" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Person Name In Bank</label>
                        <input type="text" class="form-control" id="view_name_in_bank" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Created At</label>
                        <input type="text" class="form-control" id="view_created_at" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Updated At</label>
                        <input type="text" class="form-control" id="view_updated_at" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>