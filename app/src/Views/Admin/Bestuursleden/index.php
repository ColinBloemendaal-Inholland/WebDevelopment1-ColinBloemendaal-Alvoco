<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <h1 class="mb-4">Bestuursleden</h1>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bestuursleden)) : ?>
                            <?php foreach ($bestuursleden as $bestuurslid) : ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($bestuurslid->lid->fullname) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bestuurslid->role->name ?? '-') ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bestuurslid->start_date 
                                            ? date('d-m-Y', strtotime($bestuurslid->start_date)) 
                                            : '-') ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bestuurslid->end_date 
                                            ? date('d-m-Y', strtotime($bestuurslid->end_date)) 
                                            : '-') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">No bestuursleden found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
