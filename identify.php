<?php
    // error_reporting(0);
    session_start();
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

    if (isset($_POST['submitForm'])) {
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
                    header("Location: match.php?id=".$matchingResponseInJsonObject->BestResult->ID);
                    // echo(CloudABISResponseParser::GetResponseMessage($matchingResponseInJsonObject->OperationResult) . ": " . $matchingResponseInJsonObject->BestResult->ID);
                } else {
                    header("Location: identify.php?error=No Match found!");
                    // echo(CloudABISResponseParser::GetResponseMessage($matchingResponseInJsonObject->OperationResult));
                }
            } else {
                header("Location: identify.php?error=Something went wrong!");
            }
        } else {
            header("Location: identify.php?error=Access token not found!");
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Identify BioMetrics</title>
    <?php require_once "includes/styles.html" ?>
    <script src='scripts/jquery.min.js' type='text/javascript'> </script>
    <script src='scripts/CloudABIS-ScanR.js'> </script>
    <script src='scripts/CloudABIS-Helper.js'> </script>
</head>

<body>

    <?php include "includes/header.php" ?>
    <main id="main" style="background: #f4f4f4" class="pb-5">
        
        <div class="container p-5 bg-white">
            <div class="col-md-6 offset-md-3">
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
                <h1 class="text-center text-muted">Login with BioMetrics</h1><hr>
                <div class="alert alert-success text-center" id="serverResult"></div>

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
                        <button class="form-control btn btn-lg btn-warning" name="submitForm" type="submit" role="button">Submit</button>
                    </div>

                    <input type="hidden" name="templateXML" id="templateXML" value="">

                </form>
            </div>
        </div>
    </main><!-- End #main -->



    <?php include "includes/footer.html" ?>

    <?php include "includes/script.html" ?>

</body>

</html>