<?php

require_once __DIR__ . "/../middleware/session.php";
$brand = "Home";

if (!check_admin()) {
    header("location:../index.php");
    exit;
}
require_once __DIR__ . "/../database/connect.php";
$query = "select * from stories";
$stories = mysqli_query($connect, $query);

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Admin - Index</title>
    <style>
        .avatar {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once __DIR__ . "/layouts/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/layouts/navbar.php" ?>
                </header>
                <main>
                    <a href="create_review.php" class="btn btn-success">Create Review</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>AVatar</th>
                                <th>Name</th>
                                <th>Author Name</th>
                                <th>Action</th>
                            </tr>
                        <tbody>


                            <?php foreach ($stories as $each) { ?>
                                <tr>
                                    <td><?php echo $each['id'] ?></td>
                                    <td>
                                        <img src='<?= "../assets/images/" . $each['avatar'] ?>' alt="" class="avatar">
                                    </td>
                                    <td><?php echo $each['name'] ?></td>
                                    <td><?php echo $each['author_name'] ?></td>

                                    <td>
                                        <a href='edit_review.php?id=<?= $each["id"] ?>' class="btn btn-primary">Edit</a>
                                        <a href='pinned_review.php?id=<?= $each["id"] ?>' class="btn btn-success">Pin</a>
                                        <a href='hidden_review.php?id=<?= $each["id"] ?>' class="btn btn-warning">Hide</a>
                                        <a href='delete_review.php?id=<?= $each["id"] ?>' class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </thead>
                    </table>
                </main>
            </div>
        </div>
    </div>



    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>

    <?php require_once __DIR__ . "/layouts/script.php" ?>
</body>

</html>