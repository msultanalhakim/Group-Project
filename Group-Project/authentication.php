<?php
    include('connection.php');

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM tbl_user WHERE username = '$username' AND $password = 'password'";
    $result = mysqli_query($conn, $query);
    $check = mysqli_num_rows($result);
    if($check > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header('Location:index.php');
    }
?>