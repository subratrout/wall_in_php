<?php
    session_start();
    require_once('connection.php');


    if(isset($_SESSION['errors']))
    {
        foreach ($_SESSION['errors'] as $error)
        {
            echo "<div class='errors'><p>".$error."</p></div>";
        }

        unset($_SESSION['errors']);
    }

     if(isset($_SESSION['success_message']))
    {
        echo "<div class='success'><p>".$_SESSION['success_message']."</p></div>";
        unset($_SESSION['success_message']);
    }

      if(isset($_SESSION['success_message_posted']))
    {
        echo "<div class='success'><p>".$_SESSION['success_message_posted']."</p></div>";
        unset($_SESSION['success_message_posted']);
    }

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
<div class="head">
    <h1>CodingDojo Wall</h1>
    <div class="profile"><?php
       // echo "HI {$_SESSION['first_name']} {$_SESSION['last_name']}!";
       echo "<a href = 'process.php'>LOG OFF</a>" ?>
    </div>

    <h2>Post a Message:</h2>
            <form class="message" action="process.php" method="post">
                <textarea name="message" rows="5" cols="100"></textarea>
                <input type="submit" class = 'btn-message' value="Post a message">
                <input type="hidden" name='action' value="message">
                <input name="user_id" type="hidden" value="<?php echo $_SESSION['user_id'];?>" id="user_id">
            </form>

</div>

<div class="main-container">

</div> <!-- #main-container -->
</body>
</html>
