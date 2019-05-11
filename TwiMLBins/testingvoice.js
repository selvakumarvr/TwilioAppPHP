exports.handler = function(context, event, callback) {
    let twiml = new Twilio.twiml.VoiceResponse();
    //let client = context.getTwilioClient();
    // twiml.say("Hello World");
    let Digits = event.Digits || "1";

    if(Digits == 2){
        //twiml.say("Hello World");
        //const accountSid = 'AC8af7c9eca6489c302791192b90f359ee';
        //const authToken = 'debb807eafc78e41fb3f3455c8fc612e';
        //const client = context.getTwilioClient();


        //client.studio.flows('FWe2ae107ad0a1a352427fc2baeb4463e6')
        //            .executions
        //            .create({to: event.CalledVia, from: event.From})
        //           .then(execution => console.log(execution.sid))
        //            .catch(err => {
        //                 console.log(err);
        //                 callback(err);
        //             });

        //twiml.say("thank you for continuing to hold.");
        //twiml.redirect({method:'POST'},'https://handler.twilio.com/twiml/EHc46ea2966a349a7c75d1aeccbe17a4cb');

        //const dial = twiml.dial({});
        //dial.number({
        //url: 'https://handler.twilio.com/twiml/EHc46ea2966a349a7c75d1aeccbe17a4cb',
        //statusCallbackEvent: 'completed',
        //statusCallback : 'https://www.bub-z.com/api/twilio/call_hangup.php?contact_id=',
        //statusCallbackMethod: 'POST'
        //}, event.CalledVia);
        //response.dial('502-443-1225');
        //response.redirect('http://www.foo.com/nextInstructions');
        //twiml.redirect('https://webhooks.twilio.com/v1/Accounts/AC8af7c9eca6489c302791192b90f359ee/Flows/FWa0597eb752e27a9abbe1cee193832219');
        twiml.hangup();
        //callback(null, twiml);
    }
    callback(null, twiml);
};