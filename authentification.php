<?php
include_once 'database.php';
session_start();

$db = new database();



 if(isset($_SESSION['user']))
    {
        header("location: connexion.php");
    }



include 'authentification.phtml';


if (isset($_POST['Login'])) {


$pseudo=$_POST['Pseudo'];
$motPass=$_POST['pass'];
if(empty($pseudo)||empty($motPass)){
        echo '<script language="Javascript"> alert ("veuillez remplir le formulaire" )</script>';}



$select="SELECT * FROM electeur ";
$e = $db->getMany($select);               

if(!empty($e))
        { 
            $nb = false;
            foreach ($e as $row)
            {
                if(($motPass==$row['motPass']) & ($pseudo == $row['pseudo']))
                {
                    $nb = true;
                    $_SESSION['user'] = [
                        'id' => $row['idElecteur'],
                        'pseudo' => $row['pseudo'],
                        'idPartiElu' => $row['idPartiElu'],
                        'idGouvernorat' => $row['idGouvernorat']
                        
                    ];
                    header('location:connexion.php');

 }}
     if(!$nb){
      	 $error = 'Username or password is incorrect';
                header("refresh: 0");
      }
  }
      }
?>