<?php 
function createSessionRole($idUser,$idActivite)
{
	$_SESSION["idRole"]=getIdRole($idUser,$idActivite);
	$_SESSION["nomRole"]=getNomRole($_SESSION["idRole"]);
	
}
/*function CreateSessionUser()
{
			$_SESSION["idUser"]=$infoUser['idUser'];
			$_SESSION['login']=$infoUser['login']; 
			$_SESSION['error']="";
} */
function createSessionActivite($nomAct)
{
	$_SESSION["idActivite"]=getIdActivite($nomAct);
	$_SESSION["nomAct"]=$nomAct;
}
?>