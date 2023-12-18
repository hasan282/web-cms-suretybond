<?= $this->extend('layout/basic'); ?>

<?= $this->section('body'); ?>

<?php
$title = $title ?? 'Menu';
$bread = $bread ?? $title;
?>

<body class="hold-transition sidebar-mini layout-fixed<?= $darkmode ? ' dark-mode' : ''; ?>">
    <div class="wrapper">

        <?= $this->include('layout/navbar'); ?>

        <?= $this->include('layout/sidebar'); ?>

        <div class="content-wrapper bg-pattern<?= $darkmode ? '-dark' : ''; ?>" id="contentwrapper">
            <div class="content-header">
                <div class="container content-box">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                                <?php if (is_array($bread)) : ?>
                                    <?php foreach ($bread as $k => $br) : ?>

                                        <?php if ($k + 1 === sizeof($bread)) : ?>
                                            <li class="breadcrumb-item active"><?= $br; ?></li>
                                        <?php else : ?>
                                            <?php $brs = explode('|', $br); ?>
                                            <li class="breadcrumb-item">
                                                <a href="/<?= $brs[1] ?? ''; ?>"><?= $brs[0]; ?></a>
                                            </li>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (is_string($bread)) : ?>
                                    <li class="breadcrumb-item active"><?= $bread; ?></li>
                                <?php endif; ?>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content pb-4">
                <div class="container content-box">

                    <?= $this->renderSection('content'); ?>

                </div>
            </div>
        </div>

        <footer class="main-footer text-sm">
            <div class="text-center">
                <strong>&copy; <?= date('Y'); ?> <a href="#" target="_blank">App282</a></strong>
                All rights reserved
            </div>
        </footer>

    </div>

    <?= $this->endSection(); ?>