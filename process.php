<?php

session_start();

require_once('connection.php');


    if(isset($_POST['action']) && $_POST['action'] == "register")
    {
        register_user($_POST);
    }

    elseif(isset($_POST['action']) && $_POST['action']== "login")
    {
        login_user($_POST);
    }

    elseif(isset($_POST['action']) && $_POST['action'] == "message")
    {
        message_user($_POST);
    }

    elseif(isset($_POST['action']) && $_POST['action'] == "comment")
    {
        comment_user($_POST);
        header('Location: wall.php');
    }

    elseif (isset($_POST['action'])&& $_POST['action']= "delete")
    {
        delete_comment($_POST);
        header('Location: wall.php');
    }

    elseif(isset($_GET['a'])&&$_GET['a']=='logoff')
    {
        session_destroy();
        header('location: index.php');
    }

    else
    {
        header('location: index.php');
    }

    function register_user($post)
    {
        //---- Begin valdiation checks
        $_SESSION['errors'] = array();

        if(empty($post['first_name']))
        {
            $_SESSION['errors'][] = "First name can't be blank!";
        }

        if(empty($post['last_name']))
        {
            $_SESSION['errors'][] = "Last name can't be blank!";
        }

        if($post['password'] != $post['confirm_password'])
        {
            $_SESSION['errors'][] = "Passwords must match!";
        }

        if(empty($post['password']))
        {
            $_SESSION['errors'][] = "Password field is required!";
        }

        if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['errors'][] = "Please use a valid email address!";
        }

        /////-- End of validation check

        if(count($_SESSION['errors']) > 0)
        {
            header('location: index.php');
            die();
        }

        else // insert data into database
        {
            $first_name = escape_this_string($post['first_name']);
            $last_name = escape_this_string($post['last_name']);
            $email = escape_this_string($post['email']);
            $password = md5($post['password']);
            $query = "INSERT INTO users (first_name, last_name, email,  password, created_at, updated_at) VALUES('{$first_name}', '{$last_name}', '{$email}', '{$password}', NOW(), NOW())";
            run_mysql_query($query);
            $_SESSION['success_message'] = "User successfully created!";
            header('location: wall.php');
        }
    }

    function login_user($post)
    {
        $email = escape_this_string($post['email']);
        $password = md5($post['password']);
        $query = "SELECT * FROM users WHERE users.email = '{$email}' AND
                    users.password = '{$password}'";
        $user = fetch_all($query);
        if(count($user) > 0)
        {
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['first_name'] = $user[0]['first_name'];
            $_SESSION['last_name'] = $user[0]['last_name'];
            $_SESSION['logged_in'] = TRUE;
            // var_dump($_SESSION);
            // die();
            header('location: wall.php');
        }

        else
        {
            $_SESSION['errors'][] = "Can't find a user with those credentials";
            header('location: index.php');
            die();
        }

    }

    function message_user($post)
    {
        if(empty($post['message']))
        {
            $_SESSION['errors'][] = "Messages can't be blank!";
        }
        if(strlen($post['message'])<6)
        {
            $_SESSION['errors'][] = "Your messeage should be more than 6 characters";
        }

        else // insert data into database
        {
            $query_message = "INSERT INTO messages (message, user_id, created_at, updated_at) VALUES('{$post['message']}', '{$post['user_id']}', NOW(), NOW())";
            run_mysql_query($query_message);
            $_SESSION['success_message_posted'] = "Message successfully posted!";
            header('location: wall.php');
            die();
        }

    }

    function comment_user($post)
    {
        if(empty($post['comment']))
        {
            $_SESSION['errors'][] = "Comments can't be blank!";
        }
        elseif(strlen($post['comment'])<2)
        {
            $_SESSION['errors'][] = "Your comment should be more than 2 characters";
        }

        else
        {
            $query_comment = "INSERT INTO comments (comment, message_id, user_id, created_at, updated_at) VALUES('{$post['comment']}', {$post['message_id']},{$post['user_id']}, NOW(), NOW())";
            if(!run_mysql_query($query_comment)){
                $_SESSION['errors'][] = 'Comment was not posted.';
                $_SESSION['errors'][] = $query_comment;
            }

            $_SESSION['success_comment_posted'] = "Comment successfully posted!";
            header('location: wall.php');
        }
    };

    function delete_comment($post)
    {
        $query_delete_comment = "DELETE from comments WHERE comments.id = ".$_POST['comment_id'];
        run_mysql_query($query_delete_comment);
    }
?>
