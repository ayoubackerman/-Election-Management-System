<?php
session_start();

include 'database.php';
$db = new database();


if(!isset($_SESSION['user']))
{
    header('location:authentification.php');
    
}



$id = $_SESSION['user']['id'];
$sql="SELECT idParti,nomParti FROM partipolitique";
$parti = $db->getMany($sql);
 



include 'voter.phtml';
if (isset($_POST['valider'])) {
	$cmd = "SELECT * FROM electeur WHERE idElecteur='$id'";
$e= $db->getOne($cmd);
if(!empty($e))
        {
            if($e['idPartiElu'] != NULL)
            {
                
                //$error = "Username already exist";
                 echo '<script language="Javascript"> alert ("vous avez déjà voté" )</script>';
                header("refresh: 0");

            }
            else
        {
          
$idParti=$_POST['parti'];

$insert="UPDATE electeur SET idPartiElu ='$idParti' where idElecteur ='$id'";
if ($db->sendSQL($insert)) 
    {

                                     
                                    header("location:enrigvote.php");



}
        }
        
}
}
?>