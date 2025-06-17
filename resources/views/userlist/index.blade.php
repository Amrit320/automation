<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lab Expense - Dashboard</title>
    {{ view('admin.layouts.css') }}

    <style>
        #dataTableElement_wrapper {
            padding: 10px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-input {
            width: 100%;
            height: 40px;
            padding: 0 36px;
            font-size: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            /* background: var(--bg-input); */
            color: var(--text-main);
            transition: all 0.2s ease;
        }

        .form-input::-moz-placeholder {
            color: var(--text-secondary);
        }

        .form-input::placeholder {
            color: var(--text-secondary);
        }

        .input-icon {
            position: absolute;
            left: 12px;
            width: 16px;
            height: 16px;
            color: var(--text-secondary);
            pointer-events: none;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            display: flex;
            align-items: center;
            padding: 4px;
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .eye-icon {
            width: 16px;
            height: 16px;
        }



        .user-row.selectable:hover {
            cursor: pointer;
            background-color: #f1f5f9;
        }

        .user-row.selected {
            background-color: #c6f6d5 !important;
        }

        table.dataTableElement tr.user-row.selected {
            background-color: #a2caf1 !important;
            border-left: 4px solid #F76707;
            transition: background-color 0.3s ease;
        }

        table.dataTable>tbody>tr.selected>* {
            box-shadow: inset 0 0 0 9999px rgba(13, 109, 253, 0) !important;
            box-shadow: inset 0 0 0 9999px rgba(var(--dt-row-selected), 0.9);
            color: rgb(10, 10, 10);
            color: black;
        }

        .selected-section {
            padding: 0.5rem;
            border: dashed 1px #0f63b5 !important;
            border-radius: 0.5rem;
        }

        #bulkActionsContainer {
            transition: all 0.3s ease;
        }

        #bulkActionsContainer.selected-section {
            border: 1px dashed #0f63b5 !important;
            background-color: #fff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .form-check-label {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-outline-secondary {
            border-color: #6b7280;
            color: #6b7280;
        }

        .btn-outline-secondary:hover {
            background-color: #6b7280;
            color: #fff;
        }

        .text-muted {
            font-size: 0.85rem;
        }

        .user-row td a {
            text-decoration: none !important;
        }

        .user-row td input {
            border: 1px solid #3175B7;
        }

        .user-row td input {
            border: 1px solid #3175B7;
        }

        @media (max-width: 480px) {
            .flex-direction-mobile {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Main page container -->
    <div class="page">
        <!-- Header included via view -->
        {{ view('admin.layouts.header') }}

        <!-- Sidebar navigation included via view -->
        {{ view('admin.layouts.sidebar') }}
        @php
        $role = Session::get('user')->role;
        @endphp
        <!-- Main content wrapper -->
        <div class="page-wrapper">
            <!-- Page header section - contains title and action buttons -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <!-- Page title -->
                        <div class="col-md-6">
                            <h2 class="page-title">
                                {{ $role !== 'manager' ? 'Users' : 'Team' }} List
                            </h2>
                        </div>

                        <!-- Action buttons container -->
                        @if ($role !== 'manager')
                        <div class="col-md-6 d-flex gap-2 flex-direction-mobile justify-content-end">
                            <!-- Add new user button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Add New User
                            </button>

                            <!-- Export button (currently hidden) -->
                            <button type="button" class="btn btn-warning d-none" data-bs-toggle="modal" data-bs-target="#exportUserModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 11l5 5l5 -5" />
                                    <path d="M12 4l0 12" />
                                </svg>
                                Export
                            </button>

                            <!-- Import button -->
                            <button type="button" class="btn btn btn-info" data-bs-toggle="modal" data-bs-target="#importUserModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 11l5 5l5 -5" />
                                    <path d="M12 4l0 12" />
                                </svg>
                                Import
                            </button>
                        </div>
                        @endif


                        <!-- Bulk action controls container -->
                        <div class="container-xl d-print-none">
                            <div class="container-xl p-0 mt-4">
                                <div class="container-fluid p-0">
                                    <div class="row g-2 align-items-end">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center" id="bulkActionsContainer">

                                            <!-- Select All and Selection Count -->
                                            <div class="select-all d-none" id="selectAllContainer">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div class="select-all-container d-flex">
                                                        <input class="form-check-input me-2" type="checkbox" id="selectAllCheckbox">
                                                        <label class="form-check-label text-muted" for="selectAllCheckbox">Select All</label>
                                                    </div>
                                                    <div id="selectionCountStatus" class="text-muted">
                                                        Number of User Selected: <span id="selectionCountNumber">0</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bulk Actions Section -->
                                            <div class="activations d-flex align-items-center gap-2">
                                                <div id="bulkSelectionStatus" class="d-none badge bg-info-lt py-2 px-3">
                                                    Selected: <span id="bulkSelectedCount">0</span> user(s)
                                                </div>

                                                <div id="bulkActions" class="d-none d-flex gap-2 align-items-center">
                                                    <select id="bulkStatus" class="form-select w-auto">
                                                        <option value="">Change status to...</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                        <option value="blocked">Blocked</option>
                                                    </select>

                                                    <button id="applyBulkBtn" class="btn btn-primary" onclick="applyBulkStatus()">Apply</button>
                                                    <button id="cancelBulkBtn" class="btn btn-outline-secondary" onclick="cancelBulkSelection()">Cancel</button>
                                                </div>

                                                <button type="button" class="btn btn-warning d-none" id="ExportUsers" data-bs-toggle="modal" data-bs-target="#exportUserModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                    Export
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Main content area -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-2">
                                    <!-- User data table -->
                                    <table class="table dataTableElement">
                                        <thead>
                                            <tr>
                                                <th class="w-1">
                                                    <!-- Checkbox column header -->
                                                </th>
                                                <th class="w-1">Sr No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Manager Name</th>
                                                <th>Department Name</th>
                                                <th>Branch Name</th>
                                                <th>Role</th>
                                                <th>Created on</th>
                                                <th>status</th>
                                                @if ($role !== 'manager')
                                                <th colspan="2">Action</th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                            $count = 1;
                                            $user = Session::get('user');
                                            @endphp

                                            <!-- User rows - Manager view -->
                                            @foreach ($data['users'] as $singleuser)
                                            @role('manager')
                                            @if ($singleuser->manager_id == $user->user_id)
                                            <tr class="user-row" data-user-id="{{ $singleuser->user_id }}">
                                                <!-- Selection checkbox -->
                                                <td>
                                                    <input class="form-check-input user-checkbox" type="checkbox" data-user-id="{{ $singleuser->user_id }}">
                                                </td>
                                                <td>{{ $count++ }}</td>
                                                <!-- User name with view modal link -->
                                                <td><a href="javascript:void(0)" onclick="openViewModal('{{ $singleuser->user_id }}')">{{ Str::title($singleuser->first_name) . ' ' . Str::title($singleuser->last_name) }}</a></td>
                                                <td>{{ $singleuser->email_id }}</td>
                                                <td>{{ Str::title($singleuser->manager_name) }}</td>
                                                <td>{{ Str::title($singleuser->department_name) }}</td>
                                                <td>{{ Str::title($singleuser->branch_name) }}</td>
                                                <td>{{ Str::title($singleuser->role) }}</td>
                                                <td>{{ $singleuser->created_at ? date('d M Y', strtotime($singleuser->created_at)) : '' }}</td>
                                                <!-- Status badge -->
                                                <td>
                                                    @if ($singleuser->status == 'active')
                                                    <span class="badge bg-green-lt">ACTIVE</span>
                                                    @elseif($singleuser->status == 'inactive')
                                                    <span class="badge bg-yellow-lt">INACTIVE</span>
                                                    @else
                                                    <span class="badge bg-red-lt">BLOCKED</span>
                                                    @endif
                                                </td>
                                                <!-- Action buttons -->
                                                @if ($role !== 'manager')
                                                <td class="sort-action">
                                                    <div class="d-flex flex-nowrap gap-2">
                                                        <!-- Edit button -->
                                                        <button class="btn btn-outline-warning px-2 py-1 rowEditButton" onclick="openEditModal('{{ $singleuser->user_id }}')">
                                                            ✏️
                                                        </button>
                                                        <!-- Delete button -->
                                                        <button type="button" class="btn btn-outline-danger px-2 py-1 rowDeleteButton1" onclick="updateUserStatus('{{ $singleuser->user_id }}', true)">
                                                            🗑️
                                                        </button>
                                                    </div>
                                                </td>
                                                <td></td>
                                                @endif

                                            </tr>
                                            @endif
                                            @endrole

                                            <!-- User rows - Admin view -->
                                            @role(['admin', 'superAdmin'])
                                            <tr class="user-row" data-user-id="{{ $singleuser->user_id }}">
                                                <!-- Selection checkbox -->
                                                <td class="p-3">
                                                    <input class="form-check-input user-checkbox" type="checkbox" data-user-id="{{ $singleuser->user_id }}">
                                                </td>
                                                <td class="text-center">{{ $count++ }}</td>
                                                <!-- User name with view modal link -->
                                                {{--<td><a href="" onclick="openViewModal('{{ $singleuser->user_id }}')">{{ Str::title($singleuser->first_name) . ' ' . Str::title($singleuser->last_name) }}</a></td>--}}
                                                <td><a href="{{ route('admin.users.userProfile', $singleuser->user_id) }}">{{ Str::title($singleuser->first_name) . ' ' . Str::title($singleuser->last_name) }}</a></td>
                                                <td>{{ $singleuser->email_id }}</td>
                                                <td>{{ Str::title($singleuser->manager_name) }}</td>
                                                <td>{{ Str::title($singleuser->department_name) }}</td>
                                                <td>{{ Str::title($singleuser->branch_name) }}</td>
                                                <td>{{ Str::title($singleuser->role) }}</td>
                                                <td>{{ $singleuser->created_at ? date('d M Y', strtotime($singleuser->created_at)) : '' }}</td>
                                                <!-- Status dropdown (for admins) -->
                                                <td>
                                                    <select name="status" class="form-select w-auto" id="user_status_{{ $singleuser->user_id }}" onchange="updateUserStatus('{{ $singleuser->user_id }}')">
                                                        <option value="inactive" {{ $singleuser->status == 'inactive' ? 'Selected' : '' }}>Inactive</option>
                                                        <option value="active" {{ $singleuser->status == 'active' ? 'Selected' : '' }}>Active</option>
                                                        <option value="blocked" {{ $singleuser->status == 'blocked' ? 'Selected' : '' }}>Blocked</option>
                                                    </select>
                                                </td>
                                                <!-- Action buttons -->
                                                <td class="sort-action">
                                                    <div class="d-flex flex-nowrap gap-2">
                                                        <!-- Edit button -->
                                                        <button class="btn btn-outline-warning px-2 py-1 rowEditButton" onclick="openEditModal('{{ $singleuser->user_id }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon m-0">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                            </svg>
                                                        </button>
                                                        <!-- Delete button -->
                                                        <button type="button" class="btn btn-outline-danger px-2 py-1 rowDeleteButton1" onclick="updateUserStatus('{{ $singleuser->user_id }}', true)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon m-0">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            @endrole
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include modal components -->
            @include('admin.userlist.modals.add')
            @include('admin.userlist.modals.edit')
            @include('admin.userlist.modals.view')
            @include('admin.userlist.modals.delete')
            @include('admin.userlist.modals.export')
            @include('admin.userlist.modals.import')

            <!-- Footer included via view -->
            {{ view('admin.layouts.footer') }}
        </div>
    </div>

    <!-- Common JavaScript imports -->
    {{ view('admin.layouts.scripts') }}

    <!-- Main application script -->
    <script src="{{ asset('admin/dist/js/main.js') }}" defer></script>

    <!-- Routes for AJAX requests -->
    <script>
        var route = {
            showuser: "{{ route('admin.users.show', ':id') }}",
            updatestatus: "{{ route('admin.users.updateStatus', ':id') }}",

        };
    </script>

    <!-- User management specific script -->
    <script src="{{ asset('admin/dist/js/user.js') }}"></script>






    <!-- Bulk user selection and actions script -->
    <script>
        // Track selected users
        let selectedUsers = [];

        // DOM element references
        const selectionStatus = document.getElementById('selectionStatus');
        const selectedCount = document.getElementById('selectedCount');
        const bulkActions = document.getElementById('bulkActions');
        const bulkActionsContainer = document.getElementById('bulkActionsContainer');
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const selectAllContainer = document.getElementById('selectAllContainer');
        const ExportUsers = document.getElementById('ExportUsers');


        // Debugging function
        function debugLog(message) {
            console.log(`[Bulk Selection Debug] ${message}`);
        }

        // Handle "Select All" checkbox
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            debugLog(`Select All checkbox changed: ${isChecked}`);

            const table = $('.dataTableElement').DataTable();
            selectedUsers = [];

            if (isChecked) {
                // Select all visible rows
                table.rows().every(function() {
                    const row = this.node();
                    const userId = $(row).data('user-id');
                    const checkbox = $(row).find('.user-checkbox');

                    checkbox.prop('checked', true);
                    $(row).addClass('selected');
                    if (!selectedUsers.includes(userId)) {
                        selectedUsers.push(userId);
                    }
                });
            } else {
                // Deselect all rows
                table.rows().every(function() {
                    const row = this.node();
                    const checkbox = $(row).find('.user-checkbox');

                    checkbox.prop('checked', false);
                    $(row).removeClass('selected');
                });
                selectedUsers = [];
            }

            updateSelectionUI();
        });

        // Handle individual user checkbox clicks
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                e.stopPropagation();
                const userId = this.getAttribute('data-user-id');
                const row = this.closest('.user-row');

                if (this.checked) {
                    // Add user to selection
                    if (!selectedUsers.includes(userId)) {
                        selectedUsers.push(userId);
                        row.classList.add('selected');
                        debugLog(`User ${userId} selected`);
                    }
                } else {
                    // Remove user from selection
                    selectedUsers = selectedUsers.filter(id => id !== userId);
                    row.classList.remove('selected');
                    debugLog(`User ${userId} deselected`);
                }

                // Update "Select All" checkbox state
                const table = $('.dataTableElement').DataTable();
                const totalRows = table.rows().count();
                const checkedCount = selectedUsers.length;
                selectAllCheckbox.checked = checkedCount === totalRows && totalRows > 0;

                updateSelectionUI();
            });
        });

        // Update selection UI based on selected users
        function updateSelectionUI() {
            if (!selectionCountNumber || !bulkSelectedCount || !selectionCountStatus || !bulkSelectionStatus || !ExportUsers) {
                console.error('Some selection elements not found');
                return;
            }

            const selectedCount = selectedUsers.length;

            // Update numbers
            selectionCountNumber.textContent = selectedCount;
            bulkSelectedCount.textContent = selectedCount;

            if (selectedCount > 0) {
                selectionCountStatus.classList.remove('d-none');
                bulkSelectionStatus.classList.remove('d-none');
                bulkActions.classList.remove('d-none');
                selectAllContainer.classList.remove('d-none');
                ExportUsers.classList.remove('d-none');
                bulkActionsContainer.classList.add('selected-section', 'p-2', 'bg-light', 'rounded-3');
            } else {
                selectionCountStatus.classList.add('d-none');
                bulkSelectionStatus.classList.add('d-none');
                bulkActions.classList.add('d-none');
                selectAllContainer.classList.add('d-none');
                ExportUsers.classList.add('d-none'); // <== Now it hides properly
                bulkActionsContainer.classList.remove('selected-section', 'p-2', 'bg-light', 'rounded-3');
            }
        }

        // Cancel bulk selection
        function cancelBulkSelection() {
            selectedUsers = [];
            const table = $('.dataTableElement').DataTable();
            table.rows().every(function() {
                const row = this.node();
                const checkbox = $(row).find('.user-checkbox');
                checkbox.prop('checked', false);
                $(row).removeClass('selected');
            });
            selectAllCheckbox.checked = false;
            debugLog('Bulk selection cancelled');
            updateSelectionUI();
        }

        // Apply bulk status update to selected users
        function applyBulkStatus() {
            const status = document.getElementById('bulkStatus').value;
            if (!status) {
                showAlert("Please select a status to apply.", 'error');
                return;
            }

            if (selectedUsers.length === 0) {
                showAlert("No users selected.");
                return;
            }

            debugLog(`Applying status ${status} to ${selectedUsers.length} users`);

            // Send AJAX request to update user statuses
            fetch("{{ route('users.bulk-update-status') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        user_ids: selectedUsers,
                        status: status
                    })
                })
                .then(async response => {
                    const contentType = response.headers.get("content-type");
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status);
                    }
                    if (contentType && contentType.includes("application/json")) {
                        return await response.json();
                    } else {
                        throw new Error("Expected JSON, got HTML");
                    }
                })
                .then(data => {
                    if (data.success) {
                        let message = 'Status updated successfully!';
                        if (status === 'active') {
                            message += ' Activation emails sent.';
                        }
                        showAlert(message, 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showAlert(data.message || 'Failed to update status.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error in applyBulkStatus:', error);
                    showAlert('Something went wrong. Please check the console or try again later.', 'error');
                });
        }

        // Reapply selected states on DataTable page change
        $(document).ready(function() {
            const table = $('.dataTableElement').DataTable();
            table.on('draw', function() {
                // Re-apply selected state to rows after table redraw
                table.rows().every(function() {
                    const row = this.node();
                    const userId = $(row).data('user-id');
                    const checkbox = $(row).find('.user-checkbox');

                    if (selectedUsers.includes(userId)) {
                        checkbox.prop('checked', true);
                        $(row).addClass('selected');
                    } else {
                        checkbox.prop('checked', false);
                        $(row).removeClass('selected');
                    }
                });
                updateSelectionUI();
            });
        });

        // Update the export modal when it's shown
        $('#exportUserModal').on('show.bs.modal', function() {
            // Pass selected users to the form
            $('#selectedUsersInput').val(JSON.stringify(selectedUsers));
            $('#selectedUsersCount').text(selectedUsers.length);

            // Pre-select "All Fields" option when exporting selected users
            if ($('input[name="export_type"]:checked').val() === 'selected') {
                $('#multipleSelectOptions option[value="all"]').prop('selected', true);
            }

            // Initialize with correct display for date range
            toggleDateRangeVisibility();
        });

        // Toggle date range visibility based on export type selection
        $('input[name="export_type"]').change(function() {
            toggleDateRangeVisibility();
        });

        function toggleDateRangeVisibility() {
            if ($('input[name="export_type"]:checked').val() === 'date_range') {
                $('#dateRangeContainer').show();
                $('#fromDateInput').prop('required', true);
                $('#toDateInput').prop('required', true);
            } else {
                $('#dateRangeContainer').hide();
                $('#fromDateInput').prop('required', false);
                $('#toDateInput').prop('required', false);
            }
        }


        // Update the export modal when it's shown
        $('#exportUserModal').on('show.bs.modal', function() {
            // Pass selected users to the form
            $('#selectedUsersInput').val(JSON.stringify(selectedUsers));
            $('#selectedUsersCount').text(selectedUsers.length);

            // Initialize with correct display for date range
            toggleDateRangeVisibility();
        });

        // Toggle date range visibility based on export data type
        $('input[name="export_data_type"]').change(function() {
            toggleDateRangeVisibility();
        });

        function toggleDateRangeVisibility() {
            const exportType = $('input[name="export_data_type"]:checked').val();
            if (exportType === 'user_expenses') {
                $('#dateRangeContainer').show();
                $('#fromDateInput').prop('required', true);
                $('#toDateInput').prop('required', true);
            } else {
                $('#dateRangeContainer').hide();
                $('#fromDateInput').prop('required', false);
                $('#toDateInput').prop('required', false);
            }
        }


        // Initialize UI on page load
        debugLog('Initializing UI');
        updateSelectionUI();


        document.addEventListener('DOMContentLoaded', function() {
            const exportDetailsRadio = document.getElementById('exportDetails');
            const exportExpensesRadio = document.getElementById('exportExpenses');
            const fromDateInput = document.getElementById('fromDateInput');
            const toDateInput = document.getElementById('toDateInput');

            function toggleDateRangeRequired() {
                if (exportDetailsRadio.checked) {
                    // User Details selected: Remove required attribute
                    fromDateInput.removeAttribute('required');
                    toDateInput.removeAttribute('required');
                    // Optionally clear the date inputs
                    fromDateInput.value = '';
                    toDateInput.value = '';
                    // Optionally disable the inputs to prevent user input
                    fromDateInput.disabled = true;
                    toDateInput.disabled = true;
                } else {
                    // User Expenses selected: Add required attribute
                    fromDateInput.setAttribute('required', 'required');
                    toDateInput.setAttribute('required', 'required');
                    // Enable the inputs
                    fromDateInput.disabled = false;
                    toDateInput.disabled = false;
                }
            }

            // Initial state
            toggleDateRangeRequired();

            // Add event listeners for radio button changes
            exportDetailsRadio.addEventListener('change', toggleDateRangeRequired);
            exportExpensesRadio.addEventListener('change', toggleDateRangeRequired);
        });
    </script>



</body>

</html>