<?php
// Start session nya dulu
session_start();

// Matiin semua session
session_destroy();

// Hapus semua isi variabel session
session_unset();
$_SESSION = [];

header('Location:../landingPage/login.php');
