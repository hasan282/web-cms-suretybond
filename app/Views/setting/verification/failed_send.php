<?php
$emoteURL = base_url('image/content/emote-cry.png');
?>

<div style="height:200px;background-image:url('<?= $emoteURL; ?>');background-size: 150px;background-repeat:no-repeat;background-position:center"></div>
<div class="mw-5 mx-auto pt-3">
    <p class="text-dark">
        We apologize, but we are unable to send the email containing the OTP code due to some reasons. Please try resending the email or contact the administrator for assistance.
    </p>
    <button type="button" class="btn btn-default btn-sm text-bold my-3" onclick="window.location.reload()">
        Resend OTP Code<i class="fas fa-share ml-2"></i>
    </button>
</div>