<html>
<head>
<meta name="viewport" content="width=device-width" />
<title>GPIO Pins Control</title>
</head>
<body>
<?php
$arr = array(0, 5, 6, 13, 26, 21, 25, 16, 20);  // Here are the GPIO I use. Change to yours.
if(isset($_GET["pin"])) {
  $script = shell_exec('sudo /home/pi/gpio.sh ' . $_GET["pin"] . ' ' . $_GET["state"]);
  echo 'PIN' . $_GET["pin"] . ' is set to ' . $_GET["state"] . '.<br/>'; // this is for when you manually call action.php to debug
  echo 'GPIO is set to : ' . $arr[$_GET["pin"]] . '.<br/>'; // this is for when you manually call action.php to debug
}
  else { echo 'ERROR<br/> No GET Value !'; }
?>
</body>
</html>
