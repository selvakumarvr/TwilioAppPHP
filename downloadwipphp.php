<?php


/* Get Twilio call logs. You can run this file by saving it
     * as call-log.php and running:
     *        php call-log.php
     */

    // Step 1: Get the Twilio-PHP library from twilio.com/docs/libraries/php,
    // following the instructions to install it with Composer.
    require_once "twilio-master/Twilio/autoload.php";
    use Twilio\Rest\Client;

    // Step 2: Set our AccountSid and AuthToken from https://twilio.com/console
    $AccountSid = "AC004cae00c0a2c6c2327f67ad792b1196";
    $AuthToken = "c072b52aba7ff103ff659142dfe8b3fa";

    // Step 3: Instantiate a new Twilio Rest Client
    $client = new Client($AccountSid, $AuthToken);
?>
<!DOCTYPE html>
<html>
<head>
<title>Call Logs</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<style>
.badge-checkboxes .checkbox input[type="checkbox"],
.badge-checkboxes label.checkbox-inline input[type="checkbox"] {
    /*  Hide the checkbox, but keeps tabbing to it possible. */
    position: absolute;
    clip: rect(0 0 0 0);
}

.badge-checkboxes .checkbox label,
.badge-checkboxes label.checkbox-inline {
    padding-left:0; /* Remove space normally used for the checkbox */
}

.badge-checkboxes .checkbox input[type="checkbox"]:checked:focus + .badge,
.badge-checkboxes label.checkbox-inline input[type="checkbox"]:checked:focus + .badge {
    box-shadow:0 0 2pt 1pt #333;  /* Outline when checkbox is focused/tabbed to */
}

.badge-checkboxes .checkbox input[type="checkbox"]:focus + .badge,
.badge-checkboxes label.checkbox-inline input[type="checkbox"]:focus + .badge {
    box-shadow:0 0 2pt 1pt #999;  /* Outline when checkbox is focused/tabbed to */
}

.badge-checkboxes .checkbox input[type="checkbox"] + .badge,
.badge-checkboxes label.checkbox-inline input[type="checkbox"] + .badge {
    border:1px solid #999; /* Add outline to badge */

    /* Make text in badge not selectable */
   -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Give badges for disabled checkboxes an opacity of 50% */
.badge-checkboxes .checkbox input[type="checkbox"]:disabled + .badge,
.badge-checkboxes label.checkbox-inline input[type="checkbox"]:disabled + .badge
{
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -moz-opacity: 0.5;
  -khtml-opacity: 0.5;
  opacity: 0.5;
}

/* Remove badge background-color and set text color for not checked options */
.badge-checkboxes .checkbox input[type="checkbox"]:not(:checked) + .badge,
.badge-checkboxes label.checkbox-inline input[type="checkbox"]:not(:checked) + .badge{
    background-color:Transparent;
    color:#999;
}

/*The following css only required for Bootstrap <= 3.1.0 */
.badge-checkboxes .checkbox {
    padding-left:0; /* Remove space normally used for the checkbox */
}
.badge-checkboxes .disabled label,
.badge-checkboxes label.checkbox-inline.disabled {
    cursor:not-allowed
}

/* The following CSS not required for the badge styled checkboxes: */
section + section  {
    margin-top:20px;
}

label + .checkbox  {
    margin-top:0;
}

h2 {
 font-size:18px;
 font-weight:bold;
}
</style>
<script>
function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
</script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Call Logs
            </h1>
        </div>
        <form method="post">
        <div class="form-group badge-checkboxes">

        <div class="checkbox" style="float:left; width:10%">
                <label>
                <INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" checked/>
                <span class="badge">Check/Uncheck All</span>
                </label>
        </div>
        <div style="clear:both"></div>
        <?php
        foreach ($client->incomingPhoneNumbers->read() as $number) {
        $numeri[] = $number->phoneNumber;
        ?>
            <div class="checkbox" style="float:left; width:10%">
                <label>
                    <input type="checkbox" name="number[]" value="<?php echo $number->phoneNumber; ?>" <?php if (in_array("$number->phoneNumber", $_POST['number'])) { echo "checked";} ?>>
                    <span class="badge"><?php echo $number->phoneNumber; ?></span>
                </label>
            </div>
        <?php
	}
	?>
        </div>



        <div style="clear:both"></div>
        <div class="col-md-2">

          <button id="when" type="submit" value="today" name="when" class="btn btn-primary">TODAY</button>
        </div>
        <div class="col-md-2">
          <button id="when" type="submit" value="yesterday" name="when" class="btn btn-primary">YESTERDAY</button>
        </div>
        <div class="col-md-2">
          <button id="when" type="submit" value="thisweek" name="when" class="btn btn-primary">THIS WEEK</button>
        </div>
         <div class="col-md-2">
        <form method="post">
          <button id="when" type="submit" value="thismonth" name="when" class="btn btn-primary">THIS MONTH</button>
        </div>
        <div class="col-md-2">
          <button id="when" type="submit" value="lastmonth" name="when" class="btn btn-primary">LAST MONTH</button>
          </div>
        <div class="col-md-2">
        <?php
        if (isset($_POST['range'])){
           $_POST['daterange'] = $_POST['range'];
         }
        ?>
<input type="text" name="daterange" value="<?php print $_POST['daterange']; ?>" />

<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
});
</script>
        </div>
        <div class="col-md-2">

          <button id="when" type="submit" value="search" name="when" class="btn btn-primary">SEARCH</button>
          <button id="delete" type="submit" value="Delete" name="d" class="btn btn-primary">Delete</button>
        </div>
        </form>
        </div>
        <div id="no-more-tables"><br/><br/>
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
        		<thead class="cf">
        			<tr>
        				<th class="numeric">Date/Time</th>
        				<th class="numeric">Caller</th>
        				<th class="numeric">Called</th>
        				<th class="numeric">Duration</th>

        		</thead>
        		<tbody>
