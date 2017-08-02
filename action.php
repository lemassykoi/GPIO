<html>
<head>
<meta name="viewport" content="width=device-width" />
<title>GPIO Pins Control</title>
</head>
<body>
<?php
$arr = array(0, 5, 6, 13, 26, 21, 25, 16, 20);  // Les GPIO que j'utilise, et zero en plus car le comptage commence à zero
if(isset($_GET["pin"])) {
                $script = shell_exec('sudo /home/pi/gpio.sh ' . $_GET["pin"] . ' ' . $_GET["state"]);
                echo 'PIN' . $_GET["pin"] . ' is set to ' . $_GET["state"] . '.<br/>';
                echo 'GPIO is set to : ' . $arr[$_GET["pin"]] . '.<br/>';
}
else { echo 'ERROR<br/> Aucune Valeur de GET !'; }
?>
</body>
</html>
