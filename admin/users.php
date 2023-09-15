<?php
require_once __DIR__ . "/../middleware/session.php";
require_once __DIR__ . "/../helper/helper.php";
require_once __DIR__ . "/../database/connect.php";

$brand = "Users";
if (!check_admin()) {
    header("location:../index.php");
    exit;
}




$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$order_by = "DESC";

$query = "select id,name,email, avatar, birth_year, gender, created_at, deleted_at from users where role=0 order by deleted_at $order_by limit $limit offset $offset ";
$users = mysqli_query($connect, $query);

$query = "select count(*) from users where role = 0";
$count_record = mysqli_query($connect, $query);

$total_record = mysqli_fetch_column($count_record);
$total_page = ceil(intval($total_record) / intval($limit));


$prev = $page - 1;
$next = $page + 1;

mysqli_close($connect);
function generate_src_avatar($avatar)
{
    if (isset($avatar)) {
        return '../assets/images/' . $avatar;
    } else {
        return '../assets/images/users/default.webp';
    }
}
function generate_gender($gender)
{
    return $gender == 1 ? "Male" : "Female";
}
function generate_birth_year($gender)
{
    return isset($gender) ? $gender : "Not fill";
}
function generate_link_prev($page, $prev)
{
    if ($page <= 1) {
        return "#";
    } else {
        return "?page=" . $prev;
    }
}
function generate_link_next($page, $next, $total_page)
{
    if ($page >= $total_page) {
        return "#";
    } else {
        return "?page=" . $next;
    }
}
function user_blocked($user)
{
    return isset($user['deleted_at']);
}

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
                    <table class="table table-hover">
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
                                <tr class="<?php if (user_blocked($each))  echo 'table-warning' ?>">
                                    <td><?php echo $each['id'] ?></td>
                                    <td>
                                        <img src="<?= generate_src_avatar($each['avatar']) ?>" alt="" class="img-thumbnail avatar rounded-circle">
                                    </td>
                                    <td><?php echo $each['name'] ?></td>
                                    <td><?php echo $each['email'] ?></td>
                                    <td><?php echo generate_birth_year($each['birth_year']) ?></td>
                                    <td><?php echo generate_gender($each['gender']) ?></td>
                                    <td><?php echo $each['created_at'] ?></td>
                                    <td>
                                        <?php if (user_blocked($each)) { ?>
                                            <a href="block_user.php?id=<?php echo $each['id'] ?>&action=unblock" class="btn btn-success">Unblock</a>
                                        <?php } else {  ?>
                                            <a href="block_user.php?id=<?php echo $each['id'] ?>&action=block" class="btn btn-warning">Block</a>
                                        <?php } ?>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </thead>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if ($page <= 1) echo 'disabled' ?>">
                                <a class="page-link" href="<?php echo generate_link_prev($page, $prev) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                                <li class="page-item <?php if ($page == $i)  echo 'active'; ?>">
                                    <a class="page-link" href='<?php echo "?page=$i" ?>'> <?php echo $i ?> </a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php if ($page >= $total_page) echo 'disabled' ?>">
                                <a class="page-link" href="<?php echo generate_link_next($page, $next, $total_page) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </main>
            </div>
        </div>
    </div>


    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>


    <?php require_once __DIR__ . "/layouts/script.php" ?>
</body>

</html>