<?php

if ($_POST["when"] == 'today'){

   $calls = $client->calls->read(
     array("status" => "completed", "starttimeAfter" => date("Y-m-d"))
   );

} else if ($_POST["when"] == 'yesterday') {
	$calls = $client->calls->read(
      array("status" => "completed", "starttimeAfter" => date("Y-m-d", strtotime("-1 days")),"starttimeBefore" => date("Y-m-d"))
   );
} else if ($_POST["when"] == 'thisweek') {
	$calls = $client->calls->read(
      array("status" => "completed", "starttimeAfter" => date("Y-m-d", strtotime("previous monday")),"starttimeBefore" => date("Y-m-d", strtotime("next sunday")))
   );
} else if ($_POST["when"] == 'thismonth') {

           $firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
           $lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));

           $firstDay = date("Y-m-d", $firstDayUTS);
           $lastDay = date("Y-m-d", $lastDayUTS);
	$calls = $client->calls->read(
      array("status" => "completed", "starttimeAfter" => $firstDay,"starttimeBefore" => $lastDay)
   );
} else if ($_POST["when"] == 'lastmonth') {

           $firstDayUTS = mktime (0, 0, 0, date("m")-1, 1, date("Y"));
           $lastDayUTS = mktime (0, 0, 0, date("m")-1, date('t'), date("Y"));

           $firstDay = date("Y-m-d", $firstDayUTS);
           $lastDay = date("Y-m-d", $lastDayUTS);
	$calls = $client->calls->read(
      array("status" => "completed", "starttimeAfter" => $firstDay,"starttimeBefore" => $lastDay)
   );
} else if ($_POST["when"] == 'search') {

           $pieces = explode(" - ", $_POST['daterange']);

           $calls = $client->calls->read(
      array("status" => "completed", "starttimeAfter" => $pieces[0],"starttimeBefore" => $pieces[1])
   );
} else {

   $calls = $client->calls->read(
     array("status" => "completed", "starttimeAfter" => date("Y-m-d"))
   );
}


if (count($_POST['number']) == 0) {
$_POST['number'] = $numeri;
}



    try {
        // Get Recent Calls
        foreach ($calls as $call) {
            foreach ($_POST['number'] as $value) {
                if (($call->from == $value) || ($call->to == $value)) {

            $time = $call->startTime->format("Y-m-d H:i:s");
?>


<tr>
  <td data-title="Date/Time"><?php echo $time; ?></td>
  <td data-title="Caller"><?php echo $call->from; ?></td>
  <td data-title="Called" class="numeric"><?php echo $call->to; ?></td>
  <td data-title="Duration" class="numeric"><?php echo $call->duration; ?> s</td>

</tr>


<?php

//echo "Call from $call->from to $call->to at $time of length $call->duration \n";
					}
        }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
?>
        		</tbody>
        	</table>
        </div>
    </div>
</div>


</body>
</html>
