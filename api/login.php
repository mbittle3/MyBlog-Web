<?php
    include 'functions.php';

    // check if email and password fields are empty
    if(empty($_REQUEST['email']) || empty($_REQUEST['password'])){
        // if user and/or email is empty, we will direct back to index.php
        header('Location: ../index.php');
    }
    else{ // proceed with login routine
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        // check that the email exists
        $emailExists = isEmailExist($email);
        if($emailExists){
            $result = login($email, $password);
            echo json_encode($result);
            /*
            if($result){ // successful login
                echo json_encode($result);
            }
            else{
                echo json_encode($result);
            }
            */
        }
        else{
            echo json_encode("Email does not exist.");
        }
    }
?>
