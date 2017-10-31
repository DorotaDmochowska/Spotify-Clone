<?php 
	include("includes/config.php");

	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($conn);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php  
		if(isset($_POST['registerButton'])) {
			echo '<script>
					$(document).ready(function() {
						$("#loginForm").hide();
						$("#registerForm").show();
					});
				</script>';
		} else {
			echo '<script>
					$(document).ready(function() {
						$("#loginForm").show();
						$("#registerForm").hide();
					});
				</script>';
		}
	?>

	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed) ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" type="text" name="loginUsername" placeholder="Username" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" type="password" name="loginPassword" placeholder="Password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
					</div>
				</form>


				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameTaken) ?>
						<?php echo $account->getError(Constants::$usernameCharacters) ?>
						<label for="username">Your Username</label>
						<input id="username" type="text" name="username" placeholder="Username" required value="<?php getInputValue('username') ?>">
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters) ?>
						<label for="firstName">First Name</label>
						<input id="firstName" type="text" name="firstName" placeholder="First Name" required value="<?php getInputValue('firstName') ?>">
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters) ?>
						<label for="lastName">Last Name</label>
						<input id="lastName" type="text" name="lastName" placeholder="Last Name" required value="<?php getInputValue('lastName') ?>">
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailDoNotMatch) ?>
						<?php echo $account->getError(Constants::$emailInvaild) ?>
						<?php echo $account->getError(Constants::$emailTaken) ?>
						<label for="email">Email</label>
						<input id="email" type="email" name="email" placeholder="Email" required value="<?php getInputValue('email') ?>">
					</p>

					<p>
						<label for="confirmEmail">Confirm Email</label>
						<input id="confirmEmail" type="email" name="confirmEmail" placeholder="Confirm Email" required value="<?php getInputValue('confirmEmail') ?>">
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordDoNotMatch) ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric) ?>
						<?php echo $account->getError(Constants::$passwordCharacters) ?>
						<label for="password">Password</label>
						<input id="password" type="password" name="password" placeholder="Password" required>
					</p>

					<p>
						<label for="confirmPassword">Confirm Password</label>
						<input id="confirmPassword" type="password" name="confirmPassword" placeholder="Confirm Password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>
				</form>
			</div>
			<div id="loginText">
				<h1>Get great music!</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you will fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>