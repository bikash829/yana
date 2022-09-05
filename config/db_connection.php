<?php
define("DB", 'yana');
define("HOST", '127.27.0.1');
define("USER", 'root');
define("PASSWORD", '');


function db_connection()
{
    return new mysqli(HOST, USER, PASSWORD, DB);
}
