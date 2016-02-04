<?php

    require("database.php");
    
    session_start(); // Starting Session
    $error=''; $user_id=0;// Variable To Store Error Message
    if (isset($_POST['login'])) {
        if (empty($_POST['username']) || empty($_POST['pwd'])) {
            $error = "Username or Password is invalid";
        }
        else
        {
            // Define $username and $password
            $username=$_POST['username'];
            $pwd=$_POST['pwd'];
            $total = 0;
            // SQL query to fetch information of registerd users and finds user match.
            $sql="SELECT  user_id, access_role  FROM account_info WHERE username = '".$username."' 
                    AND password = '".$pwd."'";
            $res = odbc_exec($conn,$sql);
            if ($data = odbc_fetch_array($res)){
                $total = 1;
                $access_role = $data['access_role'];
                $user_id = $data['user_id'];
            }
                

            
            if ($total == 1) {
                $_SESSION['login_user']=$username; // Initializing Session
                 $_SESSION['user_id']=$user_id;
                  $_SESSION['access_role']=$access_role;
                echo    "<script>
                            alert('Access Granted!');
                            window.location.href='php/session.php';
                        </script>";
            } else {
                echo    "<script>
                            alert('Access Denied. Incorrect Username or Password');
                            window.location.href='index.php';
                        </script>";
            }

        }
    }

?>