<?php

if (isset($_SESSION["msg"])) {
?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
        <div class="toast show bg-success">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <?php echo flash("msg") ?>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

        </div>
    </div>

<?php

}
?>