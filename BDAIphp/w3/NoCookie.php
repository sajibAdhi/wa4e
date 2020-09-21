<?php

/**
 * Tell Php we won't using Cookie for Session.
 */

//session.use_cookies
// specifies whether the module will use cookies
// to store the session id on the client side.
// Defaults to 1 (enabled). 
ini_set('session.use_cookies', 0);

// session.use_only_cookies
// specifies whether the module will only use cookies to store
// the session id on the client side. 
// Enabling this setting prevents attacks involved passing session ids in URLs.
// Defaults to 1 (enabled) since PHP 5.3.0. 
ini_set('session.use_only_cookies', 0);

// session.use_trans_sid 
// whether transparent sid support is enabled or not. 
// Defaults to 0 (disabled). 
ini_set('session.use_trans_sid', 1);

// After session_start() start view.
session_start();

if (!isset($_SESSION['value'])) {
    $msg = "Session is Empty";
    $_SESSION['value'] = 0;
} elseif ($_SESSION['value'] < 3) {
    $_SESSION['value'] = $_SESSION['value'] + 1;
    $msg = "Added One Session \$_SESSION['value'] = ".$_SESSION['value'];
} else {
    session_destroy();
    session_start();
    $msg = "Session Restarted";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Cookies</title>
</head>

<body>
    <p>No Cookies for you.</p>

    <h1>Message : <?= $msg ?></h1>
    <p>Our Session ID is: <?= session_id() ?></p>
    <p><a href="NoCookie.php">Restart Session</a></p>

    <form action="NoCookie.php" method="POST">
        <input type="submit" name="submit" value="Submit">
    </form>
    <p>
        <?= print_r($_SESSION)?>
    </p>
</body>

</html>