<?php 
namespace cloudabis_sdk\Models;

class CloudABISResponse{
    public $CustomerID;
    public $OperationResult;
    public $_operationName;
    public $_opStatus;
    public $MatchCount;
    public $BestResult;
    public $DetailResult;

    /// <summary>
    /// Customer Key that was used to make the request.
    /// </summary>
    public function getCustomerID()
    {
        return $this->CustomerID;
    }

    public function setCustomerID($CustomerID)
    {
        $this->CustomerID = $CustomerID;
    }
    
    /// <summary>
    /// Name of operation that was requested.
    /// </summary>
    public function getOperationName()
    {
        return $this->_operationName;
    }

    public function setOperationName(EnumOperationName $OperationName)
    {
        $this->_operationName = $OperationName.None;
    }

    /// <summary>
    /// The operation execution status.
    /// </summary>
    public function getOperationStatus()
    {
        return $this->_opStatus;
    }

    public function setOperationStatus(EnumOperationStatus $OperationStatus)
    {
        $this->_opStatus = $OperationStatus.NONE;
    }

    /// <summary>
    /// The result of the operation.
    /// </summary>
    public function getOperationResult()
    {
        return $this->OperationResult;
    }

    public function setOperationResult($OperationResult)
    {
        $this->OperationResult = $OperationResult;
    }

    /// <summary>
    /// Biometric matched record with the highest confidence score.
    /// </summary>
    // public function getBestResult()
    // {
    //     if (this._results.Count > 0)
    //     {
    //         this._results = this._results.OrderByDescending(r => r.Score).ToList();
    //         return this._results[0];
    //     }
    //     else
    //         return new ScoreResult();
    // }

    public function setBestResult($BestResult)
    {
        $this->BestResult = $BestResult;
    }

    public function getBestResult()
    {
        if ( this._results.Count > 0 ) {
            //this._results = this._results.OrderByDescending(r => r.Score).ToList();
            //return this._results[0];
        }
        else
            return new ScoreResult();
    }

    // public ScoreResult BestResult
    // {
    //     get
    //     {

    //         if (this._results.Count > 0)
    //         {
    //             this._results = this._results.OrderByDescending(r => r.Score).ToList();
    //             return this._results[0];
    //         }
    //         else
    //             return new ScoreResult();
    //     }
    //     set { }
    // }


    /// <summary>
    /// All biometric matched records.
    /// </summary>
    //public List<ScoreResult> DetailResult { get { return this._results; } }
    public function getDetailResult()
    {
        return $this->_results;
    }

    /// <summary>
    /// Entity of matched record, containing Member ID and associated matching score.
    /// </summary>
    // class ScoreResult
    // {
    //     /// <summary>
    //     /// 
    //     /// </summary>
    //     public function __construct()
    //     {
    //         $this->Score = 0;
    //         $this->ID = "";
    //     }
    //     /// <summary>
    //     /// Strength of biometric match.
    //     /// </summary>
    //     public $Score;
    //     /// <summary>
    //     /// Member ID of matched record.
    //     /// </summary>
    //     public $ID;
    //     /// <summary>
    //     /// Matched finger position
    //     /// </summary>
    //     public $FingerPosition;
    // }

    //List<ScoreResult> _results = new List<ScoreResult>();
    //EnumOperationName _operationName = EnumOperationName.None;
    //EnumOperationStatus _opStatus = EnumOperationStatus.NONE;

    /// <summary>
    /// 
    /// </summary>
    //public CloudABISResponse() { }

    /// <summary>
    /// Number of biometric matched records.
    /// </summary>
    public function getMatchCount()
    {
        return count($this->_result);
    }

    public function setMatchCount($MatchCount)
    {
        $this->MatchCount = $MatchCount;
    }

    /// <summary>
    /// 
    /// </summary>
    /// <returns></returns>
    // public override string ToString()
    // {
    //     StringBuilder sb = new StringBuilder();
    //     XmlSerializerNamespaces ns = new XmlSerializerNamespaces(); ns.Add("", "");
    //     XmlWriterSettings settings = new XmlWriterSettings { OmitXmlDeclaration = true, Indent = true };
    //     using (XmlWriter writer = XmlWriter.Create(sb, settings))
    //     {
    //         XmlSerializer serializer = new XmlSerializer(typeof(CloudABISResponse));
    //         serializer.Serialize(writer, this, ns);
    //         return sb.ToString();
    //     }
    // }
}

/// <summary>
/// Entity of matched record, containing Member ID and associated matching score.
/// </summary>
namespace cloudabis_sdk_scoreresult;
class ScoreResult
{
    /// <summary>
    /// 
    /// </summary>
    public function __construct()
    {
        $this->Score = 0;
        $this->ID = "";
    }
    /// <summary>
    /// Strength of biometric match.
    /// </summary>
    public $Score;
    /// <summary>
    /// Member ID of matched record.
    /// </summary>
    public $ID;
    /// <summary>
    /// Matched finger position
    /// </summary>
    public $FingerPosition;
}