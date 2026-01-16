<?php if (!empty($_SESSION['form_errors'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="alert-heading">Er zijn fouten in het formulier:</h5>
        <ul class="mb-0">
            <?php if(is_array($_SESSION['form_errors']) && count($_SESSION['form_errors']) > 0): ?>
            <?php foreach ($_SESSION['form_errors'] as $field => $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
            <?php else: ?>
                <li><?= e($_SESSION['form_errors']) ?></li>
            <?php endif; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
    </div>
<?php endif; ?>
