<?php
// ------------ Activités --------------------- 
//Fonctions liées aux activités
// -----------------------------

// getIdActivite($nomAct)
//Argument : Le nom de l'activité
// Fonction : Récupérer l'id de l'activité en fonction du nom de l'activité
//Utilisée : ajoutActivite
//Sortie : $idActivite['idPActivite']. c'est l'id de l'activité
function getIdActivite($nomAct)
{
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT idActivite FROM tblactivite WHERE nomAct='".$nomAct."'";
	// Exécution de la requete
	$res = $db->query($requete);
	$idActivite = $res->fetch();
	return $idActivite['idActivite'];
}

// -----------------------------
// getActivite($idUser)
//Argument : l'id de l'utilisateur
// Fonction : Récupérer l'ensemble des activités d'un utilisateur en fonction de son id
//Sortie : $resultats. Liste des activités de l'utilisateur

function getActivite($idUser)
{

  $db = getBD();// connexion à la BD
  
  // Création de la string pour la requête. 
  $requete = "SELECT nomAct, tblactivite.idActivite FROM tblactivite 
  inner join tblautorisation on tblactivite.idActivite=tblautorisation.idActivite
  inner join tbluser on tbluser.idUser=tblautorisation.idUser 
  where tblautorisation.idUser='".$_SESSION["idUser"]."' 
  ORDER BY tblactivite.idActivite";
  // Exécution de la requete
  $resultats = $db->query($requete);
  return $resultats;
}
// -----------------------------
// infoActivite()
// Fonction : Récupérer les informations de l'activité en cours de l'utilisateur
//Sortie : $resultats. Liste des activités de l'utilisateur
function infoActivite()
{
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tblactivite where idActivite='".$_SESSION['idActivite']."';";
	// Exécution de la requete
	$resultats = $db->query($requete);
	$activite=$resultats->fetch();
	return $activite;
}
 // -----------------------------
// ajoutActivite($postArray)
//Argument : les informations passées en POST
// Fonction : Ajouter une activité
function ajoutActivite($postArray)
{
	$db=getBD();
	try
	{	
		//Récupération des données passées en post
		$nomAct=$postArray ["fNomAct"];
		$descriptAct=$postArray ["fDescriptAct"];
		$dateCreation=date('Y-m-d H:i:s'); //Src : http://www.pontikis.net/tip/?id=18
		//Teste les erreurs
		champVide($nomAct,"Nom de l'activité");
		lengthChamp($nomAct,"Nom de l'activité",32);
		erreurXss1($nomAct);//test erreur
		$descriptAct=erreurText($descriptAct); 
		///
		
		//Début Source : module 151 donné par M.Benzonana Pascal--le test de la partie doublon
		// test si le nom de l'activité existe déjà pour éviter les doublons sur des activités
		$reqSelect ="SELECT * FROM tblactivite WHERE nomAct='".$nomAct."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur de l'activité sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomAct']))
			{
				// ajout de l'activité
				$req = $db->prepare('INSERT INTO tblactivite (nomAct,descriptAct,dateCreation)
					VALUES (:nomAct, :descriptAct, :dateCreation)');
				$req->execute(array(
				'nomAct' => $nomAct,
				'descriptAct' => $descriptAct,
				'dateCreation'=>$dateCreation
				));
				$idUser=getIdUser($_SESSION['login']); //Récupère l'id de l'utilisateur
				createSessionActivite($nomAct);//Création des sessions liées à l'activité
				$req = $db->prepare('INSERT INTO tblautorisation (idUser,idActivite,idRole)
					VALUES (:idUser,:idActivite,:idRole)');
				$req->execute(array(
				'idUser' =>$idUser,
				'idActivite'=>$_SESSION["idActivite"],
				'idRole' =>1,
				));
			$resultats=true;
			return $resultats;
			}
		else
		{  
			throw new Exception("L'activité ne peut pas être ajoutée car elle existe déjà.");
      //return false;    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
    //require "vue/vue_erreur_visiteur2.php";
	require "vue/vue_activite_add.php";
  }
  //Fin Source : module 151
 }
   // -----------------------------
// updActivite($postArray)
// Fonction : Mettre à jour l'activité  
//Argument : les informations sur l'activité passées en POST
 function updActivite($postArray)
 {
	$db=getBD();
	$NNomAct=$postArray ["fNNomAct"];
	$NDescriptAct=$postArray ["fNDescriptAct"];
	try
	{
		erreurXss1($NNomAct);
		$NDescriptAct=erreurText ($NDescriptAct);
		champVide($NNomAct,"Nom de l'activité");
		lengthChamp($NNomAct,"Nom de l'activité",32);
		
		$reqSelect ="SELECT * FROM tblactivite WHERE nomAct='".$NNomAct."' AND nomAct!='".$_SESSION['nomAct']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du projet sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomAct']))
			{
				// Modification de l'activité
				$req = $db->prepare("update tblactivite set nomAct=:nomAct,descriptAct=:descriptAct 
				WHERE nomAct='".$_SESSION['nomAct']."' AND idActivite='".$_SESSION['idActivite']."';");
				$req->execute(array(
				'nomAct' => $NNomAct,
				'descriptAct' => $NDescriptAct,
				));
			$_SESSION['nomAct']=$NNomAct;
			$_SESSION['modif']="L'activité a bien été mis à jour";
			return true;
			}
		else
		{  
			throw new Exception("<p>L'activité ne peut pas être modifié car une autre activité possède déjà le même nom.</p>"); 
			//<p><a href='index.php?action=vue_activite'> <button type='button' class='btn btn-primary'  ><strong>Revenir à l'activité</strong></button> </a> </p>
      //return false;    
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur_upd.php";
	}
 }
 function delActivite($idActivite)
 {
	
	
	try
	{
		$db=getBD();
		$requete = 'Select idListeMateriel FROM tbllistemateriel WHERE idActivite ="'.$_SESSION['idActivite'].'";';
		$resultats=$db->query($requete);
		while ($donnees = $resultats->fetch())
		{
			$requete = 'DELETE FROM tbllignemateriel WHERE idListeMateriel ="'.$donnees['idListeMateriel'].'";';
			$db->exec($requete);
		}
		$requete = 'DELETE FROM tbllistemateriel WHERE idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
		
		$requete = 'Select idPlanning FROM tblplanning WHERE idActivite ="'.$_SESSION['idActivite'].'";';
		$resultats=$db->query($requete);
		while ($donnees = $resultats->fetch())
		{
			$requete = 'DELETE FROM tblligneplanning WHERE idPlanning ="'.$donnees['idPlanning'].'";';
			$db->exec($requete);
		}
		$requete = 'DELETE FROM tblplanning WHERE idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
		$requete = 'DELETE FROM tbllieu WHERE idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
		$requete = 'DELETE FROM tblparticipant WHERE idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
		///
		rrmdir("contenu/documents/".$_SESSION['idActivite']);
		$requete = 'DELETE FROM tbldocument WHERE idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
		
		//
		$requete = 'delete FROM tblautorisation WHERE idActivite ="'.$_SESSION['idActivite'].'";';
		$db->exec($requete);
		$requete = 'delete FROM tblactivite WHERE idActivite ="'.$_SESSION['idActivite'].'";';
		$db->exec($requete);
	}
	
	catch (Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
			$_SESSION['erreur']=$e->getMessage();
	}
 }
 
 
 ?>