<?php

namespace App\Libraries;

use App\Libraries\Core\Plugin;

class AdminPlugins extends Plugin
{
    protected function plugins()
    {
        $refresh = env_is('production') ? '' : '?plug=in' . mt_rand(1000, 9999);

        $this->plugin('basic', array(
            ['https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback', 'css', 'head'],
            ['/adminlte/asset/css/adminlte.min.css',                   'css', 'head'],
            ['/asset/css/admin.css' . $refresh,                        'css', 'head'],
            ['/adminlte/plugins/jquery/jquery.min.js',                 'js',  'foot'],
            ['/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js', 'js',  'foot'],
            ['/adminlte/asset/js/adminlte.min.js',                     'js',  'foot'],
            ['/asset/jscore/functions.js' . $refresh,                  'js',  'foot']
        ));

        $this->plugin('fontawesome', array(
            ['/adminlte/plugins/fontawesome-free/css/all.min.css', 'css', 'head']
        ));

        $this->plugin('icheck', array(
            ['/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'css', 'head']
        ));

        $this->plugin('ionicon', array(
            ['https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', 'css', 'head']
        ));

        $this->plugin('scrollbar', array(
            ['/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',      'css', 'head'],
            ['/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js', 'js',  'foot']
        ));

        $this->plugin('toastr', array(
            ['/adminlte/plugins/toastr/toastr.min.css', 'css', 'head'],
            ['/adminlte/plugins/toastr/toastr.min.js',  'js',  'foot']
        ));

        $this->plugin('dateinput', array(
            ['/adminlte/plugins/daterangepicker/daterangepicker.css',                             'css', 'head'],
            ['/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'css', 'head'],
            ['/adminlte/plugins/moment/moment.min.js',                                            'js',  'foot'],
            ['/adminlte/plugins/inputmask/jquery.inputmask.min.js',                               'js',  'foot'],
            ['/adminlte/plugins/daterangepicker/daterangepicker.js',                              'js',  'foot'],
            ['/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',   'js',  'foot']
        ));

        $this->plugin('dateinput', array(
            ['/adminlte/plugins/daterangepicker/daterangepicker.css',                             'css', 'head'],
            ['/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'css', 'head'],
            ['/adminlte/plugins/moment/moment.min.js',                                            'js',  'foot'],
            ['/adminlte/plugins/inputmask/jquery.inputmask.min.js',                               'js',  'foot'],
            ['/adminlte/plugins/daterangepicker/daterangepicker.js',                              'js',  'foot'],
            ['/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',   'js',  'foot']
        ));

        $this->plugin('jspdf', array(
            ['https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',         'js', 'foot'],
            ['https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', 'js', 'foot']
        ));

        $this->plugin('pdfmake', array(
            ['/adminlte/plugins/pdfmake/pdfmake.min.js', 'js', 'foot'],
            ['/adminlte/plugins/pdfmake/vfs_fonts.js',   'js', 'foot']
        ));

        $this->plugin('select2', array(
            ['/adminlte/plugins/select2/css/select2.min.css',                         'css', 'head'],
            ['/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css', 'css', 'head'],
            ['/adminlte/plugins/select2/js/select2.full.min.js',                      'js',  'foot']
        ));

        $this->plugin('dropzone', array(
            ['/adminlte/plugins/dropzone/min/dropzone.min.css', 'css', 'head'],
            ['/adminlte/plugins/dropzone/min/dropzone.min.js',  'js',  'foot'],
            ['/asset/js/all/upload.js' . $refresh,              'js',  'foot']
        ));

        $this->plugin('sweetalert', array(
            ['/adminlte/plugins/sweetalert2/sweetalert2.all.min.js', 'js', 'foot']
        ));
    }
}
