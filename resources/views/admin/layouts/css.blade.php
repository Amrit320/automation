<!-- CSS files -->
<link href="{{ asset('admin/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('admin/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('admin/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('admin/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('admin/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('admin/dist/css/alert.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/dist/css/mobile_navs.css') }}" rel="stylesheet" />
{{-- Datepicker Range --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
{{-- MULTIPLE SELECT DROPDOWN  --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- DATATABLE CDN  --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

{{-- FAVICON  --}}
<link rel="icon" href="{{ asset('admin/dist/img/favicon.ico') }}" type="image/png">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }

    .pagination li a {
        min-width: 1.75rem;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        padding: 4px;
        gap: 5px;
    }

    .pagination li.active a {
        background-color: #0054a6;
        color: white;
    }

    .dt-length,
    .dt-search {
        display: flex;
        flex-direction: row;
        gap: 5px;
        flex-wrap: nowrap;
        align-items: center
    }

    div.dt-container .dt-paging .dt-paging-button {
        font-size: 0.8rem
    }

    div.dt-container .dt-paging .dt-paging-button:hover,
    div.dt-container .dt-paging .dt-paging-button.disabled:hover,
    div.dt-container .dt-paging .dt-paging-button.current:hover {
        background: #0054a6 !important;
        color: white !important;
        border: 1px solid #0054a6;
    }

    .dt-layout-cell.dt-layout-full {
        overflow: auto;
    }

    .mark-as-seen {
        text-decoration: none !important;
    }

    .notiCard {
        width: 450px;
        max-width: 100%;
    }

    #notifications-container {
        max-height: 400px;
        overflow-y: auto;
    }

    .list-group-item:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    #notification-count {
        color: #fff;
    }

    /* SELECT 2 CSS  */
    .select2-container--default .select2-selection--single {
        border: 1px solid #dadfe5;
        height: 40px;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 39px;
    }

    .select2-container {
        width: 100% !important;
        min-width: 210px;
    }
</style>