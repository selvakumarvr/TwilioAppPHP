<!--index php file-->
<?php

// ==== Control Vars =======
$strFromNumber = "+12014313256";
$strToNumber = "+19292168151";
$strMsg = "Hello from Andrew Preciado!";  
$aryResponse = array();

// include the Twilio PHP library - download from 
    // http://www.twilio.com/docs/libraries/
    require_once ("inc/Services/Twilio.php");

// set our AccountSid and AuthToken - from www.twilio.com/user/account
    $AccountSid = "AC22436d8a2fc6741ccbc242414afece1e";
    $AuthToken = "82910f44bb1146714ab0f32bbe475662";

// ini a new Twilio Rest Client
    $objConnection = new Services_Twilio($AccountSid, $AuthToken);

// Send a new outgoinging SMS by POSTing to the SMS resource */
    $bSuccess = $objConnection->account->sms_messages->create(
        
        $strFromNumber, 	// number we are sending From 
        $strToNumber,           // number we are sending To
        $strMsg			// the sms body
    );

	$aryResponse["SentMsg"] = $strMsg;
    $aryResponse["Success"] = true;
    
    
    echo json_encode($aryResponse);

    ?>