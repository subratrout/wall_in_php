<?php
    session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login and Registration</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>


<h1 class='head'>PHP Advanced: Wall:</h1>
<div class="main-container">
    <div id="form">
        <h2>Register</h2>
            <form action="process.php" method="post">
                First Name: <input type="text" name="first_name" >
                Last Name: <input type="text" name="last_name" >
                Email address: <input type="text" name="email" >
                Password: <input type="password" name="password" >
                Confirm Password: <input type="password" name="confirm_password">
                <input type="submit" class = 'btn' value="register">
                <input type="hidden" name='action' value="register">
            </form>

        <h2>Login</h2>
            <form action="process.php" method="post">
                Email adress: <input type="text" name="email" >
                Password: <input type="password" name="password" >
                <input type="submit" class = 'btn' value="login">
                <input type="hidden" name='action' value="login">
            </form>
    </div>

      <?php
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

        ?>

</div> <!-- #main-container -->
</body>
</html>

