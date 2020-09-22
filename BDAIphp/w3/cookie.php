<!DOCTYPE html>
<?php
$cookie_name = "sajib";
$cookie_value = "52";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>

<body>

    <?php
    if (!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
        
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
    }
    ?>
    <a href="Cookie.php">Refresh</a>
    <p><strong>Note:</strong> You might have to reload the page to see the value of the cookie.</p>
    <p><?= print_r($_COOKIE)?></p>

</body>

</html>