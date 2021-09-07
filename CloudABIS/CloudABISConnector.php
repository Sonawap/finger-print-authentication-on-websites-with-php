<?php

namespace CloudABISSampleWebApp_CloudABIS;

require __DIR__ . '/../vendor/autoload.php';

use cloudabis_sdk\ApiManager\CloudABISAPI;
use cloudabis_sdk\Models\CloudABISBiometricRequest;
use cloudabis_sdk\Models\EnumOperationName;
use cloudabis_sdk\Utilities\CloudABISConstant;
use cloudabis_sdk\Utilities\CloudABISResponseParser;

class CloudABISConnector
{
    /// <summary>
    /// Given App Key
    /// </summary>
    private $_appkey = "";
    /// <summary>
    /// Given Secret Key
    /// </summary>
    private $_secretKey = "";
    /// <summary>
    /// Given Base API URL
    /// </summary>
    private $_apiBaseUrl = "";
    private $_customerKey = "";
    private $_engineName = "";

    /// <summary>
    /// Initialize CloudABIS API
    /// </summary>
    /// <param name="appKey"></param>
    /// <param name="secretKey"></param>
    /// <param name="apiBaseUrl"></param>
    /// <param name="customerKey"></param>
    /// <param name="engineName"></param>
    public function __construct($appKey, $secretKey, $apiBaseUrl, $customerKey, $engineName)
    {
        $this->_appkey = $appKey;
        $this->_secretKey = $secretKey;
        $this->_apiBaseUrl = $apiBaseUrl;
        $this->_customerKey = $customerKey;
        $this->_engineName = $engineName;

        if (is_null($this->_apiBaseUrl) || $this->_apiBaseUrl == "") {
            throw new Exception("Please provide the api base url.");
        }

        if (substr($this->_apiBaseUrl, -1) != "/") {
            $this->_apiBaseUrl = $this->_apiBaseUrl . "/";
        }

    }

    /// <summary>
    /// Returns api token if given credentails is correct
    /// </summary>
    /// <returns></returns>
    public function GetCloudABISToken()
    {
        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        return $cloudABISAPI->GetToken();
    }

