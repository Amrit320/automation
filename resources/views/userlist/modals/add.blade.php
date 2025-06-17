<!-- Modal -->
<div x-data="{ step: 1 }" class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-0">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Step Indicators -->
                    <ul class="nav nav-pills mb-4 justify-content-center">
                        <li class="nav-item">
                            <button type="button" class="nav-link" :class="{ 'active': step === 1 }" @click="step = 1">User Info</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" :class="{ 'active': step === 2 }" @click="step = 2">User Permissions</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" :class="{ 'active': step === 3 }" @click="step = 3">Bank Detail</button>
                        </li>
                    </ul>

                    <!-- Step 1 -->
                    <div x-show="step === 1" x-transition style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" id="mobile_no" name="mobile_no" class="form-control" required pattern="[0-9]{10,15}" oninput="checkMobile()" onblur="checkMobile()">
                                <small id="mobile-error" class="text-danger"></small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" id="email_id" name="email_id" class="form-control" required oninput="checkEmail()" onblur="checkEmail()">
                                <small id="email-error" class="text-danger"></small>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" minlength="8" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Employee ID</label>
                                <input type="text" id="emp_office_id" name="emp_office_id" class="form-control" required oninput="checkEmpId()" onblur="checkEmpId()">
                                <small id="empid-error" class="text-danger"></small>
                            </div>
                        </div>

                    </div>

                    <!-- Step 2 -->
                    <div x-show="step === 2" x-transition style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="employee">Employee</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="accounts">Accounts</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Branch</label>
                                <select name="branch_id" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($data['branchs'] as $b)
                                    <option value="{{ $b->branch_id }}">{{ $b->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Department</label>
                                <select name="department_id" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($data['departments'] as $d)
                                    <option value="{{ $d->department_id }}">{{ $d->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Manager</label>
                                <select name="manager_id" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($data['all_manager'] as $m)
                                    <option value="{{ $m->user_id }}">{{ $m->first_name }} {{ $m->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Approved By</label>
                                <select name="approved_by" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($data['all_manager'] as $m)
                                    <option value="{{ $m->user_id }}">{{ $m->first_name }} {{ $m->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div x-show="step === 3" x-transition style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="account_number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Debit Ac Number</label>
                                <input type="text" name="debit_ac_number" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Receiver IFSC</label>
                                <input type="text" name="receiver_ifsc" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Account Type</label>
                                <select name="receiver_ac_type" class="form-select">
                                    <option value="">Select</option>
                                    <option value="Saving">Saving</option>
                                    <option value="Current">Current</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Salary">Salary</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name in Bank</label>
                            <input type="text" name="name_in_bank" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="w-100 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <!-- Step Tracker -->
                        <div class="w-100 px-3 py-2 bg-light rounded d-none">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                                <div>
                                    <div class="d-flex align-items-center text-muted small fw-semibold gap-1">
                                        <span>STEP:</span><span x-text="step"></span><span class="text-muted">/3</span>
                                    </div>
                                    <div class="fw-bold">
                                        <template x-if="step === 1">Your Profile</template>
                                        <template x-if="step === 2">Work Details</template>
                                        <template x-if="step === 3">Bank Info</template>
                                    </div>
                                </div>
                                <div class="w-100 d-flex align-items-center mt-2 mt-sm-0" style="min-width: 160px;">
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            :style="{ width: step === 1 ? '33%' : step === 2 ? '66%' : '100%' }"></div>
                                    </div>
                                    <div class="ms-2 small text-muted" x-text="step === 1 ? '33%' : step === 2 ? '66%' : '100%'"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Step Buttons -->
                        <div class="w-100 d-flex flex-column flex-sm-row justify-content-end gap-2 mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary" :disabled="step === 1" @click="step--">Prev</button>
                            <button type="button" class="btn btn-outline-primary"
                                x-show="step < 3"
                                @click="validateCurrentStep()">
                                Next
                            </button>
                            <button type="submit" class="btn btn-success" x-show="step === 3">Create User</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function debounce(func, delay = 500) {
        let timeout;
        return function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, arguments), delay);
        };
    }

    function showError(selector, message) {
        $(selector).text(message);
    }

    function clearError(selector) {
        $(selector).text('');
    }

    function validateEmailFormat(email) {
        const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return pattern.test(email);
    }

    function validateMobileFormat(mobile) {
        const pattern = /^[0-9]{10,15}$/;
        return pattern.test(mobile);
    }

    const checkEmail = debounce(function() {
        const email = $('#email_id').val().trim();
        if (!email) return showError('#email-error', 'Email is required');
        if (!validateEmailFormat(email)) return showError('#email-error', 'Invalid email format');

        $.post('{{ route("validate.email") }}', {
            email_id: email,
            _token: '{{ csrf_token() }}'
        }).done(function(data) {
            data.exists ? showError('#email-error', 'Email already exists') : clearError('#email-error');
        }).fail(function() {
            showError('#email-error', 'Server error');
        });
    });

    const checkMobile = debounce(function() {
        const mobile = $('#mobile_no').val().trim();
        if (!mobile) return showError('#mobile-error', 'Phone number is required');
        if (!validateMobileFormat(mobile)) return showError('#mobile-error', 'Invalid phone number format');

        $.post('{{ route("validate.mobile") }}', {
            mobile_no: mobile,
            _token: '{{ csrf_token() }}'
        }).done(function(data) {
            data.exists ? showError('#mobile-error', 'Mobile already exists') : clearError('#mobile-error');
        }).fail(function() {
            showError('#mobile-error', 'Server error');
        });
    });

    const checkEmpId = debounce(function() {
        const empId = $('#emp_office_id').val().trim();
        if (!empId) return showError('#empid-error', 'Employee ID is required');

        $.post('{{ route("validate.empid") }}', {
            emp_office_id: empId,
            _token: '{{ csrf_token() }}'
        }).done(function(data) {
            data.exists ? showError('#empid-error', 'Employee ID already exists') : clearError('#empid-error');
        }).fail(function() {
            showError('#empid-error', 'Server error');
        });
    });

    // Alpine.js component for user modal
    document.addEventListener('alpine:init', () => {
        Alpine.data('addUserModal', () => ({
            step: 1,
            validateCurrentStep() {
                if (this.step === 1) {
                    const firstName = document.querySelector('input[name="first_name"]').value;
                    const lastName = document.querySelector('input[name="last_name"]').value;
                    const email = document.querySelector('input[name="email_id"]').value;
                    const mobile = document.querySelector('input[name="mobile_no"]').value;
                    const password = document.querySelector('input[name="password"]').value;
                    const empId = document.querySelector('input[name="emp_office_id"]').value;

                    if (!firstName || !lastName || !email || !mobile || !password || !empId) {
                        return false;
                    }

                    if ($('#email-error').text() || $('#mobile-error').text() || $('#empid-error').text()) {
                        return false;
                    }

                    this.step++;
                    return true;
                } else if (this.step === 2) {
                    const role = document.querySelector('select[name="role"]').value;
                    const branch = document.querySelector('select[name="branch_id"]').value;
                    const department = document.querySelector('select[name="department_id"]').value;
                    const manager = document.querySelector('select[name="manager_id"]').value;
                    const approvedBy = document.querySelector('select[name="approved_by"]').value;

                    if (!role || !branch || !department || !manager || !approvedBy) {
                        return false;
                    }

                    this.step++;
                    return true;
                }
                return true;
            }
        }))
    });

    // Manual validation method
    window.addEventListener('DOMContentLoaded', () => {
        window.validateCurrentStep = function() {
            const step = Alpine.$data(document.getElementById('addUserModal')).step;

            if (step === 1) {
                const firstName = document.querySelector('input[name="first_name"]').value;
                const lastName = document.querySelector('input[name="last_name"]').value;
                const email = document.querySelector('input[name="email_id"]').value;
                const mobile = document.querySelector('input[name="mobile_no"]').value;
                const password = document.querySelector('input[name="password"]').value;
                const empId = document.querySelector('input[name="emp_office_id"]').value;

                if (!firstName || !lastName || !email || !mobile || !password || !empId) {
                    return false;
                }

                if ($('#email-error').text() || $('#mobile-error').text() || $('#empid-error').text()) {
                    return false;
                }

                Alpine.$data(document.getElementById('addUserModal')).step += 1;
                return true;
            } else if (step === 2) {
                const role = document.querySelector('select[name="role"]').value;
                const branch = document.querySelector('select[name="branch_id"]').value;
                const department = document.querySelector('select[name="department_id"]').value;
                const manager = document.querySelector('select[name="manager_id"]').value;
                const approvedBy = document.querySelector('select[name="approved_by"]').value;

                if (!role || !branch || !department || !manager || !approvedBy) {
                    return false;
                }

                Alpine.$data(document.getElementById('addUserModal')).step += 1;
                return true;
            }
            return true;
        };
    });

    // Bind input events
    $(document).ready(function() {
        $('#email_id').on('input', checkEmail);
        $('#mobile_no').on('input', checkMobile);
        $('#emp_office_id').on('input', checkEmpId);
    });
</script>