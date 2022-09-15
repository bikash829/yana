
<?php $alert_success = "";
function alert_pop($msg,$event_name){
return  $event_name."=\"alert('$msg')\"";
}
if (isset($_GET['success'])) {
    $alert_success =  alert_pop($_GET['success'], "onload");
}


?>
<body <?=$alert_success?>>
