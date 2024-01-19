<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="mw-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/setting">
                    <i class="fas fa-arrow-circle-left mr-2"></i>Back to Settings
                </a>
            </h3>
        </div>
        <div class="card-body">

            <div class="mw-5 mx-auto">

                <div class="form-group">
                    <label for="emailaddr">Your Email Address</label>
                    <input type="email" id="emailaddr" name="emailaddr" class="form-control form-control-border form-control-lg is-invalid" placeholder="Email">
                    <div style="height:25px">
                        <small class="text-danger ml-2" id="errormessage">Lorem ipsum dolor sit amet consectetur</small>
                    </div>
                </div>
                <div>
                </div>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>