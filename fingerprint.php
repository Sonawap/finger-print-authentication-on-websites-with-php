<?php
    error_reporting(0);
    session_start();
    if (isset($_GET['application']) and $_SESSION['enrollment_applicationnumber'] == $_GET['application']) {
        $applicationNumber = $_GET['application'];
    }else{
        header("Location: start.php");
    }
    require 'vendor/autoload.php';
    use cloudabis_sdk\ApiManager\CloudABISAPI;
    use cloudabis_sdk\Models\CloudABISBiometricRequest;
    use cloudabis_sdk\Models\EnumOperationName;
    use cloudabis_sdk\Utilities\CloudABISConstant;
    use cloudabis_sdk\Utilities\CloudABISResponseParser;

    require_once "core/credential.php";
    //Read token from CloudABIS Server
    $cloudABISAPI = new CloudABISAPI(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL);
    $token = $cloudABISAPI->GetToken();
    if ( ! is_null($token) && isset($token->access_token) != "" )
        $_SESSION['access_token'] = $token->access_token;
    else
        echo("CloudABIS Not Authorized!. Please check credentails");
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add fingerprint</title>
</head>
<?php require_once "includes/styles.html" ?>
<!-- <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'> </script> -->
<script src='scripts/jquery.min.js' type='text/javascript'> </script>
<script src='scripts/CloudABIS-ScanR.js'> </script>
<script src='scripts/CloudABIS-Helper.js'> </script>
<body>
    <?php include "includes/header.php" ?>
    <main id="main" style="background: #f4f4f4" class="pb-5">
        <div class="container p-0">
            <h1 class="text-center text-muted pt-5">Continue Application</h1><hr>
            <h3 class="text-center bg-dark text-white p-4 mt-5">3. BioMetric Capture</h3><hr>
            <div class="alert alert-success text-center" id="serverResult"></div>
            <?php if (isset($_GET['error'])) : ?>
                <div class="alert alert-danger text-center">
                    <?php echo $_GET['error'] ?>    
                </div>
            <?php endif ?>
        </div>

        <div class="mt-10 p-5">
            <form method="POST" action="">
                <div class="container bg-white p-5">
                    <label>Capture Type:</label>
                    <select name="captureType" class="form-control mb-5" id="captureType">
                        <option value="SingleCapture">Single Capture</option>
                        <option value="DoubleCapture">Double Capture</option>
                    </select>
                    
                    <label id="lblCurrentDeviceName">Current Device Name:</label>
                    <input type="button" class="form-control btn btn-primary" name="biometricCapture" value="Biometric Capture" onclick="captureBiometric('Register')">

                    

                    <input type="hidden" name="templateXML" id="templateXML" value="">
                </div>
                <div class="text-center mt-5">
                    <button class="btn btn-lg btn-warning" name="submitForm" type="submit" role="button">Submit Bio-Metric and Next</button>
                </div>
            </form>
        </div>
    </main>

    <?php
        if (isset($_POST['submitForm'])) {
            require_once "core/user.php";
            try{
                // $user->updatePrint($_SESSION['enrollment_applicationnumber']);
                $templateXML = $_POST['templateXML'];
                if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
                    $biometricRequest = new CloudABISBiometricRequest();
                    $biometricRequest->RegistrationID = $_SESSION['enrollment_applicationnumber'];
                    $biometricRequest->BiometricXml = $templateXML;
                    $biometricRequest->CustomerKey = CloudABISCustomerKey;
                    $biometricRequest->EngineName = ENGINE_NAME;
                    $biometricRequest->Format =  TEMPLATE_FORMAT;
                    $biometricRequest->Token = $_SESSION['access_token'];
                    $cloudABISAPI = new CloudABISAPI(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL);
                    $matchingResponse = $cloudABISAPI->Register($biometricRequest);
                    if ($matchingResponse != null) {
                        $matchingResponseInJsonObject = json_decode($matchingResponse);
                        if ($matchingResponseInJsonObject->OperationName == EnumOperationName::Register
                        && $matchingResponseInJsonObject->OperationResult == CloudABISConstant::SUCCESS) {
                            $user->updatePrint();
                            header("Location: success.php?success=Biometric Captured, Entrollment Completed");
                        } elseif ($matchingResponseInJsonObject->OperationName == EnumOperationName::IsRegistered
                        && $matchingResponseInJsonObject->OperationResult == CloudABISConstant::YES) {
                            header("Location: fingerprint.php?error=Something went wrong&application=".$applicationNumber);
                        } else {
                            header("Location: fingerprint.php?error=Biometric has already been captured for this user&application=".$applicationNumber);
                        }
                    } else {
                        header("Location: fingerprint.php?error=Something went wrong&application=".$applicationNumber);
                    }
                }

            } catch(Exception $e){
                header("Location: fingerprint.php?error=Something went wrong&application=".$applicationNumber);
            }


        }

    ?>

    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>
</body>
</html>