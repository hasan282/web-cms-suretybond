<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="mw-6 mx-auto">
    <div class="card">
        <div class="card-body">

            <?php if ($countdown < 60) : ?>
                <div class="text-center" id="sendbox" data-name="<?= csrf_token(); ?>" data-csrf="<?= csrf_hash(); ?>">
                    <p class="mt-4 text-secondary">
                        <i class="fas fa-spinner fa-spin fa-3x"></i>
                    </p>
                    <div class="mw-5 mx-auto pt-3">
                        <p class="text-secondary text-sm">Please wait, we will send an OTP code to the email address <strong><?= $userdata['email']; ?></strong>.</p>
                    </div>
                </div>
                <div class="hide-content" id="verifybox">

                    <?= $this->include('setting/verification/form'); ?>

                </div>
            <?php else : ?>

                <?= $this->include('setting/verification/form'); ?>

            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>