<?php

$mail_title    = $mail_title    ?? 'Pengiriman Email';
$mail_receiver = $mail_receiver ?? 'Penerima Email';

$mail_content  = $mail_content  ?? 'Berikut adalah link yang kami kirim :';
$mail_link     = $mail_link     ?? 'https://suretybond.ptjis.id/';

$button_text   = $button_text   ?? 'Klik Disini untuk Daftar';

?>
<html>

<head>
    <title>Email</title>
</head>

<body>
    <div style=" background-color:#f3f3f3;width: 100%;padding-top:15px;padding-bottom:15px">
        <div style="background-color:#ffffff;max-width: 600px;margin-left: auto;margin-right:auto;border: solid 1px #deeaff;padding:10px">
            <div style="max-width:280px;margin-left:auto;margin-right:auto;padding:10px">
                <a href="<?= base_url(); ?>" target="_blank">
                    <img src="https://suretybond.ptjis.id/image/icon/suretybond.png" style="width:100%">
                </a>
            </div>
            <hr style="border: solid 1px #deeaff">
            <h2 style="text-align:center"><?= $mail_title; ?></h2>
            <p>Halo, <?= $mail_receiver; ?></p>
            <p><?= $mail_content; ?></p>
            <p><a target="_blank" href="<?= $mail_link; ?>"><?= $mail_link; ?></a></p>
            <div style="text-align:center">
                <a target="_blank" href="<?= $mail_link; ?>">
                    <div style="
                    background-color:#0a66c2;
                    border:0;
                    border-radius:100px;box-sizing:border-box;color:#ffffff;cursor:pointer;display:inline-flex;font-size:16px;font-weight:600;line-height:20px;max-width:480px;min-height:40px;min-width:0px;overflow:hidden;padding:15px;padding-left:20px;padding-right:20px;text-align:center"><?= $button_text; ?></div>
                </a>
            </div>
            <p style="margin-bottom:0">Salam Hangat,</p>
            <p style="margin-top:0">Admin Suretybond PTJIS</p>
            <hr style="border: solid 1px #deeaff">
            <div style="text-align:center;color:#5a5a5a">
                <p style="margin-bottom:0;font-weight:bold">PT Jasmine Indah Servistama</p>
                <p style="color:#7d7d7d;margin-top:0">
                    <small>
                        Jl. Nusantara No.1B, Pasir Gunung, Kec. Cimanggis, Depok, Jawa Barat 16451
                    </small>
                </p>
            </div>
        </div>
    </div>
</body>

</html>