<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

class User
{
    private $_db;

    public function __construct()
    {
        $this->_db = connection::getInstance();
    }

    public function register_user($fields = array())
    {
        if ($this->_db->insert('users', $fields)) {
            return true;
        } else {
            return false;
        }

    }

    public function login_user($username, $password)
    {

        // Get info from database
        $data = $this->_db->get_info('users', 'username', $username);
        // Ubah data password menjadi string, karena kolom varchar
        $value = "'" . $data['password'] . "'";
        // Check if db pass == input pass
        if (password_verify($password, $value)) {
            return true;
        }
        return false;
    }

    public function cek_nama($username)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        if (empty($data)) {
            return false;
        }
        return true;
    }

}
