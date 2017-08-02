<?php
// VARS
$active = "ON";
$inactive = "OFF";
$page = $_SERVER['PHP_SELF'];
$sec = "10";									// AUTOREFRESH 10 SECONDS$gpio = array(0, 5, 6, 13, 26, 21, 25, 16, 20);	// GPIO NUMBERS 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index, follow">
        <meta name="revisit-after" content="1 month">
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <title>GPIO Tests</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/highlight.css" rel="stylesheet">
        <link href="https://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/bootstrap-switch.css" rel="stylesheet">
        <script src="js/bootstrap-switch.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/styles/github.min.css" rel="stylesheet" >
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="doc/stylesheet.css" rel="stylesheet">
        <link href="css/bootstrap-toggle.css" rel="stylesheet">
        <script src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
<header>
<div class="mast-head">
<div class="container">
<h1>GPIO Jardin</h1>
<p>Auto Refresh : 10 secondes</p>
</div>
</div>
</header>

<html>

<head>
<meta name="viewport" content="width=device-width" />
<title>GPIO Pins Control</title>
</head>
<body>
<main id="content" role="main">
        <div id="demos" class="container">
<?php
                $arr = array(1, 2, 3, 4, 5, 6, 7, 8);
                $i = "1";
                foreach ($arr as $P) {
?>
<div class="col-xs-3">
                <h3>PIN<?php echo $i++ ?></h3>
                <p>Jardin - PIN<?php echo $gpio[$P] ?></p>

<?php
$pin_status = shell_exec('cat /sys/class/gpio/gpio' . $gpio[$P] . '/value');
if ( $pin_status == 0 ) {
echo '<input id="pin' . $P . '" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">';
}
elseif ( $pin_status == 1 ) {
echo '<input id="pin' . $P . '" type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">';
}
else {
echo '<button type="button" class="btn btn-danger">ERREUR</button>';
}
?>
<!--	<input id="pin<?php echo $P ?>" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger"> -->
	<div id="console-event"></div>
	<script>
	$(function() {
	$('#pin<?php echo $P ?>').change(function() {
	<!-- $('#console-event').html('Pin<?php echo $P ?> status : ' + $(this).prop('checked')); -->
	$.ajax({
	type: 'GET',
	url: 'action.php',
	data: { pin:<?php echo $P ?>, state:$(this).prop('checked') }
	})
	})
	})
	</script>
        </div>
<?php
                }
?>
<div class="col-xs-3">
                <h3>Temp.</h3>
                <p>Température Interne :</p>
<?php
$temp = shell_exec("/opt/vc/bin/vcgencmd measure_temp | cut -d= -f2 | cut -d. -f1");
$full_temp = shell_exec("/opt/vc/bin/vcgencmd measure_temp | cut -d= -f2");
if ($temp >= '0' AND $temp <= '44') {
        $btn = 'btn-success';
        }
elseif ($temp >= 45 AND $temp <= 56) {
        $btn = 'btn-info';
        }
elseif ($temp >= 57 AND $temp <= 68) {
        $btn = 'btn-warning';
        }
elseif ($temp >= 69 AND $temp <= 90) {
        $btn = 'btn-danger';
        }
else {
        $btn = 'btn-default';
        }
echo '<button type="button" class="' . $btn . '">' . $full_temp . '</button>';
?>
</div>
</div>
</div>
</main>
<script src="doc/script.js"></script>
<script src="js/jquery-3.2.1.min.js"</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/highlight.js"></script>
<script src="https://unpkg.com/bootstrap-switch"></script>
<script src="js/bootstrap-toggle.js"></script>
<script src="js/main.js"></script>
</body>
</html>

