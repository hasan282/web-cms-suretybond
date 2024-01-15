<?= $this->extend('layout/basic'); ?>

<?= $this->section('body'); ?>

<body class="hold-transition login-page<?= $darkmode ? ' dark-mode' : ''; ?> bg-pattern">
    <div class="login-box">

        <?= $this->renderSection('login_box'); ?>

    </div>
    <?= $this->endSection(); ?>