<?php 
namespace cloudabis_sdk\Models;

/// <summary>
/// CloudABIS Token
/// </summary>
class CloudABISToken{
    public $AccessToken;
    public $ExpiresIn;
    public $TokenType;
    public $Error;
    public $ErrorDescription;

    /// <summary>
    /// Contains access token
    /// </summary>
    //[JsonProperty("access_token")]
    public function getAccessToken()
    {
        return $this->AccessToken;
    }

    public function setAccessToken($AccessToken)
    {
        $this->AccessToken = $AccessToken;
    }

    /// <summary>
    /// Contains token expiry time in seconds
    /// </summary>
    //[JsonProperty("expires_in")]
    public function getExpiresIn()
    {
        return $this->ExpiresIn;
    }

    public function setExpiresIn($ExpiresIn)
    {
        $this->ExpiresIn = $ExpiresIn;
    }

    /// <summary>
    /// Conatins token type
    /// </summary>
    //[JsonProperty("token_type")]
    public function getTokenType()
    {
        return $this->TokenType;
    }

    public function setTokenType($TokenType)
    {
        $this->TokenType = $TokenType;
    }

    /// <summary>
    /// Contains token error message if error occured otherwise this value should be an empty
    /// </summary>
    //[JsonProperty("error")]
    public function getError()
    {
        return $this->Error;
    }

    public function setError($Error)
    {
        $this->Error = $Error;
    }

    /// <summary>
    /// Details description of the token error if error occured otherwise this value should be an empty
    /// </summary>
    //[JsonProperty("error_description")]
    public function getErrorDescription()
    {
        return $this->ErrorDescription;
    }

    public function setErrorDescription($ErrorDescription)
    {
        $this->ErrorDescription = $ErrorDescription;
    }
}