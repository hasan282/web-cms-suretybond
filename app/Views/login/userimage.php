<div class="text-center">

    <div class="mx-auto">
        <img class="profile-user-img img-fluid img-circle" src="/image/<?= $userdata['image']; ?>">
    </div>
    <h3 class="profile-username"><?= $userdata['nama']; ?></h3>

    <button type="button" class="btn btn-sm btn-default py-0" onclick="window.location.href='/user/switch'">
        <i class="fas fa-sync-alt mr-2"></i>switch account
    </button>

</div>

<input type="hidden" name="inputuser" value="<?= $userdata['user']; ?>">