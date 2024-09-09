<?php
session_start();

include 'database.php';
$db = new database();


if(!isset($_SESSION['user']))
{
    header('location:authentification.php');
    
}





$id=$_SESSION['user']['id'];
$pseudo=$_SESSION['user']['pseudo'];
//$idPartiElu=$_SESSION['user']['idPartiElu'];
//$idGouvernorat=$_SESSION['user']['idGouvernorat'];
$n=NULL;

$select="SELECT * FROM electeur WHERE idElecteur='$id'";
$e = $db->getMany($select);               

if(!empty($e))
{
	 foreach ($e as $row)
            {
	$idPartiElu = $row['idPartiElu'];
	$idGouvernorat = $row['idGouvernorat'];
}
}
if ($idPartiElu==NULL) {
	# code...
  echo '<script language="Javascript"> alert ("
Veuillez voter" )</script>';
             //   header("refresh: 0");
                header("Refresh:0; url=voter.php");
}
else
{

$parti="SELECT nomParti FROM partipolitique WHERE idParti='$idPartiElu'";
$p = $db->getOne($parti);
if(!empty($p))
{
	
	
	$nomParti = $p['nomParti'];

}

$gouv="SELECT nomGouvernorat FROM gouvernorat WHERE idGouvernorat='$idGouvernorat'";
$G = $db->getOne($gouv);
if(!empty($G))
{
	
	
	$nomGouvernorat = $G['nomGouvernorat'];

}
}
if (isset($_POST['supprimer'])) {


$supp="UPDATE electeur SET idPartiElu = NULL where idElecteur ='$id'";
if ($db->sendSQL($supp)) 
	{

                                     
                                    header("location:voter.php");


}



}








/*echo "$id ,$pseudo ";
echo "$idPartiElu";
echo "$idGouvernorat";
echo "$nomGouvernorat";
echo "$nomParti";

*/

include 'consultervote.phtml';
















?>