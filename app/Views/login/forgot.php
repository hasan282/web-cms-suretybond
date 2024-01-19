<?= $this->extend('layout/body_login'); ?>

<?= $this->section('login_box'); ?>

<div class="mx-auto mb-3" style="max-width:100px">
    <a href="/" class="link-transparent">
        <img class="img-fluid" src="/image/icon/icon-128.png">
    </a>
</div>
<div class="card">
    <div class="card-body login-card-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <small class="success text-bold text-center"><?= session()->getFlashdata('success') ?></small>
            </div>
        <?php endif; ?>
        <div class="centered-message">
            <p class="login-box-msg text-bold">Reset Password</p>
            <p class="text-center" style="font-size:15px;">We Will Send Your Email To Change Your Password</p>
        </div>
        <form method="POST">
            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('emailerr')) : ?>
                <small class="text-danger text-bold text-center"><?= session()->getFlashdata('emailerr') ?></small>
            <?php endif; ?>

            <div class="input-group mb-3">
                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-envelope"></span>
                    </div>
                    <button type="submit" class="btn btn-primary ml-2">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>