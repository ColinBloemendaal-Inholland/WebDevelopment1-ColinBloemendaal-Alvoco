<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Nieuw Nieuwsbericht toevoegen</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST">
                                <!-- Titel -->
                                <div class="mb-3 row">
                                    <label for="Title" class="col-sm-3 col-form-label">Titel</label>
                                    <div class="col-sm-9">
                                             <input type="text" class="form-control" id="Title" name="Title"
                                                 value="<?= e($_SESSION['form_old']['Title'] ?? '') ?>" required aria-label="Titel invoerveld">
                                    </div>
                                </div>

                                <!-- Message (WYSIWYG) -->
                                <div class="mb-3 row">
                                    <label for="Message" class="col-sm-3 col-form-label">Bericht</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="Message" name="Message" rows="8" aria-label="Bericht invoerveld"><?= htmlspecialchars_decode($_SESSION['form_old']['Message'] ?? '') ?></textarea>
                                    </div>
                                </div>

                                <!-- Auteur select -->
                                <div class="mb-3 row">
                                    <label for="Bestuursleden_id" class="col-sm-3 col-form-label">Auteur</label>
                                    <div class="col-sm-9">
                                        <select name="Bestuursleden_id" id="Bestuursleden_id" class="form-select" required>
                                            <option value="">Selecteer een auteur</option>
                                            <?php foreach ($data['bestuursleden'] as $bestuurslid): ?>
                                                <option value="<?= e($bestuurslid['id']) ?>"
                                                    <?= (isset($_SESSION['form_old']['Bestuursleden_id']) && $_SESSION['form_old']['Bestuursleden_id'] == $bestuurslid['id']) ? 'selected' : '' ?>>
                                                    <?= e($bestuurslid['lid']['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <!-- Submit -->
                                <div class="mb-3 row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                        <a href="/admin/nieuwsberichten" class="btn btn-secondary">Annuleren</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

<script>
    tinymce.init({
        selector: '#Message',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
    });
</script>
<script>
    $(function () {
        // TomSelect for Auteur
        new TomSelect("#Bestuursleden_id", { create: false, sortField: { field: "text", direction: "asc" } });

        // Initialize WYSIWYG (simple example using contenteditable or TinyMCE/CKEditor)
        // Example with CKEditor:
        // ClassicEditor.create(document.querySelector('#Message'));
    });
</script>
