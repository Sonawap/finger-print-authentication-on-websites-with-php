<?php
require '../core/middleware.php';
$middleware->auth();
require '../core/admin.php';
$page = "user";

if (isset($_GET['application'])) {
    $app = $_GET['application'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin - User Match</title>
    <?php include "includes/styles.html" ?>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require "includes/nav.php" ?>

        <?php require 'includes/aside.php' ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Welcome <?php echo $admin->getUserInfo()['username'] ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                                <li class="breadcrumb-item"><a ><?php echo $admin->getUserInfoByApp($app)["Application_no"] ?></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <?php include "includes/matchCard.php" ?>
                </div>
            </div>
        </div>

        <?php require 'includes/footer.php' ?>
    </div>

    <?php include "includes/script.html" ?>
</body>
</html>
