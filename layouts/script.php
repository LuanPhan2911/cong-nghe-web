<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/moment-with-locales.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/js/jquery-confirm.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script>
    moment.locale('vi');
    $(function() {
        $(".date-from-now").each(function(_, item) {
            let time = $(this).text();
            $(this).text(moment(time).fromNow())
        })
    })
</script>