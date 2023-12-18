<?php

$userName  = userdata('nama')    ?? 'User Name';
$userImage = userdata('foto')    ?? 'https://avatars.githubusercontent.com/u/47323055';
$userRole  = userdata('role_id') ?? '101';

$brandImage = '/image/icon/icon-64.png';

$navigations = \App\Models\Core\SideMenu::get($userRole);

?>
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <a href="/" class="brand-link link-transparent">
        <img src="<?= $brandImage; ?>" alt="" class="brand-image">
        <span class="brand-text font-weight-lighter">AdminCI <strong>Apps</strong></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $userImage; ?>" class="img-circle elevation-1" alt="">
            </div>
            <div class="info">
                <a href="/#user" class="d-block"><?= $userName; ?></a>
            </div>
        </div>
        <nav class="mt-2 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link<?= url_is('dashboard') ? ' active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">MENU</li>
                <?php foreach ($navigations as $navs) : ?>
                    <li class="nav-item<?= $navs['active'] && !empty($navs['subs']) ? ' menu-open' : ''; ?>">
                        <a href="/<?= $navs['url']; ?>" class="nav-link<?= $navs['active'] ? ' active' : ''; ?>">
                            <i class="nav-icon <?= $navs['icon']; ?>"></i>
                            <p>
                                <?= $navs['text']; ?>
                                <?php if (!empty($navs['subs'])) : ?>
                                    <i class="fas fa-angle-left right"></i>
                                <?php endif; ?>
                            </p>
                        </a>
                        <?php if (!empty($navs['subs'])) : ?>
                            <ul class="nav nav-treeview">
                                <?php foreach ($navs['subs'] as $subs) : ?>
                                    <li class="nav-item">
                                        <a href="/<?= $subs['url']; ?>" class="nav-link<?= $subs['active'] ? ' active' : ''; ?>">
                                            <i class="nav-icon <?= $subs['icon']; ?>"></i>
                                            <p><?= $subs['text']; ?></p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <li class="nav-header">USER</li>
                <li class="nav-item">
                    <a href="/#setting" class="nav-link <?= url_is('setting*') ? ' active' : ''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan Akun</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>