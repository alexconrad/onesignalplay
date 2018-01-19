<?php
session_start();
if (!isset($_SESSION['user_id']))
{
	die('You are no logged in. <br> <a href="index.php">Login</a>');
}

require 'settings.php';
require 'class.onesignal.php';
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'receivePlayer')
	{

	}
}

?>
<head>
	<link rel="manifest" href="/manifest.json">
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>

	<script src="/js/jquery-3.2.1.min.js" async></script>


	<script>
		<?php
		echo OneSignal::guest();
		?>
	</script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</head>

	<body>
<?php


?>

<div class="alert alert-success">
	You are now a guest! <br>
	<a href="welcome.php?logout=1">Logout</a>
</div>


	</body>


