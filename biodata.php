<?php
require "core/user.php";
if (isset($_GET['application']) and $_SESSION['enrollment_applicationnumber'] == $_GET['application']) {
    $applicationNumber = $_GET['application'];
}else{
    header("Location: start.php");
}
if (isset($_POST['submitForm'])) {
    $surname  = $_POST['surname'];
    $othername  = $_POST['othername'];
    $firstname  = $_POST['firstname'];
    $age  = $_POST['age'];
    $sex  = $_POST['sex'];
    $nationality  = $_POST['nationality'];
    $rstate  = $_POST['rstate'];
    $rlga  = $_POST['rlga'];
    $rtown  = $_POST['rtown'];
    $occupation  = $_POST['occupation'];
    $sbirth  = $_POST['bstate'];
    $lgabirth  = $_POST['blga'];
    $disable  = $_POST['disabled'];
    $work  = $_POST['work'];

    if ($user->checkAppNo()) {
        try{ 
            $run = $user->updateBio($surname, $firstname, $othername, $age, $sex, $nationality, $rstate, $rlga, $rtown, $occupation, $sbirth, $lgabirth, $disable, $work);

            if ($run) {
                header("Location: photo.php?success=Bio-Data Saved&application=".$applicationNumber);
            }else{
                header("Location: start.php?message=An error occured, try again");
            }
        }catch(Exception $e){
            header("Location: start.php?message=An error occured, try again");
        }
    }else{
        try{
            $run = $user->register($surname, $firstname, $othername, $age, $sex, $nationality, $rstate, $rlga, $rtown, $occupation, $sbirth, $lgabirth, $disable, $work);

            if ($run) {
                header("Location: photo.php?success=Bio-Data Saved&application=".$applicationNumber);
            }else{
                header("Location: start.php?message=An error occured, try again");
            }
        }catch(Exception $e){
            header("Location: start.php?message=An error occured, try again");
        }
    }
     
}

$states = $user->getStates();
$states2 = $user->getStates();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add BioMetrics</title>
    <?php require_once "includes/styles.html" ?>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main" style="background: #f4f4f4" class="pb-5">
        <div class="container p-0">
            <h1 class="text-center text-muted pt-5">Start Application <br><small>[Your Application Number is <?php echo $applicationNumber ?>]</small></h1><hr>
            <h3 class="text-center bg-dark text-white p-4 mt-5">1. Bio-Data</h3><hr>
        </div>
            <form class="needs-validation" novalidate method="POST">  
                <div class="container bg-white">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" name="surname" id="surname" required="" class="form-control" placeholder="Enter Surname" value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['surname'] : ""?>">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your surname.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" required="" class="form-control"  value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['firstname'] : ''?>" placeholder="Enter first name">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your first name.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="othername">Other Names</label>
                                <input type="text" name="othername" id="othername" required="" class="form-control" placeholder="Enter other names" value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['othername'] : ''?>">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your other names.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Current Age</label>
                                <input type="number" name="age" id="age" required="" class="form-control" placeholder="Enter current age" value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['age']: ''?>">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your current age.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select name="sex" id="sex" required="" class="form-control">
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Others</option>
                                </select>
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your sex.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" name="nationality" id="nationality" required="" class="form-control" value="NIgeria" readonly="">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your nationality e.g Nigeria, Ghana etc.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rstate">Residential State</label>
                                <select name="rstate" id="rstate" required="" class="form-control">
                                    <?php while($row = $states->fetch_assoc()) : ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your residential state.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lga">Residential LGA <small style="display: none;" id="loading">Loading LGA ...</small></label>
                                <select name="rlga" id="rlga" required="" class="form-control">
                                    
                                </select>
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your residential LGA.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rtown">Residential Town</label>
                                <input type="text" name="rtown" id="rtown" required="" class="form-control" placeholder="Enter residential town"  value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['rtown'] : ''?>">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your residential town.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" id="occupation" required="" class="form-control" placeholder="Enter Occupation" value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['occupation'] : ''?>">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your Occupation.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bstate">State of Birth</label>
                                <select name="bstate" id="bstate" required="" class="form-control" value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['sbirth'] : ''?>">
                                    <?php while($row = $states2->fetch_assoc()) : ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your state of birth.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="blga">LGA of Birth</label>
                                <input type="text" name="blga" id="blga" required="" class="form-control" placeholder="Enter LGA of Birth" value="<?php echo $user->checkAppNo() ? $user->getUserInfoByApp()['lgabirth'] : ''?>">
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your LGA of Birth.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex">Disbaled</label>
                                <select name="disabled" id="disabled" required="" class="form-control">
                                    <option>YES</option>
                                    <option>NO</option>
                                </select>
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter Disablity Status.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex">Work Status</label>
                                <select name="work" id="work" required="" class="form-control">
                                    <option>Employed</option>
                                    <option>Unemployed</option>
                                </select>
                                <div class="invalid-feedback font-weight-bold">
                                    Please enter your current age.
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="text-center mt-5">
                    <button class="btn btn-lg btn-warning" name="submitForm" type="submit" role="button">Continue Application</button>
                </div>
              
            </form>
    </main><!-- End #main -->

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>
    <script type="text/javascript">
        var state = document.getElementById('rstate');

        $('#rstate').change(function(){
            $('#loading').css("display", "block");
            var state_id = state.options[state.selectedIndex].value;
            $('#rlga').load('core/function.php?state_id='+state_id);
            $('#loading').css("display", "none");

        })
    </script>

</body>

</html>