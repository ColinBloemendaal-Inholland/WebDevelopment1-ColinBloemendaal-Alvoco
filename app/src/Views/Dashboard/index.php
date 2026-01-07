<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="card-title mb-0">Welkom, <?= e($data['user']->firstname . ' ' . $data['user']->lastname) ?></h2>
                        <a href="/dashboard/edit" class="btn btn-outline-primary btn-sm ms-3">Profiel bewerken</a>
                    </div>
                    <p class="mb-1"><strong>Email:</strong> <?= e($data['user']->email) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
