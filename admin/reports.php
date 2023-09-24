<?php
require_once __DIR__ . "/../middleware/session.php";
require_once __DIR__ . "/../database/connect.php";
if (!check_admin()) {
    header("location:../index.php");
    exit;
}
$breadcrumb = [
    [
        "url" => "./index.php",
        "name" => "Home"
    ],
    [
        "url" => "",
        "name" => "Reports"
    ],
];

$reported_type = $_GET['type'] ?? 'comments';

if (!in_array($reported_type, ['stories', 'comments'])) {
    $reported_type = 'comments';
}

$comments = [];
$stories = [];
if ($reported_type === 'comments') {
    $query = "select 
    reports.id, reports.content,reports.finish,
    comments.id as comment_id, comments.content as comment_content, comments.deleted_at as comment_deleted
    from reports
    join comments on reports.reported_id=comments.id
    where reported_type='comments'
    order by reports.finish asc    
    ";
    $comments = mysqli_query($connect, $query);
} else {
    $query = "select 
    reports.id, reports.content,reports.finish,
    stories.id as story_id, stories.name as story_name
    from reports
    join stories on reports.reported_id=stories.id
    where reported_type='stories'
    order by reports.finish asc    
    ";
    $stories = mysqli_query($connect, $query);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Admin - Reports</title>
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
                    <a href="?type=comments" class="btn btn-success">Comments</a>
                    <a href="?type=stories" class="btn btn-primary">Stories</a>

                    <?php if ($reported_type === 'comments') : ?>

                        <?php if (mysqli_num_rows($comments) > 0) : ?>
                            <table class="table table-hover table-bordered caption-top">
                                <caption>
                                    <h3 class="text-success">List of report comments</h3>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Comment Id</th>
                                        <th>Comment Content</th>
                                        <th>Report Content</th>
                                        <th>Action
                                            <a href="reports/delete_report.php?type=comments" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Delete all finished reports">Delete All</a>
                                        </th>
                                    </tr>
                                <tbody>

                                    <?php foreach ($comments as $each) { ?>
                                        <tr class="<?= $each['finish'] == '1' ? 'table-success' : 'table-primary' ?>">
                                            <td><?= $each['id'] ?></td>
                                            <td><?= $each['comment_id'] ?></td>
                                            <td class="col-4"><?= $each['comment_content'] ?> </td>
                                            <td class="col-3"><?= $each['content'] ?> </td>
                                            <td>
                                                <?php if ($each['finish'] == '0') : ?>
                                                    <a href="reports/finish_report.php?id=<?= $each['id'] ?>&action=finish" class="btn btn-success">Finish</a>
                                                <?php else : ?>
                                                    <a href="reports/finish_report.php?id=<?= $each['id'] ?>&action=unfinish" class="btn btn-primary">Unfinished</a>
                                                <?php endif;  ?>
                                                <?php if (empty($each['comment_deleted'])) : ?>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Mark finish report and block comment" href="comments/block_comment.php?id=<?= $each['id'] ?>&comment_id=<?= $each['comment_id'] ?>&action=block" class="btn btn-warning">Block</a>
                                                <?php else : ?>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Mark finish report and unblock comment" href="comments/block_comment.php?id=<?= $each['id'] ?>&comment_id=<?= $each['comment_id'] ?>&action=unblock" class="btn btn-warning">Unblock</a>
                                                <?php endif;  ?>
                                                <a href="comments/delete_comment.php?comment_id=<?= $each['comment_id'] ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Delete comment and report">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                </thead>
                            </table>
                        <?php else : ?>
                            <h3 class="text-primary my-2">No comment reported</h3>
                        <?php endif;  ?>

                    <?php else : ?>
                        <?php if (mysqli_num_rows($stories) > 0) : ?>
                            <table class="table table-hover table-bordered caption-top">
                                <caption>
                                    <h3 class="text-success">List of report comments</h3>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Story name</th>
                                        <th>Report Content</th>
                                        <th>Action
                                            <a href="reports/delete_report.php?type=stories" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Delete all finished reports">Delete All</a>
                                        </th>
                                    </tr>
                                <tbody>

                                    <?php foreach ($stories as $each) { ?>
                                        <tr class="<?= $each['finish'] == '1' ? 'table-success' : 'table-primary' ?>">
                                            <td><?= $each['id'] ?></td>

                                            <td class="col-4"><?= $each['story_name'] ?> </td>
                                            <td class="col-4"><?= $each['content'] ?> </td>
                                            <td>
                                                <?php if ($each['finish'] == '0') : ?>
                                                    <a href="reports/finish_report.php?id=<?= $each['id'] ?>&action=finish" class="btn btn-success">Finish</a>
                                                <?php else : ?>
                                                    <a href="reports/finish_report.php?id=<?= $each['id'] ?>&action=unfinish" class="btn btn-primary">Unfinished</a>
                                                <?php endif;  ?>
                                                <a data-bs-toggle="tooltip" data-bs-title="Edit review" href="edit_review.php?id=<?= $each['story_id'] ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                </thead>
                            </table>
                        <?php else : ?>
                            <h3 class="text-primary my-2">No reviews reported</h3>
                        <?php endif;  ?>
                    <?php endif;  ?>

                </main>
            </div>
        </div>
    </div>




    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>