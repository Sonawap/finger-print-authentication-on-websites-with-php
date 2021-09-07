<?php
require "core/user.php";

if (isset($_POST['conApp'])) {
    if ($user->checkConAppNo($_POST['appNo'])) {
        $_SESSION['enrollment_applicationnumber'] = $_POST['appNo'];
        header("Location: biodata.php?application=".$_POST['appNo']);
    }else{
        header("Location: continue.php?error=Application Number does not exist");
    }
    

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Continue your application</title>
    <?php require_once "includes/styles.html" ?>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main" style="background: #f4f4f4" class="pb-5">
        <div class="container p-0">
            <h1 class="text-center text-muted pt-5">Continue Application</h1><hr>
            <?php if (isset($_GET['error'])) : ?>
                <div class="alert alert-error text-center bg-danger text-white">
                    <?php echo $_GET['error'] ?>    
                </div>
            <?php endif ?>
            <div class="col-md-6 offset-md-3 con-act text-center mt-5">
                <form class="needs-validation" novalidate method="POST">
                    <div class="form-group">
                        <label for="appNo">Application Number</label>
                        <input type="text" name="appNo" id="appNo" required="" class="form-control" placeholder="Enter Appliacation Number" value="">
                        <div class="invalid-feedback font-weight-bold">
                            Please enter your Application Number.
                        </div>
                    </div>
                    <div class="con-act text-center mt-5">
                        <button type="submit" name="conApp" class="btn btn-lg btn-warning">Continue Application</button>
                    </div>
                </form>
            </div>
            
        </div>
    </main><!-- End #main -->

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>

</body>

</html>