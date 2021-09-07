<?php 
namespace cloudabis_sdk\Utilities;

class CloudABISConstant{
    /// <summary>
    /// Once match found
    /// </summary>
    public const MATCH_FOUND = "MATCH_FOUND";
    /// <summary>
    /// Match found. (The submitted biometric data matched that of an enrolled member.)
    /// </summary>
    public const MATCH_FOUND_MESSAGE = "Match found. (The submitted biometric data matched that of an enrolled member.)";
    /// <summary>
    /// No match found
    /// </summary>
    public const NO_MATCH_FOUND = "NO_MATCH_FOUND";
    /// <summary>
    /// No match found. (No enrolled members matched against the submitted biometric data.)
    /// </summary>
    public const NO_MATCH_FOUND_MESSAGE = "No match found. (No enrolled members matched against the submitted biometric data.)";
    /// <summary>
    /// If operation was success
    /// </summary>
    public const SUCCESS = "SUCCESS";
    /// <summary>
    /// If operation was failed
    /// </summary>
    public const FAILED = "FAILED";
    /// <summary>
    /// CS - Change of ID successful. (The Member ID was changed to the specified new ID.)
    /// </summary>
    public const CS = "CS";
    /// <summary>
    /// CS - Change of ID successful. (The Member ID was changed to the specified new ID.)
    /// </summary>
    public const CS_MESSAGE = "CS - Change of ID successful. (The Member ID was changed to the specified new ID.)";
    /// <summary>
    /// CF - Change of ID failed.
    /// </summary>
    public const CF = "CF";
    /// <summary>
    /// CF - Change of ID failed.
    /// </summary>
    public const CF_MESSAGE = "CF - Change of ID failed.";
    /// <summary>
    /// Delete/Remove biometric success
    /// </summary>
    public const DS = "DS";
    /// <summary>
    /// DS - Deletion successful. (The Member ID and associated biometric data removed from system.)
    /// </summary>
    public const DS_MESSAGE = "DS - Deletion successful. (The Member ID and associated biometric data removed from system.)";
    /// <summary>
    /// Delete/Remove biometric failed. Make it was not exist or else
    /// </summary>
    public const DF = "DF";
    /// <summary>
    /// DF - Deletion failed.
    /// </summary>
    public const DF_MESSAGE = "DF - Deletion failed.";
    /// <summary>
    /// Verify success
    /// </summary>
    public const VS = "VS";
    /// <summary>
    /// VS - Verification successful. (The submitted biometric data matched the requested member's enrolled biometric data.)
    /// </summary>
    public const VS_MESSAGE = "VS - Verification successful. (The submitted biometric data matched the requested member's enrolled biometric data.)";
    /// <summary>
    /// Verify failed
    /// </summary>
    public const VF = "VF";
    /// <summary>
    /// VF - Verification failed. (The submitted biometric data did not match the requested member's enrolled biometric data.)
    /// </summary>
    public const VF_MESSAGE = "VF - Verification failed. (The submitted biometric data did not match the requested member's enrolled biometric data.)";
    /// <summary>
    /// Id not exist during IsRegistered, Verify, Delete/Remove biometric
    /// </summary>
    public const ID_NOT_EXIST = "ID_NOT_EXIST";
    /// <summary>
    /// ID_NOT_EXIST - The Member ID doesn't exist in the system.
    /// </summary>
    public const ID_NOT_EXIST_MESSAGE = "ID_NOT_EXIST - The Member ID doesn't exist in the system.";
    /// <summary>
    /// IsRegistered Yes
    /// </summary>
    public const YES = "YES";
    /// <summary>
    /// YES - There is biometric data enrolled with the requested Member ID.
    /// </summary>
    public const YES_MESSAGE = "YES - There is biometric data enrolled with the requested Member ID.";
    /// <summary>
    /// ISRegistered No
    /// </summary>
    public const NO = "NO";
    /// <summary>
    /// NO - There is not any biometric data enrolled with the requested ID.
    /// </summary>
    public const NO_MESSAGE = "NO - There is not any biometric data enrolled with the requested ID.";
    /// <summary>
    /// Given template is invalid
    /// </summary>
    public const INVALID_TEMPLATE = "INVALID_TEMPLATE";
    /// <summary>
    /// The submitted BiometricXml was not correctly formatted.
    /// </summary>
    public const INVALID_TEMPLATE_MESSAGE = "The submitted BiometricXml was not correctly formatted.";
    /// <summary>
    /// Given ANSI template is invalid
    /// </summary>
    public const INVALID_ANSI_TEMPLATE = "INVALID_ANSI_TEMPLATE";
    /// <summary>
    /// The submitted template in BiometricXml was not valid ANSI template.
    /// </summary>
    public const INVALID_ANSI_TEMPLATE_MESSAGE = "The submitted template in BiometricXml was not valid ANSI template.";
    /// <summary>
    /// Given ISO template is invalid
    /// </summary>
    public const INVALID_ISO_TEMPLATE = "INVALID_ISO_TEMPLATE";
    /// <summary>
    /// The submitted template in BiometricXml was not valid ISO template.
    /// </summary>
    public const INVALID_ISO_TEMPLATE_MESSAGE = "The submitted template in BiometricXml was not valid ISO template.";
    /// <summary>
    /// Given ICS template is invalid
    /// </summary>
    public const INVALID_ICS_TEMPLATE = "INVALID_ICS_TEMPLATE";
    /// <summary>
    /// The submitted template in BiometricXml was not valid ICS template.
    /// </summary>
    public const INVALID_ICS_TEMPLATE_MESSAGE = "The submitted template in BiometricXml was not valid ICS template.";
    /// <summary>
    /// Given Customer info not found. May be customer key is incorrect
    /// </summary>
    public const CUSTOMER_INFO_NOT_FOUND = "CUSTOMER_INFO_NOT_FOUND";
    /// <summary>
    /// The specified CustomerKey was not found in the system.Please contat your vendor for assistance.
    /// </summary>
    public const CUSTOMER_INFO_NOT_FOUND_MESSAGE = "The specified CustomerKey was not found in the system.Please contat your vendor for assistance.";
    /// <summary>
    /// Invalid engine
    /// </summary>
    public const INVALID_ENGINE = "INVALID_ENGINE";
    /// <summary>
    /// The specified EngineName was not valid.
    /// </summary>
    public const INVALID_ENGINE_MESSAGE = "The specified EngineName was not valid.";
    /// <summary>
    /// Invalid request
    /// </summary>
    public const INVALID_REQUEST = "INVALID_REQUEST";
    /// <summary>
    /// The submitted request was not correctly formatted.
    /// </summary>
    public const INVALID_REQUEST_MESSAGE = "The submitted request was not correctly formatted.";
    /// <summary>
    /// License error. This will be happened if license exceed or else
    /// </summary>
    public const LICENSE_ERROR = "LICENSE_ERROR";
    /// <summary>
    /// A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.
    /// </summary>
    public const LICENSE_ERROR_MESSAGE = "A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.";
    /// <summary>
    /// Internal server error
    /// </summary>
    public const INTERNAL_ERROR = "INTERNAL_ERROR";
    /// <summary>
    /// An unexpected system error was encountered. Please contact your vendor for assistance.
    /// </summary>
    public const INTERNAL_ERROR_MESSAGE = "An unexpected system error was encountered. Please contact your vendor for assistance.";
    /// <summary>
    /// Cache not available
    /// </summary>
    public const CACHE_NOT_AVAILABLE = "CACHE_NOT_AVAILABLE";
    /// <summary>
    /// The requested record is not available in the system. Please contact your vendor for assistance.
    /// </summary>
    public const CACHE_NOT_AVAILABLE_MESSAGE = "The requested record is not available in the system. Please contact your vendor for assistance.";
    /// <summary>
    /// Given image/tempalte was poor quality
    /// </summary>
    public const POOR_IMAGE_QUALITY = "POOR_IMAGE_QUALITY";
    /// <summary>
    /// The submitted iris image(s) were not good enough quality to fulfill the request.
    /// </summary>
    public const POOR_IMAGE_QUALITY_MESSAGE = "The submitted iris image(s) were not good enough quality to fulfill the request.";

