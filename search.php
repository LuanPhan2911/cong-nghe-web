<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/search.css">
    <title>Search</title>
</head>

<body>
    <?php require_once "./layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 bg-white">
                    <h3>SEARCH RESULTS FOR "D"</h3>
                    <div class="review-content p-2 my-2">
                        <div class="row">
                            <div class="col-4">
                                <img src="./images/review-truyen-trong-sinh-cung-truc-ma-vuong-gia-250x250.jpg" alt="">
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
                                <div class="view">
                                    <i class="bi bi-eye"></i>
                                    <span>220</span>
                                </div>
                                <div class="tag d-flex justify-content-end">
                                    <a href="" class="btn btn-outline-primary">
                                        Ngon tinh
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="review-content p-2">
                        <div class="row">
                            <div class="col-4">
                                <img src="./images/review-truyen-trong-sinh-cung-truc-ma-vuong-gia-250x250.jpg" alt="">
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
                                <div class="view">
                                    <i class="bi bi-eye"></i>
                                    <span>220</span>
                                </div>
                                <div class="tag d-flex justify-content-end">
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
                    <div class="tags p-2 bg-white my-2">
                        <h3>Thể loại</h3>
                        <ul class="list-unstyled p-2">
                            <li>
                                <a href="">Ngon tinh</a>
                            </li>
                            <li>
                                <a href="">Ngon tinh</a>
                            </li>
                            <li>
                                <a href="">Ngon tinh</a>
                            </li>
                            <li>
                                <a href="">Ngon tinh</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once "./layouts/footer.php" ?>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>