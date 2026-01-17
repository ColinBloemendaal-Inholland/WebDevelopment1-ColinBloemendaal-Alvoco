<!-- Reusable Bootstrap Force Delete Modal -->
<div class="modal fade" id="forceDeleteModal" tabindex="-1" aria-labelledby="forceDeleteModalLabel" aria-hidden="true"
    data-entity="<?= isset($data['type']) ? e($data['type']) : 'item' ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forceDeleteModalLabel">Permanent verwijderen bevestigen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="forceDeleteModalBody">
                Weet je zeker dat je <?= !empty($data['multiple']) ? 'deze' : 'dit' ?> <span
                    id="forceDeleteModalEntity"><?= isset($data['type']) ? e($data['type']) : 'item' ?></span> permanent
                wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                <button type="button" class="btn btn-danger" id="confirmForceDeleteBtn">Permanent verwijderen</button>
            </div>
        </div>
    </div>
</div>
<script src="/JS/Partials/ForceDeleteModal.js"></script>
