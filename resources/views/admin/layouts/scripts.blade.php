<!-- Libs JS -->
<!-- <script src="{{ asset('admin/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
<script src="{{ asset('admin/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script> -->
<script src="{{ asset('admin/dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
<script src="{{ asset('admin/dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Tabler Core -->
<script src="{{ asset('admin/dist/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('admin/dist/js/demo.min.js') }}" defer></script>
{{-- Alert JS --}}
<script src="{{ asset('admin/dist/js/alert.js') }}" defer></script>
{{-- Jquery CDN  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- DATATABLE CDN  --}}
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
{{-- DatePicker Range  --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{{-- MULTIPLE SELECT DROPDOWN --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<script>
    $(document).ready(function() {
        $(".dataTableElement").each(function() {
            new DataTable(this, {
                responsive: true,
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });
        });

    });

    // Datepicker Range
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#fromDateInput').val(start.format('MMMM D, YYYY'));
            $('#toDateInput').val(end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            },
            maxDate: moment()
        }, cb);

        cb(start, end);

    });
</script>

<script>
    $(document).ready(function() {
        function formatDate(isoString) {
            let date = new Date(isoString);
            return date.toLocaleString('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }

        function fetchNotifications() {
            $.ajax({
                url: "{{ route('getNotifications_route') }}", // Ensure this is inside a Blade file
                type: "GET",
                success: function(data) {
                    // console.log('data', data);

                    // Update notification count
                    $("#notification-count").text((data.length > 9) ? '9+' : data.length);

                    // Clear existing notifications
                    $("#notifications-container").empty();

                    // Loop through notifications
                    data.forEach(notification => {
                        let statusClass = notification.is_seen === 0 ? "bg-green" : "bg-secondary";
                        let formattedDate = formatDate(notification.created_at);
                        let notificationItem = `
                    <div class="list-group-item d-flex justify-content-between align-items-center" data-id="${notification.notification_id}">
                        <a href="#" class="mark-as-seen" data-id="${notification.notification_id}">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="status-dot ${statusClass} d-block"></span>
                                </div>
                                <div class="col text-truncate">
                                    <span class="text-body d-block text-wrap">${notification.comment.trim()}</span>
                                    <div class="d-block text-secondary text-truncate mt-n1">
                                        ${formattedDate}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    
                                </div>
                            </div>
                        </a>
                    </div>`;
                        $("#notifications-container").append(notificationItem);
                    });
                },
                error: function() {
                    console.log("Error fetching notifications.");
                }
            });
        }


        // Mark notification as seen
        $(document).on("click", ".mark-as-seen", function(e) {
            e.preventDefault();
            let notificationId = $(this).data("id");

            $.ajax({
                url: "{{ route('markAsSeen_route') }}",
                type: "POST",
                data: {
                    id: notificationId,
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    fetchNotifications(); // Refresh notification list
                }
            });
        });

        fetchNotifications(); // Load notifications when the page loads
    });
</script>