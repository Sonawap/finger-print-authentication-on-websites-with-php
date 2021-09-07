<?php
require "core/user.php";

if (isset($_POST['startApplication'])) {
    $applicationNumber = 'WN-IT-'.rand(2000, 19999);
    $_SESSION['enrollment_applicationnumber'] = $applicationNumber;
    header("Location: biodata.php?application=".$applicationNumber);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Start Application</title>
    <?php require_once "includes/styles.html" ?>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main" style="background: #f4f4f4" class="pb-5">
        <div class="container p-0">
            <h1 class="text-center text-muted pt-5">Enroll Now</h1><hr>
            <div class="con-act text-center mt-5">
                <form method="POST">
                    <button name="startApplication" type="submit" class="btn btn-lg btn-primary text-white">Start New Application</button>
                </form>
                <p class="mt-3 text-muted">This is for new users, if you new to the website and wants to enroll now. Click the start new application button above</p>
            </div>
            <div class="con-act text-center mt-5">
                <a href="continue.php" class="btn btn-lg btn-warning">Continue Application</a>
                <p class="mt-3 text-muted">If you already start your application but you never finished it click continue Appplication above</p>
            </div>
        </div>
    </main><!-- End #main -->

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>

</body>

</html>