<?php

class createCon  {
    var $host = 'localhost';
    var $user = 'root';
    var $pass = '';
    var $db = 'rainloop';
    var $myconn;

    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$con) {
            die('Could not connect to database!');
        } else {
            $this->myconn = $con;
        }
        return $this->myconn;
    }

    function close() {
        mysqli_close($myconn);
    }

	
}
function quitaEspeciales($string ){
 $string = htmlentities($string);
 $string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
 return $string;
}