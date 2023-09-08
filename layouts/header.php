<header>
    <div class="container">
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">Review Truyện</a>


                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" id="offcanvas">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Review Truyen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <form class="d-flex mb-3" method="get" action="./search.php">
                                    <input class="form-control mx-2" type="search" placeholder="Search" name="q">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </li>
                            <?php
                            require_once "./middleware/check_login.php";
                            if (check_login()) {

                            ?>
                                <li class="nav-item">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <img src="assets/images/truong-dich-review.jpeg" alt="" width="50px" height="50px" class="img-thumbnail">
                                        <span><?php echo $_SESSION["name"] ?></span>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="./user.php?id=<?php echo $_SESSION["id"] ?>" class="nav-link">Hồ sơ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./logout.php" class="nav-link">Thoát</a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link px-2" href="./login.php">Đăng nhập</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-2" href="./register.php">Đăng kí</a>
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