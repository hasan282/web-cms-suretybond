<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="mw-6 mx-auto">

    <div class="card">
        <div class="card-body">

            <div class="mw-2 mx-auto">
                <input type="text" class="form-control form-control-lg text-center" placeholder="_ _ _ _ _ _">

                <button type="button" class="btn btn-primary text-bold btn-block mt-4" disabled>
                    <i class="fas fa-check mr-2"></i>Verify Your Email
                </button>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>