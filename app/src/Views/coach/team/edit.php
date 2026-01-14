<div class="container py-4">
    <h2>Team bewerken: <?= e($data['team']->name) ?></h2>
    <form method="POST" action="/dashboard/teams/<?= e($data['team']->id) ?>/update">
        <?php \View::partial('Layout.errors'); ?>
        <div class="mb-3">
            <label for="spelers" class="form-label">Spelers</label>
            <select multiple class="form-select" id="spelers" name="spelers[]" aria-label="Spelers selectievak">
                <?php foreach ($data['spelers'] as $speler): ?>
                    <option value="<?= e($speler->id) ?>" <?= $data['team']->spelers->contains('id', $speler->id) ? 'selected' : '' ?>>
                        <?= e($speler->lid->fullname ?? $speler->id) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="trainers" class="form-label">Trainers</label>
            <select multiple class="form-select" id="trainers" name="trainers[]" aria-label="Trainers selectievak">
                <?php foreach ($data['trainers'] as $trainer): ?>
                    <option value="<?= e($trainer->id) ?>" <?= $data['team']->trainers->contains('id', $trainer->id) ? 'selected' : '' ?>>
                        <?= e($trainer->lid->fullname ?? $trainer->id) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
<main>
    <section class="container py-4">
        <header>
            <h2>Team bewerken: <?= e($data['team']->name) ?></h2>
        </header>
        <form method="POST" action="/dashboard/teams/<?= e($data['team']->id) ?>/update">
            <?php \View::partial('Layout.errors'); ?>
            <div class="mb-3">
                <label for="spelers" class="form-label">Spelers</label>
                <select multiple class="form-select" id="spelers" name="spelers[]" aria-label="Spelers selectievak">
                    <?php foreach ($data['spelers'] as $speler): ?>
                        <option value="<?= e($speler->id) ?>" <?= $data['team']->spelers->contains('id', $speler->id) ? 'selected' : '' ?>>
                            <?= e($speler->lid->fullname ?? $speler->id) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="trainers" class="form-label">Trainers</label>
                <select multiple class="form-select" id="trainers" name="trainers[]" aria-label="Trainers selectievak">
                    <?php foreach ($data['trainers'] as $trainer): ?>
                        <option value="<?= e($trainer->id) ?>" <?= $data['team']->trainers->contains('id', $trainer->id) ? 'selected' : '' ?>>
                            <?= e($trainer->lid->fullname ?? $trainer->id) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </section>
</main>
<script>
    $(function () {
        new TomSelect('#spelers', { plugins: ['remove_button'], create: false });
        new TomSelect('#trainers', { plugins: ['remove_button'], create: false });
    });
</script>
