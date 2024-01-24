<?php
$backgroundURL = base_url('image/content/lost-connection.png');
?>

<div style="height:200px;background-image:url('<?= $backgroundURL; ?>');background-size: 230px;background-repeat:no-repeat;background-position:center"></div>
<div class="mw-5 mx-auto pt-3">
    <p class="text-dark">
        Unable to connect to the server, please check your internet connection again or contact the administrator for further assistance.
    </p>
    <button type="button" class="btn btn-default btn-sm text-bold my-3" onclick="window.location.reload()">
        <i class="fas fa-sync-alt mr-2"></i>Reload this page
    </button>
</div>