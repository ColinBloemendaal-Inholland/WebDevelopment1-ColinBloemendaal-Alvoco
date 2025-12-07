<?php if (!empty($_SESSION['form_errors'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="alert-heading">Er zijn fouten in het formulier:</h5>
        <ul class="mb-0">
            <?php foreach ($_SESSION['form_errors'] as $field => $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
    </div>
<?php 
    // Optionally clear errors after displaying
    unset($_SESSION['form_errors']);
endif;
?>