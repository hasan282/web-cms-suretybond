<?= $this->extend('layout/body_login'); ?>

<?= $this->section('login_box'); ?>

<?php

$invalidUser = $flash['invalid'] == 'user' ? ' is-invalid' : '';
$invalidPass = $flash['invalid'] == 'pass' ? ' is-invalid' : '';

?>

<div class="mx-auto mb-3" style="max-width:100px">
    <a href="/" class="link-transparent">
        <img class="img-fluid" src="/image/icon/icon-128.png">
    </a>
</div>

<div class="card">
    <div class="card-body login-card-body">
        <form method="post">

            <input type="hidden" name="urrequest" value="<?= $flash['url']; ?>">
            <?= csrf_field(); ?>

            <?php if ($userdata === null) : ?>

                <div><small class="text-secondary ml-2" id="inputuser_label"></small></div>
                <input type="text" name="inputuser" id="inputuser" placeholder="Username or Email" class="form-control login-input<?= $invalidUser; ?>" value="<?= $flash['username']; ?>">

            <?php else : ?>

                <?= $this->include('login/userimage'); ?>

            <?php endif; ?>

            <div>
                <small class="text-secondary ml-2" id="inputpass_label"></small>
            </div>
            <div class="input-group">
                <input type="password" name="inputpass" id="inputpass" class="form-control login-input<?= $invalidPass; ?>" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text showpass" data-target="inputpass"></div>
                </div>
            </div>

            <div style="height:27px" class="text-center text-danger mt-2">
                <small id="failmessage" data-input="inputpass"><?= $flash['message']; ?></small>
            </div>

            <div class="text-center mt-2">

                <button type="submit" id="loginbutton" class="btn btn-primary btn-block text-bold" disabled>
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>

                <p class="text-sm mb-0 mt-2">Forget your Password? <a href="#" class="text-bold">Click Here</a></p>

            </div>
        </form>
    </div>
</div>
<div class="py-2 d-flex">
    <div class="theme-switch-wrapper mx-auto">
        <label class="theme-switch" for="darkswitch">
            <input <?= $darkmode ? 'checked ' : ''; ?>type="checkbox" id="darkswitch">
            <div class="switch-slider switch-round"></div>
        </label>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(function() {
        setInterval(() => {
            window.location.reload()
        }, 3e5);
        let t = () => "" == $("#inputuser").val() || "" == $("#inputpass").val();
        $("input.login-input").on("input", function() {
            let i = $(this).attr("id"),
                a = $(this).attr("placeholder");
            $(this).removeClass("is-invalid"), $("#failmessage").data("input") == i && $("#failmessage").data("input", "0").html(""), $("#" + i + "_label").html("" == $("#" + i).val() ? "" : a), $("#loginbutton").prop("disabled", t())
        }), $('form[method="post"]').on("submit", function(i) {
            t() && i.preventDefault()
        });
        if ($("#inputuser").val() != '') $("#inputuser").trigger("input");
    });
</script>
<?= $this->endSection(); ?>