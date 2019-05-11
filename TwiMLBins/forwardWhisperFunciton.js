/**
 *  Call Forward Template
 *
 *  This Function will forward a call to another phone number. If the call isn't answered or the line is busy,
 *  the call is optionally forwarded to a specified URL. You can optionally restrict which calling phones
 *  will be forwarded.
 */

exports.handler = function(context, event, callback) {
    // set-up the variables that this Function will use to forward a phone call using TwiML

    // REQUIRED - you must set this
    let phoneNumber = event.PhoneNumber || "";
    // OPTIONAL
    let callerId =  event.CallerId || null;
    // OPTIONAL
    let timeout = event.Timeout || null;
    // data needed to associate caller in bub-ztrack
    let contact_id = event.contact_id || null;

    // generate the TwiML to tell Twilio how to forward this call
    let twiml = new Twilio.twiml.VoiceResponse();

    let dialParams = {};
    if (callerId) {
        dialParams.callerId = callerId
    }
    if (timeout) {
        dialParams.timeout = timeout
    }


    //twiml.say('You are being connected to your business.');

    const dial = twiml.dial({
        record : 'record-from-answer-dual',action:'https://sepia-greyhound-8918.twil.io/handleDial',method:'GET'
    });
    dial.number({
        url: 'https://handler.twilio.com/twiml/EHb26a339557d514c54239f6e406dda1eb?firstname=Joey&lastname=Raymond',
        statusCallbackEvent: 'completed',
        statusCallback : 'https://www.bub-z.com/api/twilio/call_hangup.php?contact_id=' + contact_id,
        statusCallbackMethod: 'POST'
    }, phoneNumber);

    // return the TwiML
    callback(null, twiml);
};



===============

handledial

exports.handler = function(context, event, callback) {
    let twiml = new Twilio.twiml.VoiceResponse();
    // twiml.say("Hello World");
    let DialCallStatus =  event.DialCallStatus || null;
    if(DialCallStatus == 'no-answer'){
        twiml.redirect('https://webhooks.twilio.com/v1/Accounts/AC8af7c9eca6489c302791192b90f359ee/Flows/FWe2ae107ad0a1a352427fc2baeb4463e6?FlowEvent=audioComplete');
    }
    callback(null, twiml);
};

=====================
EHb26a339557d514c54239f6e406dda1eb



<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Gather action="https://sepia-greyhound-8918.twil.io/testing-voice-response" input="dtmf" numDigits="1" method="post">
        <Say>Hello {{firstname}} {{lastname}}, from Twilio! Please press 1 to accept this call, or press 2 to reject.</Say>
    </Gather>
</Response>


=============

