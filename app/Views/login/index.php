<?= $this->extend('layout/body_login'); ?>

<?= $this->section('login_box'); ?>

<div class="card">
    <div class="card-body login-card-body">

        <form method="POST">

            <div class="input-group">

                <input type="password" name="in_pass" id="in_pass" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text cursor-pointer showpass" data-target="in_pass" data-show="0">
                        <span class="fas fa-fw fa-eye"></span>
                    </div>
                </div>

            </div>

            <div class="text-center mt-4">

                <button type="submit" class="btn btn-primary btn-block text-bold" disabled>
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