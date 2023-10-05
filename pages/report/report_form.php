<div class="modal fade" tabindex="-1" id="report-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Báo cáo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="report_form" action="pages/report/create_report.php" method="post">
                    <div class="mb-3">
                        <label for="">Nội dung báo cáo:</label>
                        <input type="text" name="content" id="report-content" class="form-control">
                        <input type="hidden" name="reported_type" value="" id="reported_type">
                        <input type="hidden" name="reported_id" value="" id="reported_id">
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button class="btn btn-primary px-5 d-block" type="submit" id="send-report">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#report_form").validate({
            rules: {

                content: "required"
            },
            messages: {
                content: "Bạn chưa nhập nội dung báo cáo!"
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            submitHandler: function(form) {
                $('#send-report').html(`<div class="spinner-border" role="status"></div>`);
                $("#send-report").attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "pages/report/create_report.php",
                    data: $(form).serialize(),
                    success: function(response) {
                        let {
                            message,
                            success
                        } = response;
                        if (success) {
                            $.notify(message, "success");
                            $('#report-modal').modal('hide');
                        } else {
                            $.notify(message, "error");
                        }



                    },
                    complete: function() {
                        $('#send-report').html(`Gửi`);
                        $("#send-report").attr('disabled', false);
                    }

                });
            }

        })

    })
</script>