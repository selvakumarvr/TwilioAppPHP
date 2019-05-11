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