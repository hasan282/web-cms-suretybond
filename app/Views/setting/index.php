<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-xl-3 col-md-4">
        <div class="card">
            <div class="card-body box-profile">
                <div class="text-center mb-3">
                    <img class="profile-user-img img-fluid img-circle" src="/image/<?= userdata('foto'); ?>">
                </div>
                <div class=" mw-3 mx-auto">
                    <button class="btn btn-sm btn-default btn-block">
                        <i class="fas fa-edit mr-2"></i>Change Profile Picture
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Account Information</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <tbody>

                        <?= $this->include('setting/account'); ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>