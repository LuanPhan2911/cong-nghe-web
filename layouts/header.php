<?php require_once __DIR__ . "/../middleware/session.php"; ?>
<header>
    <div class="container">
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand text-primary" href="/">
                    <img src="/assets/icon/favicon-32x32.png" alt="">
                    Review Truyện</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" id="offcanvas">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-primary">Review Truyen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <form class="d-flex mb-3 position-relative" method="get" action="search.php">
                                    <input class="form-control mx-2" type="search" placeholder="Tìm kiếm" name="q" value="<?= $_GET['q'] ?? '' ?>">
                                    <button class="btn position-absolute end-0 top-0 me-5" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </form>
                            </li>
                            <?php

                            if (check_login()) {
                            ?>
                                <li class="nav-item shadow my-2">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="assets/images/<?= $_SESSION['user_avatar'] ?>" alt="" width="70px" height="70px" class="img-thumbnail">
                                        <div class="text-center text-primary"><?= $_SESSION['user_name'] ?></div>
                                    </div>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="user.php?id=<?= $_SESSION["user_id"] ?>" class="nav-link link-primary">Hồ sơ</a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="auth/logout.php" class="nav-link link-danger">Thoát</a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item ">
                                    <a class="nav-link px-2" href="login.php">Đăng nhập</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2" href="register.php">Đăng kí</a>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
        </nav>
    </div>

</header>