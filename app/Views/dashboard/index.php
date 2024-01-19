<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>
<style>
    .icon {
        padding-left: 25px;
        background: url("https://static.thenounproject.com/png/101791-200.png") no-repeat left;
        background-size: 20px;
        background-position: 85px;
    }
</style>
<div class="col-xl-12 col-md-9">
    <div class="card">
        <div class=" card-body" style="display: flex; flex-direction: row; height:360px ">
            <div style="flex: 1; margin: 10px; padding: 15px;  ">
                <div class="d-flex">
                    <input type="search" name="q" style="border-radius: 6px; padding: 5px; border: 1px solid #ccc; width: 25%;" placeholder="12/2024" class="icon">
                    <p class="ml-3">Lorem Ipsum</p>
                    <p>100</p>
                </div>
            </div>
            <div class="card" style="width: 530px;">
                <div class=" card-body" style="flex: 1; margin: 10px; padding: 15px;  height:300px">
                    <div class="d-flex" style="min-height:93px">
                        <h6 class="text-secondary my-auto mx-auto">Tidak ada Notifikasi</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="width: 530px;">
        <div class="card-body" style="top:10px; margin: 10px; padding: 15px; height:200px; width:510px">
            <div class="d-flex" style="min-height:93px">
                <h6 class="text-secondary my-auto mx-auto">Tidak ada Notifikasi</h6>
            </div>
        </div>
    </div>
</div>






<?= $this->endSection(); ?>