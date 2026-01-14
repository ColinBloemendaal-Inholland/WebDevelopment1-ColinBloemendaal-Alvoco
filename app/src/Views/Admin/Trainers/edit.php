<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Bewerk Trainer</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST" action="/admin/trainers/<?= $data['trainer']['id'] ?>">
                                <!-- ...existing code... -->
                            </form>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
</div>
