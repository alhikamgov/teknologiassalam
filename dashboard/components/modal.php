<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form method="POST" class="modal-content border-0 shadow-lg" enctype="multipart/form-data">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title font-weight-bold ml-2">Editor Konten</h5>
                <button class="close text-white" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4" style="max-height: 70vh; overflow-y: auto;">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="section" value="<?= $curr ?>">
                <input type="hidden" name="index" id="f_idx">
                <div id="f_fields" class="row"></div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button class="btn btn-link text-muted" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>