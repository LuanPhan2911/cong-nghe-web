<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page <= 1) echo 'disabled' ?>">
            <a class="page-link" href="<?= $page <= 1 ? "#" : "?page=$prev" ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $total_page; $i++) : ?>
            <li class="page-item <?php if ($page == $i)  echo 'active'; ?>">
                <a class="page-link" href='<?= "?page=$i" ?>'> <?= $i ?> </a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php if ($page >= $total_page) echo 'disabled' ?>">
            <a class="page-link" href="<?= $page >= $total_page ? "#" : "?page=$next" ?> ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>