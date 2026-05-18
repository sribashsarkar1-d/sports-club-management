<?php

include '../../config/database.php';
include '../../config/session.php';
include '../../config/smtp.php';

if(isset($_POST['update_athlete'])){

    $athlete_id = intval($_POST['athlete_id']);

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    $athlete_status = mysqli_real_escape_string($conn, $_POST['athlete_status']);

    $update = mysqli_query($conn,

    "UPDATE athletes SET

    full_name='$full_name',
    email='$email',
    mobile='$mobile',
    athlete_status='$athlete_status'

    WHERE athlete_id='$athlete_id'");

    if($update){

        mysqli_query($conn,

        "INSERT INTO activity_logs

        (admin_id, athlete_id, activity)

        VALUES

        ('".$_SESSION['admin_id']."',
        '$athlete_id',
        'Athlete Updated Successfully')");

        $subject = "Sports Club Registration Update";

        $message = "

        <h2>Hello $full_name</h2>

        <p>Your athlete profile updated successfully.</p>

        <p><b>Status :</b> $athlete_status</p>

        <p>Please login to check latest updates.</p>

        ";

        sendMail($email, $subject, $message);

        header("Location: athlete-view.php?id=".$athlete_id);

    }else{

        echo "Update Failed";
    }
}

?>