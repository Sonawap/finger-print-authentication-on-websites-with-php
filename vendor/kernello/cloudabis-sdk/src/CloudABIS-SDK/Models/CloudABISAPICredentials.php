<?php 
namespace cloudabis_sdk\Models;

class CloudABISAPICredentials{
    // CloudABIS credentials init    
    public $BaseAPIURL = "";
    public $AppKey = "";
    public $SecrectKey = "";
    public $CustomerKey = "";
    public $EngineName = "";
    public $Token = "";

    function __construct()
    {
        $BaseAPIURL = "";
        $AppKey = "";
        $SecrectKey = "";
        $CustomerKey = "";
        $EngineName = CloudABISConstant::FINGERPRINT_ENGINE;
    }

    /// CloudABIS Base API URL
    function getBaseAPIURL()
    {
        return $this->BaseAPIURL;
    }

    /// CloudABIS Base API URL
    function setBaseAPIURL($BaseAPIURL)
    {
        $this->BaseAPIURL = $BaseAPIURL;
    }

    /// Customer-specific app key provided by the vendor.
    function getAppKey()
    {
        return $this->BaseAPIURL;
    }

    /// Customer-specific app key provided by the vendor.
    function setAppKey($AppKey)
    {
        $this->AppKey = $AppKey;
    }

    /// Customer-specific secret key provided by the vendor.
    function getSecrectKey()
    {
        return $this->SecrectKey;
    }

    /// Customer-specific secret key provided by the vendor.
    function setSecrectKey($SecrectKey)
    {
        $this->SecrectKey = $SecrectKey;
    }

    /// Customer-specific key provided by the vendor.
    function getCustomerKey()
    {
        return $this->CustomerKey;
    }

    /// Customer-specific key provided by the vendor.
    function setCustomerKey($CustomerKey)
    {
        $this->CustomerKey = $CustomerKey;
    }

    /// <summary>
    /// CloudABIS supported engine name
    /// <para> All supported engnine name</para>
    /// <br>The engine name for fingerprint biometrics is "FPFF02".</br>
    /// <br>The engine name for fingervein biometrics is "FVHT01".</br>
    /// <br>The engine name for face biometrics is "FACE01".</br>
    /// <br>The engine name for iris biometrics is "IRIS01".</br>
    /// </summary>
    function getEngineName()
    {
        return $this->EngineName;
    }

    /// CloudABIS supported engine name
    function setEngineName($EngineName)
    {
        $this->EngineName = $EngineName;
    }

    /// CloudABIS API token
    function getToken()
    {
        return $this->Token;
    }

    /// CloudABIS API token
    function setToken($Token)
    {
        $this->Token = $Token;
    }

}