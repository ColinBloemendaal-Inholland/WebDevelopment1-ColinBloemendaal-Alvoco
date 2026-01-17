<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">AVG Check Resultaten</h1>
                <a href="/admin/leden" class="btn btn-secondary">Terug naar leden</a>
            </header>
            <div class="alert alert-info" role="alert">
                Hieronder staan de leden die zijn verwijderd maar mogelijk nog persoonlijke gegevens bevatten. 
                Neem de nodige stappen om te voldoen aan de AVG-richtlijnen.
            </div>
            <?php if (!empty($data['results'])): ?>
                <div class="d-flex justify-content-end mb-3 gap-2">
                    <form action="/admin/leden/force-all" method="POST" class="mb-0">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-danger force-delete-link" data-entity="alle leden">Verwijder alle</button>
                    </form>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Telefoon</th>
                            <th>Adres</th>
                            <th>Verwijderd op</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['results'] as $lid): ?>
                            <tr>
                                <td><?= e($lid->fullname) ?></td>
                                <td><?= e($lid->email) ?></td>
                                <td><?= e($lid->phone ?? '-') ?></td>
                                <td><?= e($lid->adres ?? '-') ?></td>
                                <td><?= e($lid->deleted_at) ?></td>
                                <td>
                                    <form action="/admin/leden/<?= e($lid->id) ?>/force" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-danger btn-sm force-delete-link">Permanent verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-success" role="alert">
                    Er zijn geen leden gevonden die persoonlijke gegevens bevatten na verwijdering.
                </div>
            <?php endif; ?>

        </section>
    </main>
</div>
<?php \View::partial('Partials.ForceDeleteModal', ['type' => 'leden', 'multiple' => true]); ?>