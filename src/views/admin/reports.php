<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Admin - Reports</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once __DIR__ . "/../layouts/admin/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/../layouts/admin/navbar.php" ?>
                </header>
                <main>
                    <a href="/admin/reports/type/stories" class="btn btn-primary">Stories</a>
                    <a href="/admin/reports/type/comments" class="btn btn-success">Comments</a>


                    <?php if ($reported_type === 'comments') : ?>

                        <?php if (!empty($comments)) : ?>
                            <table class="table table-hover table-bordered caption-top shadow">
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
                                            <a href="/admin/reports/delete_finish/comments" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Delete all finished reports">Delete All</a>
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
                                                    <a href="/admin/reports/edit/<?= $each['id'] ?>/finish" class="btn btn-success">Finish</a>
                                                <?php else : ?>
                                                    <a href="/admin/reports/edit/<?= $each['id'] ?>/unfinish" class="btn btn-primary">Unfinished</a>
                                                <?php endif;  ?>
                                                <?php if (empty($each['comment_deleted'])) : ?>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Mark finish report and block comment" href="/admin/comments/<?= $each['comment_id'] ?>/reports/<?= $each['id'] ?>/block" class="btn btn-warning">Block</a>
                                                <?php else : ?>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Mark finish report and unblock comment" href="/admin/comments/<?= $each['comment_id'] ?>/reports/<?= $each['id'] ?>/unblock" class="btn btn-warning">Unblock</a>
                                                <?php endif;  ?>
                                                <a href="/admin/comments/destroy/<?= $each['comment_id'] ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Delete comment and report">Delete</a>
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
                        <?php if (!empty($stories)) : ?>
                            <table class="table table-hover table-bordered caption-top shadow">
                                <caption>
                                    <h3 class="text-success">List of report Story</h3>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Story name</th>
                                        <th>Report Content</th>
                                        <th>Action
                                            <a href="/admin/reports/delete_finish/stories" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Delete all finished reports">Delete All</a>
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
                                                    <a href="/admin/reports/edit/<?= $each['id'] ?>/finish" class="btn btn-success">Finish</a>
                                                <?php else : ?>
                                                    <a href="/admin/reports/edit/<?= $each['id'] ?>/unfinish" class="btn btn-primary">Unfinished</a>
                                                <?php endif;  ?>
                                                <a data-bs-toggle="tooltip" data-bs-title="Edit review" href="/admin/stories/edit/<?= $each['story_id'] ?>" class="btn btn-primary">Edit</a>
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
    <?php require_once __DIR__ . "/../layouts/script.php" ?>

</body>

</html>