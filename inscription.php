<?php
session_start();
include_once 'database.php';
$db = new database();


$sql="SELECT idGouvernorat,nomGouvernorat FROM gouvernorat";
$gouvernorat = $db->getMany($sql);






include 'inscription.phtml';


if (isset($_POST['insert'])) {

$date_val=date("Y-m-d");
$pseudo=$_POST['Pseudo'];
$motPass=$_POST['pass'];
$age=$_POST['age'];
$idgouvernorat=$_POST['gouvernorat'];
if(empty($pseudo)||empty($motPass)||empty($age)){
        echo '<script language="Javascript"> alert ("veuillez remplir le formulaire" )</script>';}



$cmd = "SELECT * FROM electeur WHERE pseudo='$pseudo'";
$e= $db->getOne($cmd);
if(!empty($e))
        {
            if($e['Username'] == $username)
            {
                $canSignup = false;
                $error = "Username already exist";
                 echo '<script language="Javascript"> alert ("username already exist" )</script>';
                header("refresh: 0");

            }
        }
        else
        {
            
            $canSignup = true;
            
        }
 if($canSignup)
        {
            //echo $canSignup;

$insert="INSERT INTO electeur(pseudo,motPass,age,dateInscription,idGouvernorat) VALUES ('$pseudo','$motPass','$age','$date_val','$idgouvernorat')";


 if ($db->sendSQL($insert)) 
       {
      /* $_SESSION['user'] =  [
                        'id' => $row['idElecteur'],
                        'pseudo' => $row['pseudo'],
                        'idPartiElu' => $row['idPartiElu'],
                        'idGouvernorat' => $row['idGouvernorat']
                        
                    ];*/

                header("location:done.php");
      }
  }
}

      
?>