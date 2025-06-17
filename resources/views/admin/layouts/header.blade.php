<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark -navbar-horizontal pe-0 pe-md-3 p-2 ">
            <a href="#">
                <img src="{{ asset('admin/dist/img/labexpense-logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav me-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('/admin/users') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('/admin/createwebinar') }}">Webinars</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li> -->
            </ul>
        </div>

        <div class="navbar-nav flex-row order-md-last">
            <div class="d-md-flex">
                <div class="nav-item dropdown d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span class="badge bg-red text-white" id="notification-count">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card notiCard">
                            <div class="card-header">
                                <h3 class="card-title">Last updates</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable" id="notifications-container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm"></span>
                    <div class="d-xl-block ps-2">
                        <div>User</div>
                        <div class="mt-1 small text-secondary text-capitalize">Admin</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

    </div>
</header>