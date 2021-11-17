<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/config/header.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ADMIN_TITLE ?> || <?php echo(isset($page_title))? $page_title : 'Admin Panel' ?> </title>

    <!-- Bootstrap -->
    <link href="<?php echo ADMIN_VENDORS_URL; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo ADMIN_VENDORS_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo ADMIN_VENDORS_URL; ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo ADMIN_VENDORS_URL; ?>animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo ADMIN_CSS_URL; ?>custom.min.css" rel="stylesheet">
  </head>
  <!-- jQuery -->
    <script src="<?php echo ADMIN_VENDORS_URL;?>jquery/dist/jquery.min.js"></script>

  <body class="<?php echo (getCurrentPage()=='index')? 'login':'nav-md'; ?>">