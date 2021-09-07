<?php
require "../core/admin.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = $admin->login($username, $password);
    if($login) {
        header("Location: dashboard.php");
    }else{
        header("Location: index.php?error=credential does not exist");
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Section - Login</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/vendor/fontawesome/css/all.css" rel="stylesheet">
    <style type="text/css">
        body{
            background: #f4f4f4;
        }
    </style>
</head>

<body>
    <main id="main">
        <div class="col-md-6 offset-md-3 bg-white p-5">
            <h1 class="text-center text-muted pt-5">Admin Login</h1><hr>
            <div class="col-md-6 offset-md-3 con-act text-center mt-5">
                <?php if (isset($_GET['error'])) : ?>
                    <div class="alert alert-error text-center bg-danger text-white">
                        <?php echo $_GET['error'] ?>    
                    </div>
                <?php endif ?>
                <form class="needs-validation" novalidate method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required="" class="form-control" placeholder="Username" value="">
                        <div class="invalid-feedback font-weight-bold">
                            Please enter your Username.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required="" class="form-control" placeholder="Password" value="">
                        <div class="invalid-feedback font-weight-bold">
                            Please enter your Password.
                        </div>
                    </div>
                    <div class="con-act text-center mt-5">
                        <button type="submit" name="login" class="btn btn-lg btn-warning">Login</button>
                    </div>
                </form>
            </div>
            
        </div>
    </main><!-- End #main -->

</body>

</html>