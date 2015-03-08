<?php
    session_start();
    require_once('connection.php');
    echo "HI {$_SESSION['first_name']} {$_SESSION['last_name']}!";
    echo "<a href = 'process.php'>LOG OFF</a>"

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Wall</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<h1>PHP Advanced: Email Validation:</h1>

<div class="main-container">

</div> <!-- #main-container -->
</body>
</html>
