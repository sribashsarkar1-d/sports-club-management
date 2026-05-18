<?php

include '../../config/database.php';
include '../../config/smtp.php';

if(isset($_POST['create_admin'])){

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkEmail = "SELECT * FROM admin_users
                   WHERE email='$email'";

    $checkQuery = mysqli_query($conn, $checkEmail);

    if(mysqli_num_rows($checkQuery) > 0){

        echo "Email Already Exists";

    }else{

        $insert = "INSERT INTO admin_users
                  (full_name, email, password)

                  VALUES

                  ('$full_name', '$email', '$hashPassword')";

        $run = mysqli_query($conn, $insert);

        if($run){

            $subject = "Admin Account Created";

            $message = "
            <h2>Sports Club Management</h2>

            <p>Hello <b>$full_name</b></p>

            <p>Your admin account created successfully.</p>

            <p><b>Email:</b> $email</p>
            ";

            sendMail($email, $subject, $message);

            echo "Admin Created Successfully";

            header('refresh:2;url=login.php');

        }else{

            echo "Signup Failed";
        }
    }
}

?>