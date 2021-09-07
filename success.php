<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Application Succesful</title>
    <?php require_once "includes/styles.html" ?>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main">
        <div class="text-center mt-5 mb-2"><span class="fa fa-check-circle fa-7x text-success"></span></div>
        <h1 class="text-center text-muted">Enrollment Completed</h1><hr>
        <div class="text-center">
            <a class="text-muted" href="index.php"><span class="fa fa-home"></span> Go to Home Page </a><hr>
        </div>
        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success text-center">
                <?php echo $_GET['success'] ?>    
            </div>
        <?php endif ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-error text-center">
                <?php echo $_GET['error'] ?>    
            </div>
        <?php endif ?>
    </main><!-- End #main -->

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>

</body>

</html>