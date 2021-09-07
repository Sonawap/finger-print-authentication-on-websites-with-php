<?php 
namespace cloudabis_sdk\Models;

class CloudABISBiometricRequest{
    public $CustomerKey;
    public $EngineName;
    public $RegistrationID;
    public $NewRegistrationID = "";
    public $Format;
    public $BiometricXml;
    public $Token;

    /// <summary>
    /// Customer-specific key provided by the vendor.
    /// </summary>
    //[Required(ErrorMessage = "CustomerKey is required")]
    public function getCustomerKey()
    {  
        return $this->CustomerKey;
    }

    public function setCustomerKey($CustomerKey)
    {
        $this->CustomerKey = $CustomerKey;
    }
    
    /// <summary>
    /// The biometric modality for which the customer subscribed.
    /// The engine name for fingerprint biometrics is "FPFF02".
    /// The engine name for fingervein biometrics is "FVHT01"
    /// The engine name for face biometrics is "FACE01".
    /// The engine name for iris biometrics is "IRIS01".
    /// </summary>
    //[Required(ErrorMessage = "EngineName is required")]
    public function getEngineName()
    { 
        return $this->EngineName;
    }

    public function setEngineName($EngineName)
    {
        $this->EngineName = $EngineName;
    }
    
    //[Required(ErrorMessage = "RegistrationID is required")]
    //[DataType(DataType.Text)]
    //[StringLength(100, ErrorMessage = "The {0} must be at least (2) and at most (100) characters long.", MinimumLength = 4)]
    /// <summary>
    /// The unique identifier (Member ID) of the biometric enrollment that the requested operation will be performed on.
    /// </summary>
    public function getRegistrationID()
    { 
        return $this->RegistrationID;
    }

    public function setRegistrationID($RegistrationID)
    {
        $this->RegistrationID = $RegistrationID;
    }
    
    /// <summary>
    /// The new unique identifier (Member ID) that the existing ID will be changed to.
    /// </summary>
    /// <remarks>
    /// This key only needed for ChangeID operation
    /// </remarks>
    public function getNewRegistrationID()
    { 
        return $this->NewRegistrationID;
    }

    public function setNewRegistrationID($NewRegistrationID)
    {
        $this->NewRegistrationID = $NewRegistrationID;
    }
    
    /// <summary>
    /// The format of template. It might be ISO/ANSI/ICS. This parameter is need during passing the template.
    /// This value only required for FingerPrint modality operation
    /// </summary>
    public function getFormat()
    { 
        return $this->Format;
    }

    public function setFormat($Format)
    {
        $this->Format = $Format;
    }

    /// <summary>
    /// The biometric template with xml formatting. 
    /// The template data should be base64 encoded of fingerprint binary template data. Supported fingerprint templates: ANSI, ISO, ICS[M2SYS SDK Provided]
    /// The biometric template with xml formatting. The template data should be base64 encoded of fingervein binary template data.
    /// The biometric template with XML formatting. The template data should be a base64 encoded string of the original face image. The number of face images might be 1 to 3. When use only one image, use the SOURCE='FRONT' one. Supported image formats: JPG, BMP, PNG
    /// The biometric template with XML formatting. The template data should be a base64 encoded string of the original iris image. Supported image formats: JPG, JPG2000, BMP, PNG
    /// </summary>
    /// <remarks>
    /// Sample BiometricXml for FingerPrint. You can put 1-10 Finger template data at against a registration id
    /// "BiometricXml": "<Fingers>\r\n    <Finger POS='1'>base64String of ISO/ANSI/ICS template</Finger>\r\n    <Finger POS='2'>base64String of ISO/ANSI/ICS template</Finger>\r\n</Fingers>"
    /// Sample BiometricXml for FingerVein. You can put two Finger template data at against a registration id
    /// "BiometricXml": "<Fingers>\r\n    <Finger POS='1'>base64String of fingervein template</Finger>\r\n    <Finger POS='2'>base64String of fingervein template</Finger>\r\n</Fingers>"
    /// Sample BiometricXml for Face. You can put three Face image data at against a registration id
    /// "BiometricXml": "<IMAGES>\r\n    <IMAGE TYPE='FACE' SOURCE='FRONT' FORMAT='JPEG'>base64String of Face image</IMAGE>\r\n    <IMAGE TYPE='FACE' SOURCE='LEFT' FORMAT='JPEG'>base64String of Face image</IMAGE>\r\n    <IMAGE TYPE='FACE' SOURCE='RIGHT' FORMAT='JPEG'>base64String of Face image</IMAGE>\r\n</IMAGES>"
    /// Sample BiometricXml for Iris. You can put Left or Right Iris image data at against a registration id
    /// "BiometricXml": "<IMAGES>\r\n    <IMAGE TYPE='IRIS' SOURCE='LEFT' FORMAT='JPEG'>base64String of Iris image</IMAGE>\r\n    <IMAGE TYPE='IRIS' SOURCE='RIGHT' FORMAT='JPEG'>base64String of Iris image</IMAGE>\r\n</IMAGES>"
    /// </remarks>
    public function getBiometricXml()
    { 
        return $this->BiometricXml;
    }

    public function setBiometricXml($BiometricXml)
    {
        $this->Format = $BiometricXml;
    }
    
    /// <summary>
    /// CloudABIS token. You can get token by calling GetToken()
    /// </summary>
    //[Required(ErrorMessage = "Token is required")]
    public function getToken()
    {
        return $this->Tokane;
    }

    public function setToken($Token)
    {
        $this->Token = $Token;
    }
}