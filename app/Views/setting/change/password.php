<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="mw-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/setting">
                    <i class="fas fa-chevron-left mr-2"></i>Back to Settings
                </a>
            </h3>
        </div>
        <div class="card-body px-0">
            <div class="mw-5 mx-auto login-card-body">

                <form method="post">
                    <div class="form-group mb-1">
                        <label for="newpass">Create New Password</label>
                        <div class="input-group">
                            <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password">
                            <div class="input-group-append">
                                <div class="input-group-text showpass" data-target="newpass"></div>
                            </div>
                        </div>
                    </div>

                    <div class="px-1 mb-3">
                        <div class="d-flex mb-1">
                            <small id="progresstext" class="text-bold"></small>
                            <small class="ml-auto">
                                <a href="#">How to create strong password?</a>
                            </small>
                        </div>
                        <div class="progress progress-xxs">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmpass">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" name="confirmpass" id="confirmpass" class="form-control" placeholder="Confirm New Password">
                            <div class="input-group-append">
                                <div class="input-group-text showpass" data-target="confirmpass"></div>
                            </div>
                        </div>
                        <div style="height:27px">
                            <small class="ml-2 text-danger" id="errormsg"></small>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary text-bold" disabled>
                            <i class="fas fa-lock mr-2"></i>Change Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>