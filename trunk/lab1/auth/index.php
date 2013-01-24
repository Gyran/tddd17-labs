<?php
require_once('./tools.php');
?>
<html>
<head>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.qrcode.js"></script>
<script type="text/javascript" src="qrcode.js"></script>

<?php

if (isset($_POST["login2"])) {
	$username = $_POST["username"];
	$websecret = $_POST["secret"];
	$usersecret = $_POST["usersecret"];
	$account = getAccount($username);

	$expected = $websecret + $account->getSecret();

	if ($usersecret == $expected) {
		echo "YAY! you are logged in";
	} else {
		echo "Wrong password";
	}

} else if (isset($_POST["login"])) {
?>

<form method="post" action="">
<?php
	$username = $_POST["username"];

	if (userExists($username)) {
		$secret = rand(10,100);

		echo '<input type="hidden" name="username" value="' . $username . '">';
		echo '<input id="secret" type="hidden" name="secret" value="' . $secret . '">';
		echo '<div id="qr"></div>';
		echo '<br>';
		echo '<input type="text" name="usersecret">';
		echo '<input type="submit" name="login2" value="Login">';
	} else {
		echo "no user with that username<br>";
		echo '<a href="signup.php">Signup</a>';
	}
?>
</form>

<script type="text/javascript">
secret = $("#secret").val();
jQuery('#qr').qrcode({
	text : secret
});
</script>

<?php
} else {


// loginform
?>

<form method="post" action="">

	<input type="text" name="username">
	<input type="submit" name="login" value="Login">

</form>
<a href="signup.php">Signup</a>

<?php
}
?>