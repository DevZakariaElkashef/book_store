<!-- Core JS -->

<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('dashboard/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/libs/toastr/toastr.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('dashboard/assets/js/dashboards-analytics.js') }}"></script>

<script>
    $(document).ready(function() {
        var toastElement = $('.toast');

        // Set a timeout to add the 'hide' class after 3 seconds
        setTimeout(function() {
            toastElement.removeClass('show').addClass('hide');
        }, 3000);
    });
</script>

<script>
    $(document).on('click', '.show-notifications-btn', function() {
        $.ajax({
            type: "PUT",
            url: "{{ route('notifications.update', 0) }}",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                $('.notification-alarm').html(response.alarm);
                $('.notification-counter').html(response.counter);
            }
        });
    });
</script>


<script>
    $(document).on('input', '.search-in-db', function() {
        let val = $(this).val();
        let url = $(this).data('url');


        $.ajax({
            type: "get",
            url: url,
            data: {
                val: val,
            },
            success: function(response) {
                $('#searchTable').html(response);
            }
        });
    });
</script>
