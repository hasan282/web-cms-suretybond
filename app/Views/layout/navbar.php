<?php

$userName    = userdata('nama')  ?? 'User Name';
$userImage   = userdata('foto')  ?? 'default/USER000M.jpg';
$userSubInfo = userdata('agent') ?? 'PT ABC Indonesia';

$navMenu = array(
    ['menu' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'fas fa-tachometer-alt'],
    ['menu' => 'Searching', 'url' => '#search', 'icon' => 'fas fa-search']
);

?>
<nav class="main-header navbar navbar-expand <?= $darkmode ? 'navbar-dark' : 'navbar-white navbar-light'; ?>">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <?php foreach ($navMenu as $nm) : ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= $nm['url']; ?>" class="nav-link<?= url_is($nm['url'] . '*') ? ' active' : ''; ?>">
                    <i class="<?= $nm['icon']; ?> mr-2"></i><?= $nm['menu']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item d-flex px-3">
            <div class="theme-switch-wrapper my-auto">
                <label class="theme-switch" for="darkswitch">
                    <input <?= $darkmode ? 'checked ' : ''; ?>type="checkbox" id="darkswitch">
                    <div class="switch-slider switch-round"></div>
                </label>
            </div>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="/image/<?= $userImage; ?>" class="user-image img-circle elevation-1" alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header">
                    <img src="/image/<?= $userImage; ?>" class="img-circle elevation-2" alt="">
                    <p><?= $userName; ?></p>
                    <small><?= $userSubInfo; ?></small>
                </li>
                <li class="user-footer">
                    <a href="/setting" class="btn btn-default btn-flat">
                        <i class="fas fa-cog mr-1"></i>Settings
                    </a>
                    <a href="/logout" class="btn btn-default btn-flat float-right">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>