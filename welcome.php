<?php
session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION['user_id']);
    header("Location: index.php");
    die();
}

require 'settings.php';
require 'class.onesignal.php';

if (isset($_POST['action']) && $_POST['action'] == 'push') {
    $return = OneSignal::send_to_player($_POST['onesignal_uid']);
    echo '<textarea rows="10" cols="150">'.$return.'</textarea>';
    die();
}

require 'mysql.php';
$query = "SELECT * FROM users WHERE user_id='".$mysqli->real_escape_string($_SESSION['user_id'])."'";
$result = mysqli_query($mysqli, $query);
if ($result === false) {
    die('error '.$query.' '.$mysqli->error);
}
$user = mysqli_fetch_assoc($result);

?><html>
<head>
    <link rel="manifest" href="/manifest.json">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>

    <script>
    <?php
    echo OneSignal::init();
    ?>
    </script>

    <script src="/js/jquery-3.2.1.min.js" async></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>


</head>

<body>
<?php

if (!isset($_SESSION['user_id'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        You are no logged in. <br>
        <a href="index.php">Login</a>
    </div>
    <?php
    die();
}
?>

<div class="alert alert-success">
    Welcome! <br>
    Push subscribe should popup ! <br>
    <a href="welcome.php?logout=1">Logout</a>
</div>

<div id="playerok" class="alert alert-success" style="display: none;">
</div>

<div id="sendpush" class="alert" style="display: block;">
    <form action="welcome.php" method="post">
        <input type="hidden" name="action" value="push">
        <h4 class="alert-heading">Send Push</h4>

        <div class="form-group">
            <label for="exampleInputEmail1">OneSignal Player ID</label>
            <input name="onesignal_uid" type="text" class="form-control" placeholder="Enter OneSignal Player" value="<?=$user['player_id']?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <input name="text" type="text" class="form-control" placeholder="Message">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>



</body>
</html>