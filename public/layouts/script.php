<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/moment-with-locales.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/js/jquery-confirm.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/notify.min.js"></script>
<script src="assets/js/jquery.mark.min.js"></script>
<script>
    moment.locale('vi');
    $(function() {
        $(".date-from-now").each(function(_, item) {
            let time = $(this).text();
            $(this).text(moment(time).fromNow())
        })
    })
    $.notify.defaults({
        globalPosition: 'bottom right',
    })
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>