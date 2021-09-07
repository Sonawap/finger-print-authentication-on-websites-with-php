<?php 
namespace cloudabis_sdk\ApiManager;

/**
 * API Manager
 */
class CloudABISAPI {
    // Given App Key
    private $_appKey = "";
    // Given Secret Key
    private $_secretKey = "";
    // Given Base Api Url
    private $_apiBaseUrl = "";

    // Construct Api Manager
    public function __construct($appKey, $secretKey, $apiBaseUrl)
    {
        $this->_appKey = $appKey;
        $this->_secretKey = $secretKey;
        $this->_apiBaseUrl = $apiBaseUrl;

        if ( $this->_apiBaseUrl == "" || is_null($this->_apiBaseUrl) )
            throw new Exception("Please provide the api base url.");
            
        if ( substr($this->_apiBaseUrl, -1) != "/" )
            $this->_apiBaseUrl = $this->_apiBaseUrl . "/"; 
    }

    /**
     * Returns API token object if given app key, secret key is correct otherwise return the proper reason
     */
    public function GetToken()
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->_apiBaseUrl . "token",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "username=".$this->_appKey."&password=".urlencode($this->_secretKey)."&grant_type=password",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                    "postman-token: 6f57f414-8466-926e-03e0-38a76c201598"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                $response = json_decode($response);
                return $response;
            }
        } catch (Exception $e) {
            throw new Exception("Experiencing technical difficaulties!");
        }
    }

    /// <summary>
    /// Determine if a member ID already has biometric data enrolled.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>IsRegistered: YES - There is biometric data enrolled with the requested Member ID.</br>
    /// <br>IsRegistered: NO - There is not any biometric data enrolled with the requested ID.</br>
    /// <para>General OperationResult values:</para>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function IsRegistered($biometricRequest)
    {
        $id = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/IsRegistered",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$id\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $token",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: f33d9566-866e-d6f9-5b85-bb5eabd25da5"
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /// <summary>
    /// Enroll a member's biometric data.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>Register: SUCCESS - Enrollment successful. (The Member ID and associated biometric data added to system.)</br>
    /// <br>Register: FAILED - Enrollment failed.</br>
    /// <br>IsRegistered: YES - There is biometric data enrolled with the requested Member ID.</br>
    /// <br>Register: POOR_IMAGE_QUALITY - The submitted iris image(s) were not good enough quality to fulfill the request.</br>
    /// <br>Identify: MATCH_FOUND - Match found. (The submitted biometric data matched that of an enrolled member.)</br>
    /// <para>General OperationResult values(FingerVein,Face,Iris):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system.Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// <para>General OperationResult values(FingerPrint):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>INVALID_ANSI_TEMPLATE: The submitted template in BiometricXml was not valid ANSI template.</br>
    /// <br>INVALID_ISO_TEMPLATE: The submitted template in BiometricXml was not valid ISO template.</br>
    /// <br>INVALID_ICS_TEMPLATE: The submitted template in BiometricXml was not valid ICS template.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="Format">The format of template. It might be ISO/ANSI/ICS. This parameter is need during passing the template.Required only FingerPrint engine</param>
    /// <param name="BiometricXml">The biometric template with xml formatting</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function Register($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $format = $biometricRequest->Format;
        $biometricXml = $this->FormatTemplateXML($biometricRequest->BiometricXml);
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/Register",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"Format\": \"$format\",\r\n  \"BiometricXml\": \"$biometricXml\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $token",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 2f03c3f1-3cb4-796f-096f-fdf87126e8c8",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /// <summary>
    /// Identify a member through biometric match, by comparing against all enrolled biometric records.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>Identify: MATCH_FOUND - Match found. (The submitted biometric data matched that of an enrolled member.)</br>
    /// <br>Identify: NO_MATCH_FOUND - No match found. (No enrolled members matched against the submitted biometric data.)</br>
    /// <br>Identify: POOR_IMAGE_QUALITY - The submitted face image(s) were not good enough quality to fulfill the request.</br>
    /// <para>General OperationResult values(FinverVein, Face, Iris):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system.Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// <para>General OperationResult values(FingerPrint):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>INVALID_ANSI_TEMPLATE: The submitted template in BiometricXml was not valid ANSI template.</br>
    /// <br>INVALID_ISO_TEMPLATE: The submitted template in BiometricXml was not valid ISO template.</br>
    /// <br>INVALID_ICS_TEMPLATE: The submitted template in BiometricXml was not valid ICS template.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="Format">The format of template. It might be ISO/ANSI/ICS. This parameter is need during passing the template.Required only FingerPrint engine</param>
    /// <param name="BiometricXml">The biometric template with xml formatting</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function Identify($biometricRequest)
    {
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $format = $biometricRequest->Format;
        $biometricXml = $this->FormatTemplateXML($biometricRequest->BiometricXml);
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/Identify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"Format\": \"$format\",\r\n  \"BiometricXml\": \"$biometricXml\"\r\n\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 1d325ed7-879f-1544-4aca-3b3a91d8c071"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /// <summary>
    /// Verify against one member's enrolled biometric data.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>Verify: VS - Verification successful. (The submitted biometric data matched the requested member's enrolled biometric data.)</br>
    /// <br>Verify: VF - Verification failed. (The submitted biometric data did not match the requested member's enrolled biometric data.)</br>
    /// <br>Verify: ID_NOT_EXIST - The Member ID doesn't exist in the system.</br>
    /// <br>Verify: POOR_IMAGE_QUALITY - The submitted fingerprint image(s) were not good enough quality to fulfill the request.</br>
    /// <para>General OperationResult values(FinverVein, Face, Iris):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system.Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// <para>General OperationResult values(FingerPrint):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>INVALID_ANSI_TEMPLATE: The submitted template in BiometricXml was not valid ANSI template.</br>
    /// <br>INVALID_ISO_TEMPLATE: The submitted template in BiometricXml was not valid ISO template.</br>
    /// <br>INVALID_ICS_TEMPLATE: The submitted template in BiometricXml was not valid ICS template.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="Format">The format of template. It might be ISO/ANSI/ICS. This parameter is need during passing the template.Required only FingerPrint engine</param>
    /// <param name="BiometricXml">The biometric template with xml formatting</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function Verify($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $format = $biometricRequest->Format;
        $biometricXml = $this->FormatTemplateXML($biometricRequest->BiometricXml);
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/Verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"Format\": \"$format\",\r\n  \"BiometricXml\": \"$biometricXml\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: fc270662-9e46-7308-3851-f86ea8a66430"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /// <summary>
    /// Change the member ID associated with an existing enrollment to a new ID.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>ChangeID: CS - Change of ID successful. (The Member ID was changed to the specified new ID.)</br>
    /// <br>ChangeID: CF - Change of ID failed.</br>
    /// <br>ChangeID: ID_NOT_EXIST - The Member ID intent for change doesn't exist in the system.</br>
    /// <br>IsRegistered: YES - There is biometric data enrolled with the requested New Member ID.</br>
    /// <para>General OperationResult values:</para>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="NewRegistrationID">The new unique identifier (Member ID) that the existing ID will be changed to.</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function ChangeID($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $NewRegistrationID = $biometricRequest->NewRegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/ChangeID",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"NewRegistrationID\":\"$NewRegistrationID\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: d4840688-9803-9c65-67fe-046ec594531c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /// <summary>
    /// Delete an enrolled member ID and its associated biometric data.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>DeleteID: DS - Deletion successful. (The Member ID and associated biometric data removed from system.)</br>
    /// <br>DeleteID: DF - Deletion failed.</br>
    /// <br>DeleteID: ID_NOT_EXIST - The Member ID doesn't exist in the system.</br>
    /// <para>General OperationResult values:</para>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function RemoveID($biometricRequest)
    {
        $id = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/RemoveID",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$id\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 4679e34d-f18e-59e8-79ef-5e8241008796"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /// <summary>
    /// Update the enrolled biometric data of a member.
    /// <para>Operation-specific OperationResult values:</para>
    /// <br>Update: SUCCESS - Update successful. (The biometric data associated with requested Member ID was updated in system.)</br>
    /// <br>Update: FAILED - Update Failed.</br>
    /// <br>Update: ID_NOT_EXIST - The Member ID doesn't exist in the system.</br>
    /// <br>Update: POOR_IMAGE_QUALITY - The submitted iris image(s) were not good enough quality to fulfill the request.</br>
    /// <br>Identify: MATCH_FOUND - Match found. (The submitted biometric data matched that of an enrolled member.)</br>
    /// <para>General OperationResult values(FingerVein,Face,Iris):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system.Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// <para>General OperationResult values(FingerPrint):</para>
    /// <br>INVALID_TEMPLATE: The submitted BiometricXml was not correctly formatted.</br>
    /// <br>INVALID_ANSI_TEMPLATE: The submitted template in BiometricXml was not valid ANSI template.</br>
    /// <br>INVALID_ISO_TEMPLATE: The submitted template in BiometricXml was not valid ISO template.</br>
    /// <br>INVALID_ICS_TEMPLATE: The submitted template in BiometricXml was not valid ICS template.</br>
    /// <br>CUSTOMER_INFO_NOT_FOUND: The specified CustomerKey was not found in the system. Please contat your vendor for assistance.</br>
    /// <br>INVALID_ENGINE: The specified EngineName was not valid.</br>
    /// <br>INVALID_REQUEST: The submitted request was not correctly formatted.</br>
    /// <br>LICENSE_ERROR: A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.</br>
    /// <br>INTERNAL_ERROR: An unexpected system error was encountered. Please contact your vendor for assistance.</br>
    /// <br>CACHE_NOT_AVAILABLE: The requested record is not available in the system. Please contact your vendor for assistance.</br>
    /// </summary>
    /// <param name="CustomerKey">Customer-specific key provided by the vendor.</param>
    /// <param name="EngineName">The engine name for fingerprint biometrics is "FPFF02". The engine name for fingervein biometrics is "FVHT01"The engine name for face biometrics is "FACE01".The engine name for iris biometrics is "IRIS01".</param>
    /// <param name="RegistrationID">The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.</param>
    /// <param name="Format">The format of template. It might be ISO/ANSI/ICS. This parameter is need during passing the template.Required only FingerPrint engine</param>
    /// <param name="BiometricXml">The biometric template with xml formatting</param>
    /// <param name="Token">API authenticate token</param>
    /// <returns></returns>
    public function Update($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $format = $biometricRequest->Format;
        $biometricXml = $this->FormatTemplateXML($biometricRequest->BiometricXml);
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl .  "api/Biometric/Update",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"Format\": \"$format\",\r\n  \"BiometricXml\": \"$biometricXml\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 9f9fa4b2-f9b0-a245-9c8b-158ef833e918"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
	public function FormatTemplateXML($template)
    {
        $templateXML = str_replace('&lt', '<', $template);
        $templateXML = str_replace('%20', ' ', $templateXML);
        $templateXML = str_replace('%5C&quot', '\"', $templateXML);
        $templateXML = str_replace('&gt', '>', $templateXML);

        return $templateXML;
    }
}