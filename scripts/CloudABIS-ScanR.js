/*************************************************************************
 * CloudABIS-ScanR
 * ©2002-2019 KernellÓ Inc. All rights reserved.
 *************************************************************************/

/*
 * CloudABISScanr APIs path
 */
const CLOUDABISSCANR_BASE_API_URL = "http://localhost:15896/";
const CLOUDABISSCANR_FP_CAPTURE_API_PATH = "api/CloudScanr/FPCapture";
const CLOUDABISSCANR_FV_CAPTURE_API_PATH = "api/CloudScanr/FVCapture";
const CLOUDABISSCANR_IRIS_CAPTURE_API_PATH = "api/CloudScanr/IrisCapture";
const CLOUDABISSCANR_FACE_CAPTURE_API_PATH = "api/CloudScanr/FaceCapture";
const CLOUDABISSCANR_STATUS_API_PATH = "api/CloudScanr/ClientInfo";


/*
/* Specifies whether a single biometric capture, or two biometric captures are performed. Default CaptureType is SingleCapture.
/* Applicable only M2-EasyScan, M2-EasyScan Pro(Secugen) and M2-S(Digital Persona) devices.
*/
const EnumCaptureType = {
    "SingleCapture": "SingleCapture",
    "DoubleCapture": "DoubleCapture"
}

/* <summary>
  /* Format of the generated biometric template. Default format is ISO.
  */
const EnumTemplateFormat = {
    "ISO": "ISO",
    "ICS": "ICS",
    "M2ICS": "M2ICS",
    "ANSI": "ANSI",
    "FP1": "FP1"
}

/*
/* Specifies whether a left single biometric capture or right single biometric captures are performed. Default SingleCaptureMode is LeftFingerCapture.
*/
const EnumCaptureMode = {
    "TemplateOnly": "TemplateOnly",
    "TemplateWithImage": "TemplateWithImage",
    "ImageOnly": "ImageOnly"

}
/*
/* Identify, Verify, Enroll, Update
*/
const EnumCaptureOperationName = {
    "IDENTIFY": "IDENTIFY",
    "VERIFY": "VERIFY",
    "ENROLL": "ENROLL",
    "UPDATE": "UPDATE"
}
/*
/* Format of the generated biometric image. Default format is WSQ.
*/
const EnumBiometricImageFormat = {
    "WSQ": "WSQ",
    "JPEG": "JPEG",
    "TIFF": "TIFF",
    "BMP": "BMP",
    "GIF": "GIF",
    "JPEG2000": "JPEG2000",
    "PNG": "PNG"
}
/*
/* Feature enable or disable. Like hidden capture enable
*/
const EnumFeatureMode = {
    "Disable": "Disable",
    "Enable": "Enable"
}
/*
/* Specifies whether a left single biometric capture or right single biometric captures are performed. Default SingleCaptureMode is LeftFingerCapture.
/* Applicable only M2-EasyScan, M2-EasyScan Pro(Secugen) and M2-S(Digital Persona) devices.
*/
const EnumSingleCaptureMode = {
    "LeftFingerCapture": "LeftFingerCapture",
    "RightFingerCapture": "RightFingerCapture"
}

/*
 * Supported device name
 */
const EnumDevices = {
    "NONE": "0",
    "TwoPrintFutronic": "TwoPrintFutronic",
    "TenPrintFutronic": "TenPrintFutronic",
    "Secugen": "Secugen",
    "DigitalPersona": "DigitalPersona",
    "TwoPrintWatsonMini": "TwoPrintWatsonMini",
    "TenPrintWatsonMini": "TenPrintWatsonMini",
    "HitachiFV": "HitachiFV",
    "CMitech": "CMitech",
    "FuseID": "FuseID"
}
/*
/* LeftThumb, LeftIndex, LeftMiddle, LeftPing, LeftRing, RightThumb, RightIndex, RightMiddle, RightPing, RightRing
*/
const EnumFingerPosition = {

    "LeftThumb": "LeftThumb",
    "LeftIndex": "LeftIndex",
    "LeftMiddle": "LeftMiddle",
    "LeftPing": "LeftPing",
    "LeftRing": "LeftRing",
    "RightThumb": "RightThumb",
    "RightIndex": "RightIndex",
    "RightMiddle": "RightMiddle",
    "RightPing": "RightPing",
    "RightRing": "RightRing"

}

/*LeftIndexMiddle, LeftRingPing, LeftMiddlePing, RightIndexMiddle, RightRingPing, RightMiddleRing
/* Applicable only TwoPrintWatsonMini and TenPrintWatsonMini.
*/
const EnumDuelFingerPosition = {
    "LeftIndexMiddle": "LeftIndexMiddle",
    "LeftRingPing": "LeftRingPing",
    "LeftMiddleRing": "LeftMiddleRing",
    "RightIndexMiddle": "RightIndexMiddle",
    "RightRingPing": "RightRingPing",
    "RightMiddleRing": "RightMiddleRing"

}
/*
 * Supported engine name
 */
const EnumEngines = {
    "FingerPrint": "FPFF02",
    "FingerVein": "FVHT01",
    "Iris": "IRIS01",
    "Face": "FACE01"
}
/*Face Image Format. Default value is JPEG.
 * 
 */
const EnumFaceImageFormat = {
    "Jpeg": "Jpeg",
    "Bmp": "Bmp",
    "Png": "Png",
    "Tiff": "Tiff"
}

/*
 *
 */
