<?php

$id_span_page    = 'halaman';
$id_span_pagemax = 'halaman_max';
$id_select_page  = 'selectpage';
$class_buttons   = 'data-nav';

$page_first      = 'first';
$page_last       = 'last';
$page_previous   = 'prev';
$page_next       = 'next';

?>
<div class="card">
    <div class="card-body py-2">
        <div class="row">

            <div class="col-md d-flex">
                <p class="my-auto mx-md-2 mx-auto text-muted">
                    Halaman
                    <span id="<?= $id_span_page; ?>" class="text-bold text-dark">1</span>
                    dari
                    <span id="<?= $id_span_pagemax; ?>" class="text-bold text-dark">0</span>
                </p>
            </div>

            <div class="col-md text-center">
                <div class="btn-group mt-md-0 mt-3">
                    <button type="button" class="btn btn-secondary <?= $class_buttons; ?>" data-page="first" disabled>
                        <i class="fas fa-angle-double-left"></i>
                    </button>
                    <button type="button" class="btn btn-secondary <?= $class_buttons; ?>" data-page="prev" disabled>
                        <i class="fas fa-angle-left"></i>
                    </button>
                    <select id="<?= $id_select_page; ?>" class="form-control rounded-0" disabled>
                        <option value="1">1</option>
                    </select>
                    <button type="button" class="btn btn-secondary <?= $class_buttons; ?>" data-page="next" disabled>
                        <i class="fas fa-angle-right"></i>
                    </button>
                    <button type="button" class="btn btn-secondary <?= $class_buttons; ?>" data-page="last" disabled>
                        <i class="fas fa-angle-double-right"></i>
                    </button>
                </div>
            </div>

            <div class="col-md"></div>

        </div>
    </div>
</div>