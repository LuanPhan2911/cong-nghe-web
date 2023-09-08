<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Trang chủ</title>
</head>

<body>
    <?php require_once "./layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <div class="feature-review p-3 bg-white">
                        <h3>Đề cử</h3>
                        <div id="carousel" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="./images/truong-dich-review.jpeg">
                                    <div class="carousel-caption d-none d-md-block">

                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="./images/truong-dich-review.jpeg">
                                    <div class="carousel-caption d-none d-md-block">

                                    </div>
                                </div>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-primary"></span>

                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-primary"></span>

                            </button>
                        </div>
                    </div>

                    <div class="reviews p-3 bg-white my-3">

                        <h3>Xem nhiều</h3>


                        <div class="review-content p-2 my-2">
                            <div class="row">
                                <div class="col-4">
                                    <img src="./images/review-truyen-trong-sinh-cung-truc-ma-vuong-gia-250x250.jpg" alt="" class="img-fluid img-thumbnail">
                                </div>
                                <div class="col-8">
                                    <div class="review-name">
                                        <a href="./review.php"> Review truyen vuong gia trong sinh</a>
                                    </div>
                                    <div class="author-name">
                                        <i class="bi bi-pen"></i>
                                        <span> Nguyen Van Trung</span>
                                    </div>
                                    <div class="created_at">
                                        <i class="bi bi-clock"></i>
                                        <span> 30 thang 3 2023</span>
                                    </div>

                                    <div class="tag d-flex justify-content-between">
                                        <div class="view">
                                            <i class="bi bi-eye"></i>
                                            <span>220</span>
                                        </div>
                                        <a href="" class="btn btn-outline-primary">
                                            Ngon tinh
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>





                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="new-review p-2 bg-white">
                        <h3>Mới đăng</h3>
                        <ul class="list-unstyled p-2">
                            <li>
                                <a href="">Review truyen vuong gia trong sinh</a>
                            </li>
                            <li>
                                <a href="">Review truyen vuong gia trong sinh</a>
                            </li>
                            <li>
                                <a href="">Review truyen vuong gia trong sinh</a>
                            </li>

                        </ul>
                    </div>
                    <div class="new-review p-2 bg-white">
                        <h3>The loai</h3>
                        <ul class="list-unstyled p-2">
                            <li>
                                <a href="">Review truyen vuong gia trong sinh</a>
                            </li>
                            <li>
                                <a href="">Review truyen vuong gia trong sinh</a>
                            </li>
                            <li>
                                <a href="">Review truyen vuong gia trong sinh</a>
                            </li>

                        </ul>
                    </div>
                    <div class="comments bg-white">
                        <h3>Binh luan</h3>
                        <div class="comemnt-content row">
                            <div class="col-2">
                                User 2
                            </div>
                            <div class="col-10">
                                Hay qua di
                            </div>
                        </div>
                        <div class="comemnt-content row">
                            <div class="col-2">
                                User 2
                            </div>
                            <div class="col-10">
                                Hay qua di
                            </div>
                        </div>
                        <div class="comemnt-content row">
                            <div class="col-2">
                                User 2
                            </div>
                            <div class="col-10">
                                Hay qua di
                            </div>
                        </div>
                        <div class="comemnt-content row">
                            <div class="col-2">
                                User 2
                            </div>
                            <div class="col-10">
                                Hay qua di
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <?php require_once "./notify/toast_success.php" ?>
    </main>
    <?php require_once "./layouts/footer.php" ?>



    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>


</body>

</html>