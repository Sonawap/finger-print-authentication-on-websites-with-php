<?php
require '../core/middleware.php';
$middleware->auth();
require '../core/admin.php';
$page = "query";

if (isset($_GET['application'])) {
    $app = $_GET['application'];

    if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
	    $biometricRequest = new CloudABISBiometricRequest();
	    $biometricRequest->Token = $_SESSION['access_token'];
	    $cloudABISAPI = new CloudABISAPI(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL);
	    $lblMessageText = $cloudABISAPI->RemoveID($app,$biometricRequest->Token);

	    $delete = $admin->delete($app);

	    echo $lblMessageText;

	    // if ($delete) {
	    	
	    // 	header("Location: query.php?success=User and His fingerprint has been reqmoved");
	    // }

	}
}

