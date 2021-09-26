<?php 

// -----------------------------
//Contient les fonctions liées aux autorisations et aux roles
// -----------------------------
// getIdRole($idUser,$idActivite)
//argument : L'id de l'utilisateur et l'id de l'activité
// Fonction : Permet d'obtenir l'id du role d'un utilisateur sur une activité
// Sortie : $idRole['idRole'] : id du role de l'utilisateur
function getIdRole($idUser,$idActivite)
{
	 $db = getBD();// connexion à la BD
  
  // Création de la string pour la requête. 
  $requete = "SELECT idRole FROM tblautorisation
  where idUser='".$_SESSION["idUser"]."' AND  idActivite='".$_SESSION["idActivite"]."'";
  // Exécution de la requete
 $res = $db->query($requete);
  $idRole = $res->fetch();
	return $idRole['idRole'];
}
// -----------------------------
// getIdRoleB($nomRole)
//Argument : Nom du rôle
 //Fonction : Récupère l'id d'un role à partir de son nom
 //Sortie : idRole['idRole'] : contient l'id du role
 function getIdRoleB($nomRole)
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT idRole FROM tblrole WHERE nomRole='".$nomRole."'";
	// Exécution de la requete
	$res = $db->query($requete);
	$idRole = $res->fetch();
	return $idRole['idRole'];
 }
// -----------------------------
// getNomRole($idRole)
//argument : L'id du rôle
// Fonction : Permet d'obtenir le nom d'un rôle en fonction de son id
// Sortie : $nomRole['nomRole']; : nom du rôle 
function getNomRole($idRole)
{
	 $db = getBD();// connexion à la BD
	// Création de la string pour la requête. 
	$requete = "SELECT nomRole FROM tblrole where idRole='".$idRole."'";
	// Exécution de la requete
	$res = $db->query($requete);
	$nomRole = $res->fetch();
	return $nomRole['nomRole'];
}

// -----------------------------
// listeAutori()
// Fonction : Récupérer l'ensemble des autorisations d'une activité
//Sortie users : contient les autorisations de l'activité
 function listeAutori()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT tbluser.idUser,login, tblrole.idRole, nomRole FROM tbluser inner join tblautorisation on tbluser.idUser=tblautorisation.idUser inner join tblrole on tblautorisation.idRole=tblrole.idRole where idActivite='".$_SESSION["idActivite"]."' order by login;";
	// Exécution de la requete
	$users = $db->query($requete);
	return $users;
 }
 // -----------------------------
// listeRole()
// Fonction : Récupérer l'ensemble des roles de la table role
//Sortie roles : contient les différents roles
  function listeRole()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tblrole order by nomRole;";
	// Exécution de la requete
	$roles = $db->query($requete);
	return $roles;
 }
 // -----------------------------
// listeRoleA()
// Fonction : Récupérer une partie des roles de la table role.
// C'est la liste des roles que l'admin peut nommer (il ne peut pas nommer de super-admin ou d'admin)
//Sortie roles : contient les différents roles
 function listeRoleA()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tblrole where idRole=3 OR idRole=4 order by nomRole;";
	// Exécution de la requete
	$roles = $db->query($requete);
	return $roles;
 }
 
 // -----------------------------
// infoAutori($idUser)
//Argument : id de l'utilisateur
 //Récupère les autorisations d'un utilisateur en particulier
 function infoAutori($idUser) 
{
	erreurUrl($idUser);
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT tbluser.idUser,login,nomRole FROM tbluser 
	inner join tblautorisation on tbluser.idUser=tblautorisation.idUser 
	inner join tblrole on tblautorisation.idRole=tblrole.idRole 
	where idActivite='".$_SESSION["idActivite"]."' AND tblautorisation.idUser='".$idUser."' ;";
	// Exécution de la requete
	$resultats = $db->query($requete);
	$infoAutori=$resultats->fetch();
	return $infoAutori;
 }
  
 // -----------------------------
