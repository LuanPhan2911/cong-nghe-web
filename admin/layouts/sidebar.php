<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="../index.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Review Truyện</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="./index.php" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>

            </li>
            <li class="nav-item">
                <a href="./users.php" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-person-circle"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                </a>

            </li>
            <li class="nav-item">
                <a href="./reports.php" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-flag"></i> <span class="ms-1 d-none d-sm-inline">Reports</span>
                </a>

            </li>
            <li class="nav-item">
                <a href="../../auth/logout.php" class="nav-link align-middle px-0" id="logout">
                    <i class="fs-4 bi-box-arrow-left"></i> <span class="ms-1 d-none d-sm-inline">Sign out</span>
                </a>

            </li>
        </ul>
        <hr>

    </div>
</div>

<?php require_once __DIR__ . "/script.php" ?>
<script>
    $("#logout").confirm({

        title: 'Logout?',
        content: 'Your time is out, you will be automatically logged out in 10 seconds.',
        autoClose: 'logoutUser|10000',
        buttons: {
            logoutUser: {
                text: 'logout',
                action: function() {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: function() {

            }
        }
    });
</script>