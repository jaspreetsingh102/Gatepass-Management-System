<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'Rector') {
    header("Location: project/Ractor/login/login.ph"); // Redirect to login page
    exit();
}
?>