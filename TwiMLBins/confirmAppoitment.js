exports.handler = function(context, event, callback) {
    let twiml = new Twilio.twiml.VoiceResponse();

    let appointment_date = event.appointment_date ;
    let appointment_time = event.appointment_time ;
    if ( appointment_date == 1) {
        // "open" from 9am to 5pm, PST.
        date = 'Monday'
    } else if ( appointment_date == 2) {
        // "open" from 9am to 5pm, PST.
        date = 'Tuesday'
    }else if ( appointment_date == 3) {
        // "open" from 9am to 5pm, PST.
        date = 'Wednesday'
    }else if ( appointment_date == 4) {
        // "open" from 9am to 5pm, PST.
        date = 'Thursday'
    }else if ( appointment_date == 5) {
        // "open" from 9am to 5pm, PST.
        date = 'Friday'
    }else if ( appointment_date == 6) {
        // "open" from 9am to 5pm, PST.
        date = 'Satruday'
    }

    if ( appointment_time == 1) {
        // "open" from 9am to 5pm, PST.
        time = '10 a.m'
    }else if ( appointment_time == 2) {
        // "open" from 9am to 5pm, PST.
        time = '11 a.m'
    }
    else if ( appointment_time == 3) {
        // "open" from 9am to 5pm, PST.
        time = '1 p.m'
    } else if ( appointment_time == 4) {
        // "open" from 9am to 5pm, PST.
        time = '2 p.m'
    }else if ( appointment_time == 5) {
        // "open" from 9am to 5pm, PST.
        time = '3 p.m'
    }else if ( appointment_time == 6) {
        // "open" from 9am to 5pm, PST.
        time = '4 p.m'
    } else  if ( appointment_time == 7) {
        // "open" from 9am to 5pm, PST.
        time = '5 p.m'
    }
    console.log("Your appointment date is: "+date);

    console.log("Your appointment time  is: "+time);

    response= " Your appointment date is ... "+date+ " Your appointment time is .. "+time;

    console.log("+  response: " + response);
    callback(null, response);
};


