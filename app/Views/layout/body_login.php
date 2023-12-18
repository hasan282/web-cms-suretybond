<?= $this->extend('template/basic'); ?>

<?= $this->section('body'); ?>

<body class="hold-transition login-page<?= $darkmode ? ' dark-mode' : ''; ?> bg-pattern<?= $darkmode ? '-dark' : ''; ?>" id="contentwrapper">
    <div class="login-box">

        <?= $this->renderSection('login_box'); ?>

    </div>
    <?= $this->endSection(); ?>