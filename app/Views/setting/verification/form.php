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
        background-position: center top;
        border-radius: 12px;
    }

    .dark-mode .open-email-picture {
        filter: invert(0.8);
    }
</style>

<div class="text-sm-center mb-2">
    <div class="open-email-picture">
        <div style="height:170px"></div>
        <div class="py-1">
            <p class="text-secondary text-sm mb-0">We have sent an email containing the OTP code to the address <strong><?= $userdata['email']; ?></strong>.</p>
            <p class="text-secondary text-sm">Please check your email and enter the OTP code below.</p>
        </div>
    </div>
    <div style="height:27px">
        <p class="text-primary mb-0" id="countdown" data-cd="<?= $countdown; ?>"></p>
    </div>
</div>
<form method="post">
    <div class="mw-2 mx-auto">
        <input type="text" name="verifyotp" class="form-control form-control-lg text-center inputmask text-bold" data-inputmask='"mask":"<?= $pattern; ?>"' placeholder="<?= $placeholder; ?>">
        <button type="submit" id="submitotp" class="btn btn-primary text-bold btn-block mt-4" disabled>
            <i class="fas fa-check mr-2"></i>Verify Your Email
        </button>
    </div>
</form>