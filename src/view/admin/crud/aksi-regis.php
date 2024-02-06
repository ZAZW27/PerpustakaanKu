<?php

session_start();
include '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the registration form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];
    $email    = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat   = $_POST['alamat'];

    // Hash the password securely
    $hashedPassword = md5($password);

    // Insert user data into the database
    $insertQuery = "INSERT INTO tbl_user (username, password, level, email, nama_lengkap, alamat) VALUES ('$username', '$hashedPassword', '$level', '$email', '$nama_lengkap', '$alamat')";
    
    if (mysqli_query($con, $insertQuery)) {
        // Registration successful
        echo "<script>alert('Registration successful. You can now log in.'); window.location.href='../login.html';</script>";
    } else {
        // Registration failed
        echo "<script>alert('Registration failed. Please try again.'); window.history.go(-1);</script>";
    }
}
?>