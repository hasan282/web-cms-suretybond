<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="mw-6 mx-auto">
    <div class="card">
        <div class="card-body">

            <?php if ($countdown < 60) : ?>
                <div id="sendbox" data-name="<?= csrf_token(); ?>" data-csrf="<?= csrf_hash(); ?>">
                    <div class="mw-5 mx-auto py-3">
                        <p class="mt-4 text-secondary">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                        </p>
                        <p class="text-dark text-sm">Please wait, we will send an OTP code to the email address <strong><?= $userdata['email']; ?></strong>.</p>
                    </div>
                </div>
                <div class="hide-content" id="verifybox">

                    <?= $this->include('setting/verification/form'); ?>
                </div>
                <div class="hide-content" id="sendfailed">

                    <?= $this->include('setting/verification/failed_send'); ?>
                </div>
                <div class="hide-content" id="connectfailed">

                    <?= $this->include('setting/verification/failed_connect'); ?>
                </div>
            <?php else : ?>

                <?= $this->include('setting/verification/form'); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>