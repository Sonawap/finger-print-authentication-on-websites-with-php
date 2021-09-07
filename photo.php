<?php
require "core/user.php";
if (isset($_GET['application']) and $_SESSION['enrollment_applicationnumber'] == $_GET['application']) {
    $applicationNumber = $_GET['application'];
}else{
    header("Location: start.php");
}
if (isset($_POST['submitForm'])) {
    $image_type=$_FILES['pic']['name'];
    $type = $_FILES['pic']['name'];
    if($image_type==""){
        $status_message = 'Select Image first';
        header("Location: photo.php?error=".$status_message);
        exit();
        }
        $image_format = "image/jpeg";
        if($_FILES['pic']['type'] != $image_format)
        {
        //header("location:joinus.php?m=NOTICE:Uploaded file not image");
            $status_message = 'File not image';
            header("Location: photo.php?error=".$status_message);
        exit();
    }

    if ($_FILES['pic']['size'] >10000000 ){
         //300,000=300kb
            $status_message = 'File too large';
           header("Location: photo.php?error=".$status_message);
        exit();
    }else
        {
        $temp_file = $_FILES['pic']['tmp_name'];
        $destination = 'photos'."/".$_FILES['pic']['name'];
        move_uploaded_file($temp_file,$destination);
        $pic=$_FILES['pic']['name'];
        
        $run = $user->updatePhoto($pic);

        if ($run) {
            header("Location: fingerprint.php?success=Photo added sucessfully&application=".$applicationNumber);
        }else{
            header("Location: photo.php?message=An error occured, try again");
        }
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add profile Image</title>
    <?php require_once "includes/styles.html" ?>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main" style="background: #f4f4f4" class="pb-5">
        <div class="container p-0">
            <h1 class="text-center text-muted pt-5">Start Application <br><small>[Your Application Number is <?php echo $applicationNumber ?>]</small></h1><hr>
            <h3 class="text-center bg-dark text-white p-4 mt-5">2. Add Passport</h3><hr>
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
        </div>
        <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data">  
            <div class="container bg-white pt-5">

                <div class="form-group p-5">
                    <label for="surname">Select an image</label>
                    <input type="file" name="pic" required class="form-control">
                    <div class="invalid-feedback font-weight-bold">
                        Select an image.
                    </div>
                </div>
                
            </div>
            <div class="text-center mt-5 mb-5">
                <button class="btn btn-lg btn-warning" name="submitForm" type="submit" role="button">Save & Continue Application</button>
            </div>
        </form>
    </main><!-- End #main -->

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>

</body>

</html>