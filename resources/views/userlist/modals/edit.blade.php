<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" class="modern-form" action="{{ route('admin.users.update', ':id') }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="edit_first_name" class="form-label required">First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_last_name" class="form-label required">Last Name </label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_email_id" class="form-label required">Email </label>
                            <input type="email" class="form-control" id="edit_email_id" name="email_id" required>
                            <small id="emailFeedback" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="edit_role" class="form-label required">Role</label>
                            @php
                            $user = Session::get('user');
                            @endphp
                            @role(['superAdmin','admin','manager','accounts','employee'])
                            <select class="form-select" id="edit_role" name="role"
                                {{ $user->role == 'manager' || $user->role == 'accounts' ? 'disabled' : '' }} required>
                                <option value="">Select Role</option>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="accounts">Accounts</option>
                                <option value="superAdmin">Super Admin</option>
                            </select>
                            @endrole

                            @role(['admin','manager','accounts','employee'])
                            <select class="form-select" id="edit_role" name="role"
                                {{ $user->role == 'manager' || $user->role == 'accounts' ? 'disabled' : '' }} required>
                                <option value="">Select Role</option>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="accounts">Accounts</option>
                            </select>
                            @endrole


                        </div>

                        <div class="col-md-4">
                            <label for="edit_mobile_no" class="form-label required">Mobile No </label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
                            <small id="emailFeedback" class="form-text"></small>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <!-- <div class="col-md-4">
                            <label for="edit_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div> -->
                        <div class="col-md-4">
                            <label for="password" class="form-label required">Password </label>
                            <div class="input-wrapper" id="passchecker">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-lock input-icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                </svg>

                                <input name="password" placeholder="Enter your Password"
                                    class="form-input passwordInput" type="password" minlength="8" maxlength="16" id="edit_password" />
                                <button class="password-toggle" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye eye-icon"
                                        style="display: inline">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off eye-icon"
                                        style="display: none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                        <path
                                            d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                        <path d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            <small id="passFeedback" class="form-text"></small>
                        </div>

                        <div class="col-md-4">
                            <label for="edit_branch_id" class="form-label required">Branch </label>
                            <select class="form-select" id="edit_branch_id" name="branch_id" required>
                                <option value="">Select Branch</option>
                                @foreach ($data['branchs'] as $branch)
                                <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_department_id" class="form-label required">Department </label>
                            <select class="form-select" id="edit_department_id" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach ($data['departments'] as $department)
                                <option value="{{ $department->department_id }}">
                                    {{ $department->department_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label for="edit_emp_office_id" class="form-label">Employee Number</label>
                            <input type="text" class="form-control" id="edit_emp_office_id" name="emp_office_id">
                            <small id="empIdFeedback" class="form-text"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_manager_id" class="form-label">Manager</label>
                            <select class="form-select" id="edit_manager_id" name="manager_id">
                                <option value="">Select Manager</option>
                                @foreach ($data['all_manager'] as $manager)
                                <option value="{{ $manager->user_id }}">
                                    {{ $manager->first_name . ' ' . $manager->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_account_number" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="edit_account_number"
                                name="account_number">
                        </div>

                    </div>
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label for="edit_receiver_ac_type" class="form-label">Receiver Account
                                Type</label>
                            <select class="form-select" id="edit_receiver_ac_type" name="receiver_ac_type">
                                <option value="">Select Ac Type</option>
                                <option value="Saving">Saving</option>
                                <option value="Current">Current</option>
                                <option value="Personal">Personal</option>
                                <option value="Salary">Salary</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="edit_debit_ac_number" class="form-label">Debit Ac Number</label>
                            <input type="text" class="form-control" id="edit_debit_ac_number"
                                name="debit_ac_number">
                        </div>
                        <div class="col-md-4">
                            <label for="edit_receiver_ifsc" class="form-label">Receiver IFSC</label>
                            <input type="text" class="form-control" id="edit_receiver_ifsc" name="receiver_ifsc">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_approved_by" class="form-label">Approved By</label>
                            <select class="form-select" id="edit_approved_by" name="approved_by">
                                <option value="">Select approval manager</option>
                                @foreach ($data['all_manager'] as $manager)
                                <option value="{{ $manager->user_id }}">
                                    {{ $manager->first_name . ' ' . $manager->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_name_in_bank" class="form-label">Person Name In Bank</label>
                            <input type="text" class="form-control" id="edit_name_in_bank" name="name_in_bank">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-warning submitButton"
                            id="updateUserBtn">Update</button>
                        <button class="btn btn-warning loadingButton" type="button" style="display: none" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status" class="ps-2"> Loading...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>