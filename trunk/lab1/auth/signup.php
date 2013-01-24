<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.qrcode.js"></script>
<script type="text/javascript" src="qrcode.js"></script>

<?php

require_once('./tools.php');

if (isset($_POST["signup"])) { // if the user tries to sign up

	$username = $_POST["username"];
	if (!userExists($username)) {
		$secret = signup($username);

		if ($secret > 0) {
			echo '<input id="secret" type="hidden" name="secret" value="' . $secret . '">';
			echo '<div id="qr"></div>';
			echo "<div>Scan this with the special app</div>";

?>

<script type="text/javascript">
secret = $("#secret").val();
jQuery('#qr').qrcode({
	text : secret
});
</script>

<a href="index.php">Login</a>

<?php
		}
	} else { // The username already existed
		echo "username already exists<br>";
		echo '<a href="signup.php">Signup</a>';
	}
	


} else { // Show the signup form

?>


<form action="" method="post">

Username: <input type="text" name="username">
<br />
<input type="submit" name="signup" value="sign up">

</form>
<?php
}
?>
