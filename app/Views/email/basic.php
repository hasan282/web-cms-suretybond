<?php

$imageLogo = 'https://dev-suretybond.ptjis.id/image/icon/icon-128.png';

$recName = $name ?? 'User';
$otPass  = $otp  ?? '666666';

?>

<html>

<head>
    <title>Email</title>
</head>

<body>

    <div style="background-color:#dff8ff;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px">

        <div style="background-color:#ffffff;max-width:600px;padding-top:15px;padding-bottom:15px;padding-left:30px;padding-right:30px;margin-right:auto;margin-left:auto">

            <div style="width:70px;margin-right:auto;margin-left:auto;margin-top:20px;margin-bottom:30px">
                <a href="<?= base_url(); ?>" target="_blank">
                    <img src="<?= $imageLogo; ?>" style="width:100%">
                </a>
            </div>

            <p style="font-weight:bold;font-size:larger">Hello, <?= $recName; ?>.</p>

            <p>The following is the OTP code for verifying your email.</p>

            <div style="max-width:170px;text-align:center;background-color:#e8e8e8;color:#383838;font-weight:bold;font-size:20pt;border-radius:10px;margin-right:auto;margin-left:auto;margin-top:40px;margin-bottom:40px;padding-top:10px;padding-bottom:10px">
                <?= implode(' ', str_split($otPass)); ?>
            </div>

            <p>Please promptly enter the OTP code in the provided form, this OTP code is only valid for 5 minutes after the email is sent.</p>

        </div>
        <div style="max-width:600px;padding-top:5px;padding-bottom:5px;padding-left:30px;padding-right:30px;margin-right:auto;margin-left:auto;text-align:center">

            <p>&copy; <?= date('Y'); ?> <b>PT Jasmine Indah Servistama</b></p>
            <p><small>Jl. Nusantara No.1B, Pasir Gunung, Kec. Cimanggis, Depok 16451</small></p>

        </div>

    </div>

</body>

</html>