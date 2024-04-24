<?php
include "koneksi.php";
session_start();

if(!isset($_SESSION['userid'])){
    header("Location: index.php");
    exit(); // Exit to prevent further execution
} else {
    $fotoid = mysqli_real_escape_string($conn, $_GET['fotoid']); // Sanitize input
    $userid = $_SESSION['userid'];

    // Check if the user has already liked the photo
    $like_check_sql = "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'";
    $like_check_result = mysqli_query($conn, $like_check_sql);

    if(!$like_check_result){
        // Handle query error
        die("Error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($like_check_result) == 0){
        // User has not liked the photo, insert a new like
        $like_query = "INSERT INTO likefoto (fotoid, userid) VALUES ('$fotoid', '$userid')";
        if(mysqli_query($conn, $like_query)){
            // Disable the like button using JavaScript and change its text
            echo '<script type="text/javascript">document.getElementById("likeButton").disabled = true; document.getElementById("likeButton").innerHTML = "Liked";</script>';
            header("Location: landingpage.php");
            exit();
        } else {
            // Handle like error
            die("Error: " . mysqli_error($conn));
        }
    } else {
        // User has already liked the photo, unlike it
        $unlike_query = "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'";
        if(mysqli_query($conn, $unlike_query)){
            // Disable the like button using JavaScript and change its text
            echo '<script type="text/javascript">document.getElementById("likeButton").disabled = true; document.getElementById("likeButton").innerHTML = "Liked";</script>';
            header("Location: landingpage.php");
            exit();
        } else {
            // Handle unlike error
            die("Error: " . mysqli_error($conn));
        }
    }
}
?>
