<?php

$application_title = 'My Application';

?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $application_title; ?><?= (isset($title)) ? ' · ' . $title : ''; ?></title>

    <link rel="shortcut icon" href="/image/icon/icon-64.png" type="image/png">
    <link rel="icon" href="/image/icon/icon-32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/image/icon/icon-64.png" sizes="64x64" type="image/png">
    <link rel="apple-touch-icon" href="/image/icon/icon-128.png">

    <style>
        .bg-pattern {
            background-image: url("<?= base_url('image/pattern/pattern-light.webp'); ?>");
            background-color: #F4F6F9;
        }

        .bg-pattern-dark {
            background-image: url("<?= base_url('image/pattern/pattern-dark.webp'); ?>");
            background-color: #454D55;
        }
    </style>

    <?= $plugins['head'] ?? ''; ?>

</head>

<?= $this->renderSection('body'); ?>

<script>
    const BaseURL = "<?= base_url(); ?>";
</script>

<?= $plugins['foot'] ?? ''; ?>

<?php
$jscript = $jscript ?? array();
if (is_string($jscript)) $jscript = explode(',', $jscript);
?>
<?php foreach ($jscript as $js) : ?>

    <?php $refresher = env_is('production') ? '' : '?j=s' . mt_rand(1000, 9999); ?>
    <script src="/asset/js/<?= $js; ?>.js<?= $refresher; ?>"></script>

<?php endforeach; ?>

<?= $this->renderSection('script'); ?>

</body>

</html>