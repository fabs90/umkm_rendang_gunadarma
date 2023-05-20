<?php
class input
{
    public static function getValue($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        } elseif (isset($_GET[$name])) {
            return $_GET[$name];
        }

        // Handle the case when the variable is not found
        return false;
    }
}
