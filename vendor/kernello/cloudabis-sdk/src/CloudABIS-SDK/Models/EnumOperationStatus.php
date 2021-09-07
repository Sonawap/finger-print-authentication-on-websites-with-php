<?php 
namespace cloudabis_sdk\Models;

class EnumOperationStatus{
    /// <summary>
    /// No status
    /// </summary>
    const NONE = 0;
    /// <summary>
    /// The operation was successfully executed.
    /// </summary>
    const SUCCESS = 1;
    /// <summary>
    /// The submitted BiometricXml was not correctly formatted.
    /// </summary>
    const INVALID_ACCESS = 2;
    /// <summary>
    /// A system license limitation prevented your request from being fulfilled. Please contact your vendor for assistance.
    /// </summary>
    const LICENSE_EXCEED = 3;
    /// <summary>
    /// An unexpected system error was encountered. Please contact your vendor for assistance.
    /// </summary>
    const ENGINE_EXCEPTION = 4;
    /// <summary>
    /// An unexpected API error was encountered. Please contact your vendor for assistance.
    /// </summary>
    const CLOUD_API_ERROR = 5;
}