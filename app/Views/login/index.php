<?= $this->extend('layout/body_login'); ?>

<?= $this->section('login_box'); ?>


<div class="card">
    <div class="card-body login-card-body">

        <form method="POST">

            <div class="text-center">

                <button type="submit" class="btn btn-primary btn-block text-bold" disabled>
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>

            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>