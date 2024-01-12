<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<?php

$pattern     = '9 9 9 9 9 9';
$placeholder = '_ _ _ _ _ _';

?>

<style>
    .open-email-picture {
        background-image: url('<?= base_url('image/content/openmail.gif'); ?>');
        background-color: #fff;
        background-size: 270px;
        background-repeat: no-repeat;
        background-position: center;
        height: 170px;
        border-radius: 12px;
    }

    .dark-mode .open-email-picture {
        opacity: 0.2;
    }
</style>

<div class="mw-6 mx-auto">

    <div class="card">
        <div class="card-body">

            <div class="text-center">

                <div class="open-email-picture"></div>

                <p class="text-secondary text-sm mb-0">We have sent an email containing the OTP code to the address <strong>admin@ptjis.id</strong>.</p>
                <p class="text-secondary text-sm">Please check your email and enter the OTP code below.</p>

            </div>

            <form method="post">

                <div class="mw-2 mx-auto">
                    <input type="text" name="verifyotp" class="form-control form-control-lg text-center inputmask text-bold" data-inputmask='"mask":"<?= $pattern; ?>"' placeholder="<?= $placeholder; ?>">

                    <button type="submit" id="submitotp" class="btn btn-primary text-bold btn-block mt-4" disabled>
                        <i class="fas fa-check mr-2"></i>Verify Your Email
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    $(function() {

        $('.inputmask').inputmask().on('input', function() {
            const VALUE = $(this).val();
            const parse = val => parseInt(val.replace(/[_\s+]/g, ''));
            $('#submitotp').prop('disabled', VALUE == '' || parse(VALUE) < 100000);
        });

    });
</script>

<?= $this->endSection(); ?>