    public const FINGERPRINT_ENGINE = "FPFF02";
    /// <summary>
    /// Finger vein engine name
    /// </summary>
    public const FINGERVEIN_ENGINE = "FVHT01";
    /// <summary>
    /// Face engine name
    /// </summary>
    public const FACE_ENGINE = "FACE01";
    /// <summary>
    /// Iris engine name
    /// </summary>
    public const IRIS_ENGINE = "IRIS01";
    /// <summary>
    /// Is Registered API Path
    /// </summary>
    public const CLOUDABIS_IS_REGISTERED_API_PATH = "api/Biometric/IsRegistered";
    /// <summary>
    /// Register API Path
    /// </summary>
    public const CLOUDABIS_REGISTER_API_PATH = "api/Biometric/Register";
    /// <summary>
    /// Identify API Path
    /// </summary>
    public const CLOUDABIS_IDENTIFY_API_PATH = "api/Biometric/Identify";
    /// <summary>
    /// Verify API Path
    /// </summary>
    public const CLOUDABIS_VERIFY_API_PATH = "api/Biometric/Verify";

    /// <summary>
    /// Update API Path
    /// </summary>
    public const CLOUDABIS_UPDATE_API_PATH = "api/Biometric/Update";
    /// <summary>
    /// ChangeID API Path
    /// </summary>
    public const CLOUDABIS_CHANGEID_API_PATH = "api/Biometric/ChangeID";
    /// <summary>
    /// RemoveID API Path
    /// </summary>
    public const CLOUDABIS_REMOVEID_API_PATH = "api/Biometric/RemoveID";
}