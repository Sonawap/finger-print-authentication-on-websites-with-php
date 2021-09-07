<?php
require '../core/middleware.php';
$middleware->auth();
require '../core/admin.php';
$page = "query";

if (isset($_GET['application'])) {
    $app = $_GET['application'];
}

$states = $user->getStates();
$states2 = $user->getStates();

if (isset($_POST['submitLGA'])) {
    $lga = $_POST['rlga'];

    header("Location: lgaResult.php?lga=".$lga);
}

if (isset($_POST['submitState'])) {
    $state = $_POST['rstate'];

    header("Location: stateResult.php?state_id=".$state);
}


require '../vendor/autoload.php';
use cloudabis_sdk\ApiManager\CloudABISAPI;
use cloudabis_sdk\Models\CloudABISBiometricRequest;
use cloudabis_sdk\Models\EnumOperationName;
use cloudabis_sdk\Utilities\CloudABISConstant;
use cloudabis_sdk\Utilities\CloudABISResponseParser;

require_once "../core/credential.php";
//Read token from CloudABIS Server
$cloudABISAPI = new CloudABISAPI(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL);
$token = $cloudABISAPI->GetToken();
if ( ! is_null($token) && isset($token->access_token) != "" )
    $_SESSION['access_token'] = $token->access_token;
else
    echo("CloudABIS Not Authorized!. Please check credentails");
if (isset($_POST['submitFinger'])) {
    $templateXML = $_POST['templateXML'];
    if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->BiometricXml = $templateXML;
        $biometricRequest->CustomerKey = CloudABISCustomerKey;
        $biometricRequest->EngineName = ENGINE_NAME;
        $biometricRequest->Format = TEMPLATE_FORMAT;
        $biometricRequest->Token = $_SESSION['access_token'];
        $cloudABISAPI = new CloudABISAPI(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL);
        $matchingResponse = $cloudABISAPI->Identify($biometricRequest);
        if ($matchingResponse != null) {
            $matchingResponseInJsonObject = json_decode($matchingResponse);
            if ($matchingResponseInJsonObject->OperationName == EnumOperationName::Identify
            && $matchingResponseInJsonObject->OperationResult == CloudABISConstant::MATCH_FOUND) {
                header("Location: user.php?application=".$matchingResponseInJsonObject->BestResult->ID);
                // echo(CloudABISResponseParser::GetResponseMessage($matchingResponseInJsonObject->OperationResult) . ": " . $matchingResponseInJsonObject->BestResult->ID);
            } else {
                header("Location: query.php?error=No Match found!");
                // echo(CloudABISResponseParser::GetResponseMessage($matchingResponseInJsonObject->OperationResult));
            }
        } else {
            header("Location: query.php?error=Something went wrong!");
        }
    } else {
        header("Location: query.php?error=Access token not found!");
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin - User Match</title>
    <?php include "includes/styles.html" ?>
    <script src='../scripts/CloudABIS-ScanR.js'> </script>
    <script src='../scripts/CloudABIS-Helper.js'> </script>
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
                                <li class="breadcrumb-item"><a>Query</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Query with LGA</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="rstate2">Residential State</label>
                                            <select name="rstate2" id="rstate2" required="" class="form-control">
                                                <?php while($row = $states->fetch_assoc()) : ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php endwhile ?>
                                            </select>
                                            <div class="invalid-feedback font-weight-bold">
                                                Please enter your residential state.
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="lga">Residential LGA <small style="display: none;" id="loading">Loading LGA ...</small></label>
                                            <select name="rlga" id="rlga" required="" class="form-control">
                                                
                                            </select>
                                            <div class="invalid-feedback font-weight-bold">
                                                Please enter your residential LGA.
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button class="form-control btn btn-warning" name="submitLGA" type="submit" role="button">Query by LGA</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Query with State</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="rstate">Residential State</label>
                                            <select name="rstate" id="rstate" required="" class="form-control">
                                                <?php while($row = $states2->fetch_assoc()) : ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php endwhile ?>
                                            </select>
                                            <div class="invalid-feedback font-weight-bold">
                                                Please enter your residential state.
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button class="form-control btn btn-warning" name="submitState" type="submit" role="button">Query by State</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Query with Fingerprint</h4>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-success text-center" id="serverResult"></div>
                                    <?php if (isset($_GET['success'])) : ?>
                                        <div class="alert alert-success text-center">
                                            <?php echo $_GET['success'] ?>    
                                        </div>
                                    <?php endif ?>

                                    <?php if (isset($_GET['error'])) : ?>
                                        <div class="alert alert-error text-center bg-danger text-white">
                                            <?php echo $_GET['error'] ?>    
                                        </div>
                                    <?php endif ?>
                                    <form method="POST" action="">
                                        <label>Capture Type:</label>
                                        <select name="captureType" class="form-control mb-5" id="captureType">
                                            <option value="SingleCapture">Single Capture</option>
                                            <option value="DoubleCapture">Double Capture</option>
                                        </select>

                                        <label>Quick Scan:</label>
                                        <input type="hidden" name="quickScan" id="quickScan" value="Disable">
                                        <!-- <select name="quickScan" class="form-control mb-5" id="quickScan">
                                            <option value="Enable">Enable</option>
                                            <option value="Disable">Disable</option>
                                        </select> -->
                                        <label id="lblCurrentDeviceName">Current Device Name:</label>
                                        <input type="button" class="form-control btn btn-primary" name="biometricCapture" value="Biometric Capture" onclick="captureBiometric('Identify')">

                                        <div class="text-center mt-5 mb-5">
                                            <button class="form-control btn btn-info" name="submitFinger" type="submit" role="button">Submit</button>
                                        </div>

                                        <input type="hidden" name="templateXML" id="templateXML" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require 'includes/footer.php' ?>
    </div>

    <?php include "includes/script.html" ?>
    <?php include "includes/script.html" ?>
    <script type="text/javascript">
        var state = document.getElementById('rstate2');

        $('#rstate2').change(function(){
            $('#loading').css("display", "block");
            var state_id = state.options[state.selectedIndex].value;
            $('#rlga').load('../core/function.php?state_id='+state_id);
            $('#loading').css("display", "none");

        })
    </script>
</body>
</html>
