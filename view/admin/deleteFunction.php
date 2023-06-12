<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";
$db = new connection();
$menu = new Menu();
$id = $_GET['id'];
if ($menu->destroy($id)) {
    return true;
}
return false;
