<?= $this->extend('layout/body_login'); ?>

<?= $this->section('login_box'); ?>

<div class="mx-auto pb-3" style="max-width:100px">
    <a href="/" class="link-transparent">
        <img class="img-fluid" src="/image/icon/icon-128.png">
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="text-center mb-3">To continue, first verify it's you.</div>
        <hr>
        <div class="text-center text-bold pb-2"><?= userdata('nama'); ?></div>

        <form method="post">
            <div class="lockscreen-item elevation-1">
                <div class="lockscreen-image elevation-2">
                    <img src="/image/<?= userdata('foto'); ?>">
                </div>
                <input type="hidden" name="destination" value="<?= $uri; ?>">

                <div class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="password" id="inputpassverif" name="inputpassverif" class="form-control" placeholder="Your Password">
                        <div class="input-group-append">
                            <button type="button" class="btn showpass text-muted" data-target="inputpassverif"></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center pt-3">
                <button class="btn btn-primary text-bold" type="submit">
                    <i class="fas fa-check mr-2"></i>Confirm Password
                </button>
            </div>
        </form>
    </div>

    <div class="card-footer text-center">
        Not your account? <a href="/logout">Sign Out Account</a>.
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