// ajoutAutori($postArray)
//Argument : les informations passées en POST
// Fonction : Ajouter une autorisation
 function ajoutAutori($postArray)
{
	$db=getBD();
	try
	{	
		//Récupération des données passées en post
		$login=$postArray["fLogin"];
		$role=$postArray ["fSRole"];
		$idActivite=$_SESSION['idActivite'];
		$idUser=getIdUser($login);
		$idRole=getIdRoleB($role);
		erreurXss1($login);//test erreur
		erreurXss1($role);
		//Début Source : module 151--le test de la partie doublon
		// test si le nom de l'activité existe déjà pour éviter les doublons sur des activités
		
		$reqSelect ="SELECT * FROM tblautorisation 
		WHERE idUser='".$idUser."' AND idActivite='".$idActivite."';";
		$res=$db->query($reqSelect);
		$ligneB = $res->fetch(); // récupère la valeur de l'activité sélectionné s'il y en a un  
		
		$reqSelect ="SELECT * FROM tbluser
		WHERE login='".$login."' OR email='".$login."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur de l'activité sélectionné s'il y en a un  
		// Test le résultat
		if (empty ($ligneB) AND isset($ligne['idUser']))
			{
				// ajout de l'activité
				$req = $db->prepare('INSERT INTO tblautorisation (idActivite,idRole,idUser)
					VALUES (:idActivite, :idRole, :idUser)');
				$req->execute(array(
				'idActivite'=>$idActivite,
				'idRole' => $idRole,
				'idUser'=>$idUser,
				));
			$_SESSION['modif']="L'utilisateur a bien été ajouté";
			return true;
			}
		else
		{  
			throw new Exception("
			<p>L'utilisateur ne peut pas être ajouté car il possède déjà une autorisation ou l'utilisateur n'existe pas.</p>
			");
      //return false;//<p><a href='index.php?action=vue_autorisation_gestion'> 
			//<button type='button' class='btn btn-primary btn-sm'  ><strong>Revenir à la gestion des utilisateurs</strong></button> </a></p>    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
    //require "vue/vue_erreur.php";
  }
  //Fin Source : module 151
 }
 // updAutori($postArray)
// Fonction : Mettre à jour l'autorisation d'un utilisateur 
//Argument : les informations sur l'autorisation passées en POST
 function updAutori($postArray)
 {
	$db=getBD();
	$NRole=$postArray ["fNSRole"];
	$login=$postArray ["fLogin"];
	$idRole=getIdRoleB($NRole);
	$idUser=getIdUser($login);
	try
	{
		erreurXss1($NRole);
		// Modification de l'activité
		$req = $db->prepare("update tblautorisation set idRole=:idRole 
			WHERE idUser='".$idUser."' AND idActivite='".$_SESSION['idActivite']."';");
				$req->execute(array(
				'idRole' => $idRole,
				));
		$_SESSION['modif']="L'auorisation a bien été mis à jour";
		return true;
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
 }
  // -----------------------------
// delAutori($idUser)
// Fonction : Permet de supprimer une autorisation
//Argument : L'id de l'autorisation à supprimer
 function delAutori($idUser)
 {	
	erreurUrl($idUser);
	try
	{
		$db=getBD();
		$requete='SELECT COUNT(idUser)  FROM tblautorisation where idActivite="'.$_SESSION["idActivite"].'" ;';
		$res=$db->query($requete);
		//Source pour fetchColumn : http://php.net/manual/fr/pdostatement.rowcount.php
		if($res->fetchColumn()<=1)
		{
			throw new Exception("<p>Vous devez donner les droits à un autre utilisateur ou d'abord supprimer l'activité avant de pouvoir vous enlevez les droits</p><p><a href='index.php?action=vue_autorisation_gestion'> 
			<button type='button' class='btn btn-primary btn-sm'  ><strong>Revenir à la gestion des utilisateurs</strong></button> </a></p>");
		}
		else
		{
			$requete = 'DELETE FROM tblautorisation WHERE idUser ="'.$idUser.'" AND idActivite="'.$_SESSION["idActivite"].'";';
			$db->exec($requete);
		}
		
	}
	 catch (Exception $e)
		{
				$_SESSION['erreur']=$e->getMessage();
				require "vue/vue_erreur.php";
		}
 }
 

 
 ?>