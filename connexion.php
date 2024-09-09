<?php
include_once 'database.php';


session_start();

 if(isset($_SESSION['user']))
        $username = $_SESSION['user']['pseudo'];
    $id=$_SESSION['user']['id'];

      include 'connexion.phtml';

?>