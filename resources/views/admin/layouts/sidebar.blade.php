<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Route::is('admin.dashboard.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('admin.dashboard.index',['tab'=>'my-dashboard'])}}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M4 20h14" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::is('admin.users.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">

                            </span>
                        </a>
                    </li>


                    <li class="nav-item {{ Route::is('admin.branch.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.branch.index') }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20.972 11.291a9 9 0 1 0 -8.322 9.686" />
                                    <path d="M3.6 9h16.8" />
                                    <path d="M3.6 15h8.9" />
                                    <path d="M11.5 3a17 17 0 0 0 0 18" />
                                    <path d="M12.5 3a16.986 16.986 0 0 1 2.578 9.018" />
                                    <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                    <path d="M19 18v.01" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Branch
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.department.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.department.index') }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Department
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::is('admin.expense.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.expense.index', ['expense' => 'unreported']) }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                    <path d="M9 7l4 0" />
                                    <path d="M9 11l4 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                My Expense
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::is('expense_report_route') || Route::is('team_expense_report') ? 'active' : '' }} dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M14 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Records
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('expense_report_route') }}" onclick="togglePageLoader();"> My Records </a>
                                    <a class="dropdown-item" href="{{ route('team_expense_report') }}" onclick="togglePageLoader();">Team Records</a>
                                </div>
                            </div>
                    </li>

                    <li class="nav-item {{ Route::is('expense_report_route') ? 'active' : '' }}">
                        <a class="nav-link {{ Route::is('expense_report_route') ? 'active' : '' }}" href="{{ route('expense_report_route') }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M14 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Records
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::is('expense_report_route') ? 'active' : '' }}">
                        <a class="nav-link {{ Route::is('all_expense_report') ? 'active' : '' }}" href="{{ route('all_expense_report') }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M14 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Records
                            </span>
                        </a>
                    </li>

                    <!-- Reimbursement tab -->


                    <li class="nav-item {{ Route::is('approval_list_route') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('approval_list_route') }}" onclick="togglePageLoader();">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-bank">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 21l18 0" />
                                    <path d="M3 10l18 0" />
                                    <path d="M5 6l7 -3l7 3" />
                                    <path d="M4 10l0 11" />
                                    <path d="M20 10l0 11" />
                                    <path d="M8 14l0 3" />
                                    <path d="M12 14l0 3" />
                                    <path d="M16 14l0 3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Reimbursement
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>