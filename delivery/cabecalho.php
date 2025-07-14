<?php
require_once("sistema/conexao.php");
require_once(__DIR__ . "/helper/tenant_helper.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $nome_sistema ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="delivery interativo, pedir sanduíche" />
    <meta name="description" content="Temos sanduíches de qualidade.." />
    <meta name="author" content="Hugo Vasconcelos" />

    <link rel="shortcut icon" href="<?php echo BASE_URL_STATIC ?>siste../img/icone1.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/spacing.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/icon-dukamarket.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_STATIC ?>assets/css/style.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- Seu CSS personalizado -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL_STATIC ?>css/style.css">

    <!-- JQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap 4 (caso ainda esteja usando) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
