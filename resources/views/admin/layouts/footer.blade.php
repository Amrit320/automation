{{ view('admin.layouts.alert') }}
<div id="pageLoader" class="position-fixed justify-content-center align-items-center" style="display:none;z-index: 99999;width: 100%;height: 100vh;top: 0;left: 0;background: #ffffffb3;">
    <div class="container container-slim py-4 m-auto">
        <div class="text-center">
            <div class="text-primary mb-3">Loading Data</div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-indeterminate"></div>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; {{ date('Y') - 1 }} - {{ date('Y') }}
                        <a href="." class="link-secondary">Labindia</a>.
                        All rights reserved.
                    </li>
                    <!-- <li class="list-inline-item">
                        <a href="#" class="link-secondary" rel="noopener">
                            v1.0.0
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</footer>

{{-- Mobile Navs  --}}
@php
    $excludedRoutes = ['admin.expense.create', 'admin.expense.create.single', 'admin.expense.edit'];
@endphp

@unless (in_array(Route::currentRouteName(), $excludedRoutes))
    {{ view('admin.layouts.mobile_navs') }}
@endunless
