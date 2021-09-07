<?php 
namespace cloudabis_sdk\Models;

/// <summary>
/// Biometric operations
/// </summary>
class EnumOperationName{
    /// <summary>
    /// Not a valid operation.
    /// </summary>
    const NONE = 0;
    /// <summary>
    /// Determine if a member ID already has biometric data enrolled.
    /// </summary>
    const IsRegistered = 1;
    /// <summary>
    /// Enroll a member's biometric data.
    /// </summary>
    const Register = 2;
    /// <summary>
    /// Identify a member through biometric match, by comparing against all enrolled biometric records.
    /// </summary>
    const Identify = 3;
    /// <summary>
    /// Verify against one member's enrolled biometric data.
    /// </summary>
    const Verify = 4;
    /// <summary>
    /// Update the enrolled biometric data of a member.
    /// </summary>
    const Update = 5;
    /// <summary>
    /// Change the member ID associated with an existing enrollment to a new ID.
    /// </summary>
    const ChangeID = 6;
    /// <summary>
    /// Delete an enrolled member ID and its associated biometric data.
    /// </summary>
    const DeleteID = 7;
}