<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sajib Adhikary PHP</title>
</head>
<body>
    <h1>Sajib Adhikary PHP</h1>
    <p>
    <?php 
        $hashName = hash('sha256', 'Sajib Adhikary');
        echo "The SHA256 hash of \"Sajib Adhikary\" is $hashName";
    ?>
    </p>   
    <pre> ASCII art:
    ********
    ********
    **   ***
    **    **
     **
      **
       **
        **
    **   **
    ***   **
    ********
    ********
    </pre>
    <a href="check.php">Click here to check the error setting</a><br>
    <a href="fail.php">Click here to cause a traceback</a>
</body>
</html>