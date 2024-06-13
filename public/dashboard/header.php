<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Dasboard";
    include 'layouts/head-content.php';
    ?>
</head>

<body class="layout-boxed alt-menu">
    <?php
    include "layouts/navbar.php";
    ?>

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <?php
        include "layouts/side-bar.php";
        ?>