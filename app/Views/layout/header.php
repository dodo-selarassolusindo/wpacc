<!DOCTYPE html>
<!--<html dir="rtl" lang="ar">-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <title><?= 'Accounting v1.0' . ($title != 'Dashboard' ? ' - ' . esc($title) : '') ?></title> -->
    <title><?= 'yAccounting v1.0 - ' . esc($title) ?></title>
    <meta name="description" content="Accounting v1.0">
    <meta name="keyword" content="selaras,solusindo,selusin,accounting,aplikasi,akuntansi">
    <meta name="author" content="selaras solusindo">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= csrf_meta()?>

    <!-- Google Font: Thai Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/css/adminlte.min.css') ?>">
     <!--<link rel="stylesheet" href="<?php /* echo base_url('asset/css/rtl/adminlte.rtl.min.css') */ ?>"> -->

    <!-- SweetAlert2 Bootstrap or Dark -->
    <link rel="stylesheet" href="<?= base_url('asset/css/sweetalert2-dark.min.css') ?>">
    <!-- DataTables -->
 	<link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css') ;?>">
	<link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/Responsive-2.2.9/css/responsive.bootstrap5.min.css') ;?>">

    <link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/StateRestore-1.1.1/css/stateRestore.bootstrap5.min.css') ?>">
    <!-- Dark style -->
    <!--<link rel="stylesheet" href="<?php /* echo base_url('asset/css/dark/adminlte-dark-addon.min.css')*/ ?>">  -->
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/select2/css/select2.min.css') ?>">

    <style media="screen">
        .select2-container {
            width: 100%!important;
            height: 38px!important;
        }

        .select2-selection--single {
            height: 38px!important;
        }

        /* .select2-search--dropdown .select2-search__field {
        width: 98%;
        } */
    </style>
</head>