var _cloudABISScanrBaseAPI = CLOUDABISSCANR_BASE_API_URL;

/*
 * Set base API
 */
function CloudABISScanrInit(cloudABISScanrBaseAPI) {
    _cloudABISScanrBaseAPI = cloudABISScanrBaseAPI;

}

/*
 * Get CloudABISScanr status
 * Will be returned a status message
 */
function GetClientInfo(callback) {
    var tempKey = null;
    $.support.cors = true;
    $.ajax({
        crossDomain: true,

        url: _cloudABISScanrBaseAPI + CLOUDABISSCANR_STATUS_API_PATH,
        async: true,
        success: function (ret) {
            var res = JSON.parse(JSON.stringify(ret));
            console.log('ClientStatus: ' + res.Message);
            callback(res.Message);
        },
        error: function (ret, e, r) {
            callback(e);
            console.log(a.responseText + ',' + e.toString() + ',' + r.toString());
        }
    });
}

/*
 *Will be performed finger print biometric capture
 */
function FingerPrintCapture(deviceName, quickScan, templateFormat, captureType, captureMode, bioMetricImageFormat, singleCaptureMode, captureTimeout, captureOperationName, callback, buttonName) {
    var url = _cloudABISScanrBaseAPI + CLOUDABISSCANR_FP_CAPTURE_API_PATH;


    $.support.cors = true;
    $.ajax({
        crossDomain: true,
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: url,
        async: true,
        data: JSON.stringify({
            "DeviceName": deviceName,
            "TemplateFormat": templateFormat, "QuickScan": quickScan, "CaptureType": captureType, "CaptureMode": captureMode, "BioMetricImageFormat": bioMetricImageFormat,
            "SingleCaptureMode": singleCaptureMode, "CaptureTimeOut": captureTimeout, "CaptureOperationName": captureOperationName

        }),
        success: function (ret) {
            var res = JSON.parse(JSON.stringify(ret));
            console.log('CaptureStatus: ' + res.Message);
            callback(res,buttonName);
        },
        error: function (xhr, status, error) {
            //console.log(error);
            //console.log(status);
            //console.log(xhr);

            callback('CloudABIS-Scanr may not installed or may not started. Please check and try again.');

        }
    });


}
/*
 *Will be performed finger vein biometric capture
 */
function FingerVeinCapture(deviceName, quickScan, CaptureType, captureTimeout, CaptureOperationName, callback, buttonName) {
    var url = _cloudABISScanrBaseAPI + CLOUDABISSCANR_FV_CAPTURE_API_PATH;

    $.support.cors = true;
    $.ajax({
        crossDomain: true,
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: url,
        async: true,
        data: JSON.stringify({
            "DeviceName": deviceName, "QuickScan": quickScan, "CaptureType": CaptureType, "CaptureTimeOut": captureTimeout, "CaptureOperationName": CaptureOperationName
        }),
        success: function (ret) {
            var res = JSON.parse(JSON.stringify(ret));
            console.log('CaptureStatus: ' + res.Message);
            callback(res,buttonName);
        },
        error: function (xhr, status, error) {
            //console.log(error);
            //console.log(status);
            //console.log(xhr);

            callback('CloudABIS-Scanr may not installed or may not started. Please check and try again.');

        }
    });
}
/*
 *Will be performed Iris biometric capture
 */
function IrisCapture(deviceName, captureTimeout, hasFace, callback, buttonName) {
    var url = _cloudABISScanrBaseAPI + CLOUDABISSCANR_IRIS_CAPTURE_API_PATH;

    $.support.cors = true;
    $.ajax({
        crossDomain: true,
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: url,
        async: true,
        data: JSON.stringify({
            "DeviceName": deviceName, "FaceImage": hasFace, "CaptureTimeOut": captureTimeout
        }),
        success: function (ret) {
            var res = JSON.parse(JSON.stringify(ret));
            console.log('CaptureStatus: ' + res.Message);
            callback(res,buttonName);
        },
        error: function (xhr, status, error) {
            //console.log(error);
            //console.log(status);
            //console.log(xhr);

            callback('CloudABIS-Scanr may not installed or may not started. Please check and try again.');

        }
    });

}
/*
 *Will be performed Iris biometric capture
 */
function FaceCapture(quickScan, captureTimeout, isFaceSkip, faceImageFormat, captureOperationName, callback, buttonName) {
    var uri = _cloudABISScanrBaseAPI + CLOUDABISSCANR_FACE_CAPTURE_API_PATH;

    $.support.cors = true;
    $.ajax({
        crossDomain: true,
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: uri,
        async: true,
        data: JSON.stringify({
            "QuickScan": quickScan, "HasFaceSkip": isFaceSkip, "CaptureTimeOut": captureTimeout,
            "FaceImageFormat": faceImageFormat, "CaptureOperationName": captureOperationName
        }),
        success: function (ret) {
            var res = JSON.parse(JSON.stringify(ret));
            console.log('CaptureStatus: ' + res.Message);
            callback(res,buttonName);
        },
        error: function (xhr, status, error) {
            //console.log(error);
            //console.log(status);
            //console.log(xhr);

            callback('CloudABIS-Scanr may not installed or may not started. Please check and try again.');

        }
    });
}


    /* Utilities Begin
    *This is only for PHP
    */
    function PHPEncodeHTML(biometircXMLData){
            return biometircXMLData.replace(/</g, '&lt')
                            .replace(/ /g, '%20')
                            .replace(/"/g,'%5C&quot')
                            .replace(/>/g, '&gt');
    }

