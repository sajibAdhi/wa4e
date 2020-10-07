<?php
session_start();

if (isset($_POST['reset'])) {
    $_SESSION['chats'] = array();
    header("Location: index.php");
    return;
}

if (isset($_POST['message'])) {
    if (!isset($_SESSION['chats'])) {
        $_SESSION['chats'] = array();
    }

    $_SESSION['chats'][] = array($_POST['message'], date(DATE_RFC822));
    header("Location: index.php");
    return;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>

<body>
    <h1>Chat</h1>
    <form action="index.php" method="POST">
        <input type="text" name="message" size="60"><br>
        <input type="submit" name="chats" value="Chat"><br>
        <input type="button" name ="reset" value="Reset"><br>

    </form>

    <div id="chatContent">
        <img src="spinner.gif" alt="Loading...">
    </div>

    <script>
        function updateMsg() {
            window.console && console.log("Requesting JSON");

            $.ajax(
                {
                    url: "chatlist.php",
                    cache: false,
                    success: function(data) {
                        window.console && console.log("JSON Recived");
                        window.console && console.log(data);

                        $('#chatContent').empty();

                        for(var i = 0; i < data.length; i++ ) {
                            var entry = data[i];
                            $('#chatContent').append("<p>" + entry[0] + "<br>&nbsp;&nbsp;" + entry[1] + "</p>");
                        }
                        setTimeout('updateMsg()', 4000);
                    }
                }
            );
        }

        window.console && console.log("Startup Complete");
        updateMsg();
    </script>
</body>

</html>