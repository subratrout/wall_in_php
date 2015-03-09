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
       echo "<a href = 'process.php?a=logoff'>LOG OFF</a>" ?>
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
  <div class="message">
    <?php
    $query_message = "SELECT messages.id as id, messages.created_at, users.first_name, users.last_name, messages.message FROM messages LEFT JOIN users on messages.user_id =users.id";
    $message_results = fetch_all($query_message);

    ?>
    <h3> Messages: </h3>
    <?php
    foreach($message_results as $message_row)
    {
      echo "<p>".$message_row['first_name']." ".$message_row['last_name']."-".$message_row['created_at']."</p>";
      echo "<p>".$message_row['message']."</p>";


$query_comments = "SELECT users.first_name, users.last_name, comments.comment, comments.created_at, comments.message_id, messages.user_id FROM users LEFT JOIN messages on users.id=messages.user_id LEFT JOIN comments on comments.message_id=messages.id where messages.id={$message_row['id']}";
  $comments_results = fetch_all($query_comments);

       foreach ($comments_results as $comment_row)
       {
        echo "<p>".$comment_row['first_name']." ".$comment_row['last_name']."-".$comment_row['created_at']."</p>";
        echo "<p>".$comment_row['comment']."</p>";
       }
      ?>
            <form class="comments" action="process.php" method="post">
                <textarea name="comment" rows="3" cols="80" ></textarea>
                <input type="submit" class = 'btn-comment' value="Post a Comment">
                <input type="hidden" name='action' value="comment">
                <input name="user_id" type="hidden" value="<?php echo $_SESSION['user_id'];?>" id="user_id">
                <input name="message_id" type="hidden" value="<?php echo $message_row['id'];?>">
            </form>
<?php
    }

    ?>

    <?php



    ?>

  </div>
</div> <!-- #main-container -->
</body>
</html>
