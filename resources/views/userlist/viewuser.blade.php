<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lab Expens - user profile</title>
    {{ view('admin.layouts.css') }}
</head>

<body>
    <!-- Main page container -->
    <div class="page">
        <!-- Header included via view -->
        {{ view('admin.layouts.header') }}

        <!-- Sidebar navigation included via view -->
        {{ view('admin.layouts.sidebar') }}

        <!-- Main content wrapper -->
        <div class="page-wrapper">
            <!-- Page header section - contains title and action buttons -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <!-- Page title -->
                        <div class="col-md-6">
                            <h2 class="page-title">
                                User Information
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content area -->
            <div class="page-body">
                <div class="container-xl">

                    <!-- User Detail -->
                    <!-- User Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Name</div>
                                    <div class="datagrid-content">{{ $user->first_name }} {{ $user->last_name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email</div>
                                    <div class="datagrid-content">{{ $user->email_id }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Mobile No</div>
                                    <div class="datagrid-content">{{ $user->mobile_no }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">
                                        <span class="status status-green">{{ $user->status }}</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Branch Name</div>
                                    <div class="datagrid-content">{{ $user->branch->branch_name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Employee ID</div>
                                    <div class="datagrid-content">{{ $user->emp_office_id }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Department</div>
                                    <div class="datagrid-content">{{ $user->department->department_name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Reporting Manager</div>
                                    <div class="datagrid-content">
                                        {{ optional($user->manager)->first_name }} {{ optional($user->manager)->last_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Information -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bank Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Account No</div>
                                    <div class="datagrid-content">{{ $user->account_number }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">IFSC</div>
                                    <div class="datagrid-content">{{ $user->receiver_ifsc }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Account Type</div>
                                    <div class="datagrid-content">{{ $user->receiver_ac_type }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Name In Bank</div>
                                    <div class="datagrid-content">{{ $user->name_in_bank }}</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--User expense detail -->
                    <div class="card" id="expense_card">
                        <div class="card-header border-bottom" id="expense_card_header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                @php
                                $expenseType = request()->get('expense', 'unreported'); // default to 'all'
                                @endphp
                                <li class="nav-item">
                                    <a href="#draft_report_tab" class="nav-link {{ $expenseType == 'unreported' ? 'active' : '' }}" data-bs-toggle="tab">Draft Reports</a>
                                </li>
                                <li class="nav-item d-flex flex-nowrap gap-2 align-items-center">

                                    <a href="#others_expense_tab" class="nav-link {{ $expenseType != 'unreported' ? 'active' : '' }} text-capitalize" data-bs-toggle="tab">
                                        {{ ucfirst(request()->get('expense') == null ? 'all' : request()->get('expense')) }} Expenses
                                    </a>
                                    <div class="dropdown">
                                        <a href="#" class="border-start dropdown-toggle p-2" data-bs-toggle="dropdown"></a>
                                        <div class="dropdown-menu dropdown-menu-arrow p-1">
                                            <a class="dropdown-item {{ request()->get('expense') == 'all' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'all']) }}">All Expense</a>
                                            <a class="dropdown-item {{ request()->get('expense') == 'submitted' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'submitted']) }}">Submitted Expense</a>
                                            <a class="dropdown-item {{ request()->get('expense') == 'draft' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'draft']) }}">Draft Expense</a>
                                            <a class="dropdown-item {{ request()->get('expense') == 'approved' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'approved']) }}">Approved Expense</a>
                                            <a class="dropdown-item {{ request()->get('expense') == 'disbursed' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'disbursed']) }}">Disbursed Expense</a>
                                            <a class="dropdown-item {{ request()->get('expense') == 'onhold' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'onhold']) }}">On Hold Expense</a>
                                            <a class="dropdown-item {{ request()->get('expense') == 'rejected' ? 'active' : '' }}" href="{{ route('admin.expense.index', ['expense' => 'rejected']) }}">Rejected Expense</a>

                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item addNewExpenseItem ms-auto">
                                    <!-- Desktop Link (hidden on mobile) -->
                                    <a href="{{ route('admin.expense.create') }}" class="btn btn-info addNewExpenseItemButton d-none d-md-inline-flex" title="Add Expense">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="12" y1="5" x2="12" y2="19" />
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                        </svg>
                                        Add New Expense
                                    </a>

                                    <!-- Mobile Link (hidden on desktop) -->
                                    <a href="{{ route('admin.expense.create.single') }}" class="btn btn-info addNewExpenseItemButton d-inline-flex d-md-none" title="Add Expense">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="12" y1="5" x2="12" y2="19" />
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                        </svg>
                                        Add New Expense
                                    </a>

                                </li>
                            </ul>
                        </div>
                        <div class="card-body px-2 px-md-3">
                            <div class="tab-content">

                                @php
                                $expenseTab = request()->get('expense', 'unreported'); // fallback to 'all' if not present
                                @endphp

                                <div class="tab-pane {{ $expenseTab == 'unreported' ? 'active show' : '' }}" id="draft_report_tab">

                                    @foreach ($formatted_reports as $formatted_report)
                                    <div class="card expenseCardItem mb-3" data-id="">
                                        <div class="card-body p-2 p-md-3">
                                            <a href="{{ route('report_detail_route', Crypt::encryptString($formatted_report['report_id'])) }}" class="content d-flex flex-wrap align-items-start gap-3 text-decoration-none text-black draft_report_item">
                                                <div class="top border-bottom d-flex flex-wrap justify-content-between gap-2 align-items-center w-100 pb-3">
                                                    <div class="left d-flex flex-nowrap gap-2 align-items-center">
                                                        {{-- <input type="checkbox" class="form-check-input selectReportCheckbox" value="{{ Crypt::encryptString($formatted_report['report_id']) }}" /> --}}
                                                        <label for="#selectReportCheckbox"><strong>{{ $formatted_report['report_title'] }}</strong> - #{{ $formatted_report['report_number'] }}</label>
                                                    </div>
                                                    <div class="right d-flex flex-nowrap align-items-center gap-3">
                                                        <span class="badge bg-yellow-lt">DRAFT</span>
                                                    </div>
                                                </div>
                                                <div class="bottom w-100">
                                                    <div class="report-content d-flex flex-wrap justify-content-between align-items-center gap-1">
                                                        <div class="bg-light d-flex flex-column flex-grow-1 p-2 rounded">
                                                            <small class="text-muted">Expense Duration</small>
                                                            <h4 class="m-0">{{ $formatted_report['report_date_range'] }}</h4>
                                                        </div>

                                                        <div class="bg-light d-flex flex-column flex-grow-1 p-2 rounded">
                                                            <small class="text-muted">No. Of Expenses</small>
                                                            <h4 class="m-0">{{ $formatted_report['expenses']['total_count'] }}</h4>
                                                        </div>
                                                        <div class="bg-light d-flex flex-column flex-grow-1 p-2 rounded">
                                                            <small class="text-muted">Total Amount</small>
                                                            <h4 class="m-0"><strong>Rs.{{ number_format($formatted_report['expenses']['total_amount']) }}</strong></h4>
                                                        </div>
                                                        <div class="bg-light d-flex flex-column flex-grow-1 p-2 rounded">
                                                            <small class="text-muted">Amount to be Reimbursed</small>
                                                            <h4 class="m-0"><strong>Rs.{{ number_format($formatted_report['expenses']['total_amount']) }}</strong></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                                <div class="tab-pane {{ $expenseTab != 'unreported' ? 'active show' : '' }}" id="others_expense_tab">

                                    <table class="table dataTableElement table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Expense Details</th>
                                                <th>Report No.</th>
                                                <th>Merchant</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th class="w-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reported as $reportedExpense)
                                            @foreach ($reportedExpense['expense_details'] as $expense_detail)
                                            @php
                                            $requestExpense = request()->get('expense');
                                            $shouldFilter = $requestExpense && $requestExpense !== 'all';
                                            @endphp

                                            @if (!$shouldFilter || $requestExpense === $reportedExpense['expense']->expenses_status)
                                            {{-- Your row data --}}
                                            <tr class="expense_item" data-id="{{ Crypt::encryptString($expense_detail['detail']->id) }}">
                                                <td>
                                                    <button width="50" height="50" class="btn p-0 d-block overflow-hidden" style="width: 50px !important;">
                                                        @php
                                                        $attachment = $expense_detail['detail']->attachment;
                                                        $extension = pathinfo($attachment, PATHINFO_EXTENSION);
                                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                        @endphp
                                                        <img width="50" height="50" class="viewFile" src="{{ asset('admin/static/placeholder.gif') }}" data-attachment="{{ $attachment }}" data-src="{{ $isImage ? asset('admin/uploads/expense_attachment/' . $attachment) : asset('admin/static/pdf-attachment.png') }}" title="View Attachment">
                                                    </button>
                                                </td>
                                                <td class="cursor-pointer">
                                                    <a href="{{ route('admin.expense.edit', Crypt::encryptString($expense_detail['detail']->id)) }}" class="row openEditExpense text-decoration-none">
                                                        <h3 class="text-primary m-0">{{ $reportedExpense['expense_type']->expense_type_name }}</h3>
                                                        <p class="m-0 text-secondary">{{ $expense_detail['field']->field_name }}</p>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-yellow-lt border">{{ $expense_detail['report_number'] ?? 'NULL' }}</span></td>
                                                <td>{{ $expense_detail['detail']->merchant }}</td>
                                                <td>{{ \Carbon\Carbon::parse($expense_detail['detail']->date)->format('D j M Y') }}</td>
                                                <td><strong>₹{{ number_format($expense_detail['detail']->amount, 2) }}</strong></td>
                                                <td><span class="badge bg-green-lt border text-uppercase">{{ $expense_detail['detail']->expenses_status }}</span></td>
                                                <td class="w-1">
                                                    @php $isDraft = $reportedExpense['expense']->expenses_status == 'draft'; @endphp
                                                    <button class="btn p-2 text-danger deleteExpenseOtherTab" {{ $isDraft ? '' : 'disabled' }} @if ($isDraft) data-id="{{ Crypt::encryptString($expense_detail['detail']->id) }}" @endif>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash m-0">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!-- Footer included via view -->
            {{ view('admin.layouts.footer') }}
        </div>
    </div>

    <!-- Common JavaScript imports -->
    {{ view('admin.layouts.scripts') }}

    <!-- Main application script -->
    <script src="{{ asset('admin/dist/js/main.js') }}" defer></script>

    <!-- Routes for AJAX requests -->

    <!-- User management specific script -->
    <script src="{{ asset('admin/dist/js/user.js') }}"></script>

    <!-- Bulk user selection and actions script -->

</body>

</html>