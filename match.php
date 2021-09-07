<?php
require "core/user.php";
$user_id = $_GET["id"];
if (!$_GET["id"]) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Match Found</title>
    <?php require_once "includes/styles.html" ?>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main" class="pb-5 bg-white">
        <div class="container p-0 pt-5">
            <?php if (isset($_GET['success'])) : ?>
                <div class="alert alert-success text-center">
                    <?php echo $_GET['success'] ?>    
                </div>
            <?php endif ?>

            <?php if (isset($_GET['error'])) : ?>
                <div class="alert alert-error bg-danger text-white text-center">
                    <?php echo $_GET['error'] ?>    
                </div>
            <?php endif ?>
        </div>
        <div class="container p-0">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Match Record</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">   
                            <h5 class="mb-3">Surname: <strong><?php echo $user->getUserByAppNo($user_id)["surname"] ?></strong></h5>
                            <h5 class="mb-3">First Name:<strong><?php echo $user->getUserByAppNo($user_id)["firstname"] ?></strong></h5>
                            <h5 class="mb-3">Other Names:<strong><?php echo $user->getUserByAppNo($user_id)["othername"] ?></strong></h5>
                            <h5 class="mb-3">Sex:<strong><?php echo $user->getUserByAppNo($user_id)["sex"] ?></strong></h5>
                            <h5 class="mb-3">Age:<strong><?php echo $user->getUserByAppNo($user_id)["age"] ?></strong></h5>
                        </div>
                        <div class="col-md-3 text-center">
                            <img src="<?php echo "photos/" . $user->getUserByAppNo($user_id)['photo'] ?>" width="200" height="200">
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Nationality:<strong><?php echo $user->getUserByAppNo($user_id)["nationality"] ?></strong></h5>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Residential State:<strong><?php echo $user->getUserByAppNo($user_id)["rstate"] ?></strong></h5>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Residential LGA:<strong><?php echo $user->getUserByAppNo($user_id)["rlga"] ?></strong></h5>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Residential Town:<strong><?php echo $user->getUserByAppNo($user_id)["rtown"] ?></strong></h5>
                        </div>


                        <div class="col-md-6">
                            <h5 class="mb-3">Occupation:<strong><?php echo $user->getUserByAppNo($user_id)["occupation"] ?></strong></h5>
                        </div>


                        <div class="col-md-6">
                            <h5 class="mb-3">State of Birth:<strong><?php echo $user->getStateName($user->getUserByAppNo($user_id)["sbirth"])['name'] ?></strong></h5>
                        </div>


                        <div class="col-md-6">
                            <h5 class="mb-3">LGA of Birth:<strong><?php echo $user->getUserByAppNo($user_id)["lgabirth"] ?></strong></h5>
                        </div>


                        <div class="col-md-6">
                            <h5 class="mb-3">Disabled:<strong><?php echo $user->getUserByAppNo($user_id)["disable"] ?></strong></h5>
                        </div>


                        <div class="col-md-6">
                            <h5 class="mb-3">Work Status:<strong><?php echo $user->getUserByAppNo($user_id)["work"] ?></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>

</body>

</html>