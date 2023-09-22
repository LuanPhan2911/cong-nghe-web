<div class="container">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php foreach ($breadcrumb as $each) { ?>
                            <li class="breadcrumb-item">
                                <a href="<?= $each['url'] ?>" class="text-decoration-none"><?= $each['name'] ?></a>
                            </li>
                        <?php } ?>

                    </ol>
                </nav>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" id="offcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Review Truyen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">

                </div>
            </div>
    </nav>
</div>