<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
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
            <?php require_once __DIR__ . "/../layouts/admin/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/../layouts/admin/navbar.php" ?>
                </header>
                <main>
                    <div class="row mb-3">
                        <div class="col-lg-8 mb-3">
                            <div class="chart p-3 shadow">
                                <h3 class="text-primary">View count chart</h3>
                                <canvas id="view_count_line_chart" class="w-100"></canvas>
                            </div>

                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="statistic p-3 shadow">
                                <h3 class="text-primary">Statistic</h3>
                                <div class="total_view_count">
                                    <span class="text-primary">Sum of view count: </span>
                                    <?= $total_view_count ?>
                                </div>
                                <div class="total_review">
                                    <span class="text-primary">Count of review: </span>
                                    <?= $total_record ?>
                                </div>
                                <div class="total_user">
                                    <span class="text-success">Count of user: </span>
                                    <?= $total_user ?>
                                </div>
                                <div class="total_comment">
                                    <span class="text-success">Count of comment: </span>
                                    <?= $total_comment ?>
                                </div>
                                <a href="/admin/stories/create" class="btn btn-success">Create Review</a>
                            </div>

                        </div>

                    </div>

                    <table class="table table-hover shadow caption-top">
                        <caption>
                            <h3 class="text-primary">All Reviews</h3>
                        </caption>
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Author Name</th>
                                <th>Action</th>
                            </tr>
                        <tbody>


                            <?php foreach ($stories as $each) { ?>
                                <tr>
                                    <td><?php echo $each['id'] ?></td>
                                    <td>
                                        <img src='<?= "/assets/images/" . $each['avatar'] ?>' alt="" class="avatar">
                                    </td>
                                    <td class="col-3"><?php echo $each['name'] ?></td>
                                    <td><?php echo $each['author_name'] ?></td>

                                    <td>

                                        <a href='/admin/stories/edit/<?= $each["id"] ?>' class="btn btn-primary">Edit</a>
                                        <?php if ($each['pinned'] == 0) : ?>
                                            <a href='/admin/stories/edit/<?= $each['id'] ?>/pin' class="btn btn-success">Pin</a>
                                        <?php else : ?>
                                            <a href='/admin/stories/edit/<?= $each['id'] ?>/unpin' class="btn btn-success">Unpin</a>
                                        <?php endif;  ?>
                                        <?php if ($each['deleted_at'] === NULL) : ?>
                                            <a href='/admin/stories/edit/<?= $each['id'] ?>/hide' class="btn btn-warning">Hide</a>
                                        <?php else : ?>
                                            <a href='/admin/stories/edit/<?= $each['id'] ?>/show' class="btn btn-warning">Show</a>
                                        <?php endif;  ?>

                                        <a href='/admin/stories/destroy/<?= $each["id"] ?>' class="btn btn-danger delete-review">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </thead>
                    </table>
                    <?php require_once __DIR__ . '/../pages/paginate.php' ?>
                </main>
            </div>
        </div>
    </div>



    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>
    <?php require_once __DIR__ . "/../layouts/script.php" ?>
    <script>
        $(function() {
            $(".delete-review").confirm({
                title: 'Delete Review?',
                content: 'This dialog will automatically trigger \'cancel\' in 5 seconds if you don\'t respond.',
                autoClose: 'cancel|5000',
                buttons: {
                    delete: {
                        text: 'Delete',
                        btnClass: "btn-danger",
                        action: function() {
                            location.href = this.$target.attr('href');
                        }
                    },
                    cancel: {
                        btnClass: "btn-success",
                        action: function() {

                        }
                    }
                }
            });


            function renderViewCountLineChart() {

                $.ajax({
                    type: "get",
                    url: "/stories/count_review",
                    success: function(response) {
                        if (response?.success) {
                            let {
                                data
                            } = response;

                            if (data?.length > 0) {
                                new Chart(
                                    $('#view_count_line_chart'), {
                                        type: 'bar',
                                        data: {
                                            labels: data.map(item => item.name),
                                            datasets: [{
                                                label: 'Top 10 view count review',
                                                data: data.map(item => item.view_count)
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                x: {
                                                    ticks: {
                                                        callback: function(value) {
                                                            let newLabel = this.getLabelForValue(value)
                                                                .substring(0, 8) + '...';
                                                            return newLabel;
                                                        }
                                                    }
                                                }
                                            },
                                        }
                                    }
                                );
                            }
                        }
                    }
                });


            }

            renderViewCountLineChart();

        })
    </script>
</body>

</html>