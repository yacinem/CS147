<?php

function test_credentials($username, $entered_password) {
    echo strcmp($entered_password, "test");
    return (strcmp($username, "test") == 0) && (strcmp($entered_password, "test") == 0);
}

session_start();
$wrong_login = FALSE;
if (isset($_GET["username"]) && isset($_GET["password"])) {
    echo $_GET["username"];
    echo $_GET["password"];
    if (test_credentials($_GET["username"], $_GET["password"])) {
        $_SESSION["username"] = $_GET["username"];
        $user_logged_in = TRUE;
        $username = $_GET["username"];
    } else {
        $wrong_login = TRUE;
    }
} else if (isset($SESSION_["username"])) {
    $user_logged_in = TRUE;
    $username = $SESSION_["username"];
} else {
    $user_logged_in = FALSE;
}
?>
<!DOCTYPE html> 
<html>

<head>
	<title>VoteCaster | Login</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="startup.png">
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

</head>  
<body> 

<div data-role="page">

	<div data-role="header">
	<h1>Log in</h1>
	<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">
    <?php
        if ($user_logged_in) {
            echo '<div>';
            echo '<p>Thank you for logging in, ' . $username . '.</p></div>';
        } else {
            if ($wrong_login) {
                echo '<div>';
                echo '<p>Wrong username/password.</p>';
                echo '</div>';
            }
            echo '
                <p>
                <form action="login.php" method="get">
                <div data-role="fieldcontain">
                <label for="foo">Username:</label>
                <input type="text" name="username" id="username-box">
                </div>
                <div data-role="fieldcontain">
                <label for="bar">Password:</label>
                <input type="password" name="password" id="password-box">
                </div>
                <input type="submit" value="Login">
                </form>
                </p>';
        }
    ?>
	
	</div><!-- /content -->

    <div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="c">
		<ul>
			<li><a href="index.php" id="home" data-icon="custom">Home</a></li>
			<li><a href="login.php" id="key" data-icon="custom" class="ui-btn-active">Login</a></li>
			<li><a href="filter.php" id="beer" data-icon="custom">Filter</a></li>
			<li><a href="#" id="skull" data-icon="custom">Settings</a></li>
		</ul>
		</div>
	</div>
	<script type="text/javascript">
	$("#logout").hide();
	$("#info").hide();
	var retrievedObject = localStorage.getItem('username');
	if (retrievedObject == "test") {
		$("#form").hide();	
		$("#logout").show();
		$("#info").show();
	}
	$("#logout").click(function() {
		localStorage.removeItem('username');
		$("#form").show();
		$("#logout").hide();
		$("#info").hide();
	});
	</script>
</div><!-- /page -->

</body>
</html>
