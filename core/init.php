<?php
session_start();    
//  Load semua kelas
//load all class files automatically
spl_autoload_register(function ($class) {
    require_once "c:/xampp/htdocs/Project/admin_interface_umkm/class/" . $class . ".php";
});

$user = new User();