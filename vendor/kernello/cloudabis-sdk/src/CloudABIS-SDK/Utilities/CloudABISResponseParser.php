<?php 
namespace cloudabis_sdk\Utilities;
use cloudabis_sdk\Utilities\CloudABISConstant;

class CloudABISResponseParser{
    public static function GetResponseMessage($operationResult)
    {
        $detailsMessage = "";
        switch ($operationResult)
        {
            case CloudABISConstant::CS:
                $detailsMessage = CloudABISConstant::CS_MESSAGE;
                break;
            case CloudABISConstant::CF:
                $detailsMessage = CloudABISConstant.CF_MESSAGE;
                break;
            case CloudABISConstant::VS:
                $detailsMessage = CloudABISConstant::VS_MESSAGE;
                break;
            case CloudABISConstant::VF:
                $detailsMessage = CloudABISConstant::VF_MESSAGE;
                break;
            case CloudABISConstant::DS:
                $detailsMessage = CloudABISConstant::DS_MESSAGE;
                break;
            case CloudABISConstant::DF:
                $detailsMessage = CloudABISConstant::DF_MESSAGE;
                break;
            case CloudABISConstant::MATCH_FOUND:
                $detailsMessage = CloudABISConstant::MATCH_FOUND_MESSAGE;
                break;
            case CloudABISConstant::NO_MATCH_FOUND:
                $detailsMessage = CloudABISConstant::NO_MATCH_FOUND_MESSAGE;
                break;

            case CloudABISConstant::YES:
                $detailsMessage = CloudABISConstant::YES_MESSAGE;
                break;
            case CloudABISConstant::NO:
                $detailsMessage = CloudABISConstant::NO_MESSAGE;
                break;
            case CloudABISConstant::CUSTOMER_INFO_NOT_FOUND:
                $detailsMessage = CloudABISConstant::CUSTOMER_INFO_NOT_FOUND_MESSAGE;
                break;
            case CloudABISConstant::ID_NOT_EXIST:
                $detailsMessage = CloudABISConstant::ID_NOT_EXIST_MESSAGE;
                break;

            case CloudABISConstant::INVALID_ENGINE:
                $detailsMessage = CloudABISConstant::INVALID_ENGINE_MESSAGE;
                break;
            case CloudABISConstant::INVALID_REQUEST:
                $detailsMessage = CloudABISConstant::INVALID_REQUEST_MESSAGE;
                break;

            case CloudABISConstant::INVALID_ICS_TEMPLATE:
                $detailsMessage = CloudABISConstant::INVALID_ICS_TEMPLATE_MESSAGE;
                break;
            case CloudABISConstant::INVALID_ISO_TEMPLATE:
                $detailsMessage = CloudABISConstant::INVALID_ISO_TEMPLATE_MESSAGE;
                break;
            case CloudABISConstant::INVALID_ANSI_TEMPLATE:
                $detailsMessage = CloudABISConstant::INVALID_ANSI_TEMPLATE_MESSAGE;
                break;
            case CloudABISConstant::CACHE_NOT_AVAILABLE:
                $detailsMessage = CloudABISConstant::CACHE_NOT_AVAILABLE_MESSAGE;
                break;

            default:
                $detailsMessage = $operationResult;
                break;
        }
        return $detailsMessage;
    }
}