<?php session_start();


if (!(isset($_SESSION['admin']) || isset($_SESSION['councilor']) || isset($_SESSION['doctor']))) {
    header("Location: ./index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>

    <!-- bootstrap link-->
    <!-- <link rel="stylesheet" href="../vendor/bootstrap-5.2.0-dist/css/bootstrap.min.css" type="text/css"> -->

    <script defer src="../js/main.js" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/styles.css" type="text/css">

    <!-- data table  -->
    <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css" />


    <script defer src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <script src="../js/main.js" defer></script> -->
    <?php if (isset($community)) { ?>
        <!--custom css-->
        <!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
        <!--custom responsive css-->
        <!-- <link rel="stylesheet" text="text/css" href="../css/responsive.css"> -->
    <?php } ?>
</head>

<body class="sb-nav-fixed">


    <?php
    $dashboard = "./dashboard.php";

    ?>