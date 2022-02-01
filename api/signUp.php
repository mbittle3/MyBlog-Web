<?php
    // include functions
    include 'functions.php';

    if(empty($_REQUEST['name']) || empty($_REQUEST['email']) || empty($_REQUEST['password'])){
        // if user and/or email is empty, we will direct back to index.php
        header('Location: ../index.php');
    }
    else{ // save user information
        $name = $_REQUEST['name'];
        $email =$_REQUEST['email'];
        $password = $_REQUEST['password'];
        $created_Date = date('Y-m-d M:i:s');

        // check if email exists
        $emailExists = isEmailExist($email);
        if($emailExists){ // email exists
            echo "Email already exists";
        }
        else{ // otherwise (not exist) continue sign up process
            $result = signUp($name, $email, $password, $created_Date);

            if($result){
                // convert to JSON to send to android app
                echo json_encode($result);
            }
        }

    }

?>