    #region Without Biometric Operation
    /// <summary>
    /// Is Registered
    /// </summary>
    /// <param name="id"></param>
    /// <param name="token"></param>
    /// <returns></returns>
    public function IsRegister($id, $token)
    {
        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->RegistrationID = $id;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Token = $token;
        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->IsRegistered($biometricRequest);


        if ($matchingResponse != null && $matchingResponse[0] == 200)
            return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
        else 
            return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);
        
    }

    /// <summary>
    /// Change existing id
    /// </summary>
    /// <param name="oldID"></param>
    /// <param name="newID"></param>
    /// <param name="token"></param>
    public function ChangeID($oldID, $newID, $token)
    {
        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->RegistrationID = $oldID;
        $biometricRequest->NewRegistrationID = $newID;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Token = $token;

        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->ChangeID($biometricRequest);

        if ($matchingResponse != null && $matchingResponse[0] == 200)
           return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
        else 
          return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);

    }

    /// <summary>
    /// Delete existing biometric records against an id
    /// </summary>
    /// <param name="id"></param>
    /// <param name="token"></param>
    public function RemoveID($id, $token)
    {
        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->RegistrationID = $id;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Token = $token;

        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->RemoveID($biometricRequest);
        
        if ($matchingResponse != null && $matchingResponse[0] == 200)
           return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
        else 
          return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);

    }

    #endregion
    #region With Biometric Operation
    /// <summary>
    /// Register an employee/person
    /// </summary>
    /// <param name="template">Templte or image</param>
    /// <param name="registrationid"></param>
    /// <param name="token"></param>
    /// <param name="format">Format value needs only for FingerPrint operation</param>
    public function Register($template, $registrationid, $token, $format = CloudABISConstant::CLOUDABIS_ISO)
    {
        $afterFormatTemplateXML = $this->FormatTemplateXML($template);

        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->RegistrationID = $registrationid;
        $biometricRequest->BiometricXml = $afterFormatTemplateXML;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Format = $format;
        $biometricRequest->Token = $token;

        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->Register($biometricRequest);

        if ($matchingResponse != null && $matchingResponse[0] == 200){
            if ($matchingResponse[1]->OperationName == EnumOperationName::Register && $matchingResponse[1]->OperationResult == CloudABISConstant::SUCCESS) {
                return "Registration Success!";
            } elseif ($matchingResponse[1]->OperationName == EnumOperationName::IsRegistered && $matchingResponse[1]->OperationResult == CloudABISConstant::YES) {
                return CloudABISConstant::YES_MESSAGE;
            } else {
                return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
            }
        }
       else{
        return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);
       }   
    }

    /// <summary>
    /// Update existing employee/person biometric data
    /// </summary>
    /// <param name="template">Templte or image</param>
    /// <param name="registrationid"></param>
    /// <param name="token"></param>
    /// <param name="format">Format value needs only for FingerPrint operation</param>
    public function Update($template, $registrationid, $token, $format = CloudABISConstant::CLOUDABIS_ISO)
    {
        $afterFormatTemplateXML = $this->FormatTemplateXML($template);

        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->RegistrationID = $registrationid;
        $biometricRequest->BiometricXml = $afterFormatTemplateXML;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Format = $format;
        $biometricRequest->Token = $token;

        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->Update($biometricRequest);
  
        if ($matchingResponse != null && $matchingResponse[0] == 200){
            if ($matchingResponse[1]->OperationName == EnumOperationName::Update && $matchingResponse[1]->OperationResult == CloudABISConstant::SUCCESS) {
                return "Update Biometric Success!";
            } else {
                return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
            }
        }
       else{
        return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);
       } 

    }

    /// <summary>
    /// Identify biometric
    /// </summary>
    /// <param name="template">Templte or image</param>
    /// <param name="token"></param>
    /// <param name="format">Format value needs only for FingerPrint operation</param>
    public function Identify($template, $token, $format = CloudABISConstant::CLOUDABIS_ISO)
    {
        $afterFormatTemplateXML = $this->FormatTemplateXML($template);

        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->BiometricXml = $afterFormatTemplateXML;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Format = $format;
        $biometricRequest->Token = $token;

        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->Identify($biometricRequest);
        

        if ($matchingResponse != null && $matchingResponse[0] == 200){
            if ($matchingResponse[1]->OperationName == EnumOperationName::Identify && $matchingResponse[1]->OperationResult == CloudABISConstant::MATCH_FOUND){
                    return (CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult) . ": " . $matchingResponse[1]->BestResult->ID);
                } else {
                    return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
                }
        } else{
        return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);
       } 

    }

    /// <summary>
    /// Verify existing employee/person biometric data
    /// </summary>
    /// <param name="template">Templte or image</param>
    /// <param name="verifyID"></param>
    /// <param name="token"></param>
    /// <param name="format">Format value needs only for FingerPrint operation</param>
    public function Verify($template, $verifyID, $token, $format = CloudABISConstant::CLOUDABIS_ISO)
    {
        $afterFormatTemplateXML = $this->FormatTemplateXML($template);

        $biometricRequest = new CloudABISBiometricRequest();
        $biometricRequest->RegistrationID = $verifyID;
        $biometricRequest->BiometricXml = $afterFormatTemplateXML;
        $biometricRequest->CustomerKey = $this->_customerKey;
        $biometricRequest->EngineName = $this->_engineName;
        $biometricRequest->Format = $format;
        $biometricRequest->Token = $token;

        $cloudABISAPI = new CloudABISAPI($this->_appkey, $this->_secretKey, $this->_apiBaseUrl);
        $matchingResponse = $cloudABISAPI->Verify($biometricRequest);
      
        if ($matchingResponse != null && $matchingResponse[0] == 200){
             return CloudABISResponseParser::GetResponseMessage($matchingResponse[1]->OperationResult);
        } else{
        return CloudABISResponseParser::GetErrorMessage($matchingResponse[0]);
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
