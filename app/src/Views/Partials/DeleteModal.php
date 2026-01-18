<!-- Reusable Bootstrap Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-entity="<?= isset($data['type']) ? e($data['type']) : 'item' ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Verwijder bevestigen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php if (!isset($data['message'])): ?>
                <div class="modal-body" id="deleteModalBody">
                    Weet je zeker dat je dit <span
                        id="deleteModalEntity"><?= isset($data['type']) ? e($data['type']) : 'item' ?></span> wilt
                    verwijderen?
                </div>
            <?php else: ?>
                <div class="modal-body" id="deleteModalBody">
                    <?= e($data['message']) ?>
                </div>
            <?php endif; ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Verwijderen</button>
            </div>
        </div>
    </div>
</div>
<script src="/JS/Partials/DeleteModal.js"></script>