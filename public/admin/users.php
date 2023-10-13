<?php

use App\Database\User;

require_once __DIR__ . "/../../vendor/autoload.php";



if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$breadcrumb = [
    [
        "url" => "/admin/index.php",
        "name" => "Home"
    ],
    [
        "url" => NULL,
        "name" => "Users"
    ],
];



$userModel = new User();

[
    'data' => $users,
    'total_record' => $total_record,
    'total_page' => $total_page,
    'current_page' => $page,
] = $userModel->paginate();
$prev = $page - 1;
$next = $page + 1;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Admin - Users</title>
    <style>
        .avatar {
            width: 50px;
            height: 50px;
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
                    <table class="table table-hover caption-top shadow">
                        <caption>
                            <h3 class="text-primary">
                                All Users
                            </h3>
                        </caption>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birth Year</th>
                                <th>Gender</th>
                                <th>Create at</th>
                                <th>
                                    <i class="bi bi-arrow-down-up"></i> Action
                                </th>
                            </tr>
                        <tbody>
                            <?php foreach ($users as $each) { ?>
                                <tr class="<?= isset($each['deleted_at']) ? 'table-warning' : '' ?>">
                                    <td><?= $each['id'] ?></td>
                                    <td>
                                        <img src="../assets/images/<?= $each['avatar'] ?? 'users/default.webp' ?>" alt="" class="img-thumbnail avatar rounded-circle">
                                    </td>
                                    <td><?= $each['name'] ?></td>
                                    <td><?= $each['email'] ?></td>
                                    <td><?= isset($each['birth_year']) ? $each['birth_year'] : 'Not fill' ?></td>
                                    <td><?= $each['gender'] == '1' ? 'Male' : 'Female' ?></td>
                                    <td><?= $each['created_at'] ?></td>
                                    <td>
                                        <?php if (!empty($each['deleted_at'])) { ?>
                                            <a href="users/block_user.php?id=<?= $each['id'] ?>&action=unblock" class="btn btn-success">Unblock</a>
                                        <?php } else {  ?>
                                            <a href="users/block_user.php?id=<?= $each['id'] ?>&action=block" class="btn btn-warning">Block</a>
                                        <?php } ?>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </thead>
                    </table>
                    <?php require_once __DIR__ . "/../pages/paginate.php" ?>
                </main>
            </div>
        </div>
    </div>


    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>


    <?php require_once __DIR__ . "/layouts/script.php" ?>
</body>

</html>