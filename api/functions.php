<?php

    // include connection to database
    include '../auth/connDB.php';

    function signUp($user, $email, $password, $created_Date){
        // database connection
        global $conn;

        // remove/escape special characters from $user, $email, $password, $created_Date to prevent SQL injection
        // escaped by '\\' double backslash
        $USER_NAME = mysqli_real_escape_string($conn, $user);
        $USER_EMAIL = mysqli_real_escape_string($conn, $email);
        $USER_PASSWORD = mysqli_real_escape_string($conn, $password);

        // create hash for password for security
        $PASSWORD = password_hash($USER_PASSWORD, PASSWORD_ARGON2ID);

        // insert query
        $query = " INSERT INTO `users`(`name`, `email`, `password`, `created_date`) ";
        $query .= "VALUES ('$USER_NAME', '$USER_EMAIL', '$PASSWORD', '$created_Date')";

        // fetch results
        $results = mysqli_query($conn, $query);

        if(!$results){
            // query fail
            // die("Query Failed") . mysqli_error($conn);
            return "Query Failed";
        }
        else{
            // return true
            return $results;
        }


    }

    function login($email, $password){
        global $conn;

        // prevent SQL injection
        $USER_EMAIL = mysqli_real_escape_string($conn, $email);
        $USER_PASSWORD = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM users WHERE email = '$USER_EMAIL'";
        $result = mysqli_query($conn, $query);

        if($result){
            $rowcount = mysqli_num_rows($result);
            if($rowcount == 1){ // email does exists
                // fetch user results
                $user = mysqli_fetch_array($result);
                // extract password
                $PASSWORD = $user['password'];

                //verify if $PASSWORD and $USER_PASSWORD (param) match
                if(password_verify($USER_PASSWORD, $PASSWORD)){
                    // parameter password and database password match
                    return true;
                }
                else{
                    return "Password does not match.";
                }
            }
        }
        else{
            // query fail
             die("Query Failed") . mysqli_error($conn);
            //return "Query Failed";
        }


    }


    function isEmailExist($email){
        global $conn;

        // check to see if email exists in database
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        // check if query executed
        if($result){
            // get number of rows associated with email
            $rows = mysqli_num_rows($result);
            if($rows >= 1){ // email already exists in database
                return true;
            }
            else{
                return false;
            }
        }
        else{
            // query fail
            // die("Query Failed") . mysqli_error($conn);
            return "Query Failed";
        }

    }

?>







