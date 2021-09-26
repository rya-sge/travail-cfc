<?php
 // -----------------------------
// getIdPlanning($nomPlanning)
//Argument : le nom du planning
// Fonction : Récupérer l'id du planning à partir de son nom
//Sortie $idPlanning['idPlanning']. C'est l'id du planning passé en paramètre
function getIdPlanning($nomPlanning)
{
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT idPlanning FROM tblplanning WHERE nomPlanning='".$nomPlanning."' AND idActivite='".$_SESSION["idActivite"]."';";
	// Exécution de la requete
	$res = $db->query($requete);
	$idPlanning = $res->fetch();
	return $idPlanning['idPlanning'];
}
// -----------------------------
// listePlanning()
// Fonction : Récupérer l'ensemble des plannings d'une activités
//Sortie plannings. Contient les plannings de l'activités
 function listePlanning()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tblplanning where idActivite='".$_SESSION["idActivite"]."' order by nomPlanning;";
	// Exécution de la requete
	$plannings = $db->query($requete);
	return $plannings;
 }
 // -----------------------------
// infoPlanning($idPlanning)
//Argument : l'id du planning
// Fonction : Récupérer les informations d'un planning donné
//Sortie planning. Contient les informations du planning
 function infoPlanning($idPlanning) 
{
	erreurUrl($idPlanning);
	$db = getBD();
	// Création de la string pour la requête
	try
	{
		$requete = "SELECT * FROM tblplanning where idPlanning='".$idPlanning."' AND idActivite='".$_SESSION['idActivite']."';";
		// Exécution de la requete
		$resultats = $db->query($requete);
		$planning=$resultats->fetch();
		if (empty($planning['idPlanning']))
		{
			throw new Exception("<p>Ce planning est inconnu ou vous n'avez pas les droits nécessaires pour le modifier. </p><p><a href='index.php?action=vue_planning_gestion'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des plannings</button> </a> </p>");
		}
		else
		{
			return $planning;
		}
	}
	
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
 }
 // -----------------------------
// ajoutPlanning($postArray)
//Argument : les informations passées en POST
// Fonction : Ajouter un planning
 function ajoutPlanning($postArray)
{
	$db=getBD();
	try
	{	
		//Récupération des données passées en post
		$nomPlanning=$postArray ["fNomPlanning"];
		$descriptPlanning=$postArray ["fDescriptPlanning"];
		$dateCreation=date('Y-m-d H:i:s'); //Src : http://www.pontikis.net/tip/?id=18
		$idActivite=$_SESSION['idActivite'];
		
		erreurXss1($nomPlanning);//test erreur 
		$descriptPlanning=erreurText($descriptPlanning);
		champVide($nomPlanning,"nom du planning");
		lengthChamp($nomPlanning,"Nom du planning",32);
		
		//Début Source : module 151--le test de la partie doublon
		// test si le nom du planning existe déjà pour éviter les doublons sur les plannings au sein d'une même activité
		$reqSelect ="SELECT * FROM tblplanning WHERE nomPlanning='".$nomPlanning."' AND idActivite='".$idActivite."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur de l'activité sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomPlanning']))
			{
				// ajout de l'activité
				$req = $db->prepare('INSERT INTO tblplanning (idActivite,dateCreation, nomPlanning,descriptPlanning)
					VALUES (:idActivite,:dateCreation,:nomPlanning,:descriptPlanning)');
				$req->execute(array(
				'idActivite'=>$idActivite,
				'dateCreation'=>$dateCreation,
				'nomPlanning' => $nomPlanning,
				'descriptPlanning' => $descriptPlanning,
				));
			$_SESSION['modif']="Le planning a bien été ajouté";
			return true;
			}
		else
		{  
			throw new Exception("<p>Le planning ne peut pas être ajoutée car il existe déjà.</p>");
			/*<p><a href='index.php?action=vue_planning_gestion'> 
			<button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des plannings</strong></button> </a> </p>*/
      //return false;    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
	require "vue/vue_planning_add.php";
    //require "vue/vue_erreur.php";
  }
  //Fin Source : module 151
 }
  // -----------------------------
// updPlanning($postArray,$idPlanning)
//Argument : les informations passées en POST et l'id du planning à modifier
// Fonction : Ajouter un planning
 function updPlanning($postArray,$idPlanning)
 {
	 $db=getBD();
	$NNomPlanning=$postArray ["fNNomPlanning"];
	$NDescriptPlanning=$postArray ["fNDescriptPlanning"];
	try
	{
		erreurXss1($NNomPlanning);
		$NDescriptPlanning=erreurText($NDescriptPlanning);
		champVide($NNomPlanning,"nom du planning");
		lengthChamp($NNomPlanning,"Nom du planning",32);
		//Début Source : module 151--le test de la partie doublon
		$reqSelect ="SELECT * FROM tblplanning WHERE nomPlanning='".$NNomPlanning."' AND idPlanning!='".$idPlanning."' AND idActivite='".$_SESSION['idActivite']."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du projet sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['idPlanning']))
			{
				// Modification du planning
					$req = $db->prepare("update tblplanning set nomPlanning=:nomPlanning,descriptPlanning=:descriptPlanning 
					WHERE idPlanning='".$idPlanning."' AND idActivite='".$_SESSION['idActivite']."';");
					$req->execute(array(
					'nomPlanning' => $NNomPlanning,
					'descriptPlanning' => $NDescriptPlanning,			
				));
			$_SESSION['modif']="Le planning a bien été mis à jour";
			return true;
			}
		else
		{  
			throw new Exception("<p>Le planning ne peut pas être modifié car le nom existe déjà.</p><a href='index.php?action=vue_planning_gestion'> 
			<button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des planningx</strong></button> </a> </p>");
      //return false;    
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur_upd.php";
	}
 }
  // -----------------------------
// delPlanning($idPlanning)
// Fonction : Permet de supprimer un planning
//Argument : L'id du planning à supprimer
 function delPlanning($idPlanning)
 {	
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tblligneplanning WHERE idPlanning ="'.$idPlanning.'";';
		$db->exec($requete);
		$requete = 'DELETE FROM tblplanning WHERE idPlanning ="'.$idPlanning.'" AND idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
	}
	
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
				$_SESSION['erreur']=$e->getMessage();
		}
 }
  // -----------------------------
// infoLignePlanning($idLignePlanning)
//Argument : L'id de la ligne du planning
// Fonction : Récupérer les informations d'une ligne de planning donné
//Sortie lignePlanning : contient les informations sur la ligne
 function infoLignePlanning($idLignePlanning) 
{
	try
	{
		$db = getBD();
		// Création de la string pour la requête
		$requete = "SELECT * FROM tblligneplanning where idLignePlanning='".$idLignePlanning."' AND idPlanning='".$_SESSION['idPlanning']."';";
		// Exécution de la requete
		$resultats = $db->query($requete);
		$lignePlanning=$resultats->fetch();
		if (empty($lignePlanning['idLignePlanning']))
		{
			throw new Exception("<p>Cette ligne est inconnue ou vous n'avez pas les droits nécessaires pour la modifier. </p><p><a href='index.php?action=vue_planning_ligne'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion des plannings</button> </a> </p>");
		}
		else
		{
			return $lignePlanning;
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
 }
 // -----------------------------
// listeLignePlanning($idPlanning)
// Fonction : COntient la liste des lignes d'un planning
//Argument : L'id du planning
//Sortie $resultats
 function listeLignePlanning($idPlanning)
 {
	
		$db = getBD();
		// Création de la string pour la requête
		$requete = "SELECT * FROM tblligneplanning where idPlanning='".$idPlanning."';";
		// Exécution de la requete
		$resultats = $db->query($requete);
		return $resultats;
 }
 // -----------------------------
// ajoutLignePlanning($idPlanning,$postArray)
// Fonction :Ajouter une ligne au planning
//Argument : L'id du planning et les informations de la ligne passées en post
 function ajoutLignePlanning($idPlanning,$postArray)
 {
	 $db=getBD();
	 $horaire=$postArray['fHoraire'];
	$descriptLignePlanning=$postArray['fDescriptLignePlanning'];
	$terrain=$postArray['fTerrain'];
	$responsable=$postArray['fResponsable'];
	 try
		{
			erreurXss1($horaire);
			$descriptLignePlanning=erreurText($descriptLignePlanning);
			$terrain=erreurText($terrain);
			$responsable=erreurText($responsable);
			// ajout de la ligne
			$req = $db->prepare('INSERT INTO tblligneplanning (idPlanning,horaire,descriptLignePlanning,terrain,responsable)
					VALUES (:idPlanning,:horaire,:descriptLignePlanning,:terrain,:responsable)');
				$req->execute(array(
				'idPlanning'=>$idPlanning,
				'horaire' => $horaire,
				'descriptLignePlanning' => $descriptLignePlanning,
				'terrain' => $terrain,
				'responsable' => $responsable,
				));
			return true;
		/*else
		{  
			throw new Exception("Le journal ne peut pas être modifié car le nom du journal existe déjà");
      //return false;    
		}*/
	}
	catch (Exception $e)
	{
		$_SESSION['ligne']=1;
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur_ligne.php";
	}
 }
  // -----------------------------
// updLignePlanning($postArray,$idLignePlanning)
//Argument : les nouvelles données de la ligne passées en post, l'id de la ligne a modifier
// Fonction : Modifier les données d'une ligne du planning
 function updLignePlanning($postArray,$idLignePlanning)
 {
	 $db=getBD();
	$NHoraire=$postArray['fNHoraire'];
	$NDescriptLignePlanning=$postArray['fNDescriptLignePlanning'];
	$NTerrain=$postArray['fNTerrain'];
	$NResponsable=$postArray['fNResponsable'];
	$idPlanning=$_SESSION['idPlanning'];
	try
	{
		erreurXss1($NHoraire);
		$NDescriptLignePlanning=erreurText($NDescriptLignePlanning);
		$NTerrain=erreurText($NTerrain);
		$NResponsable=erreurText($NResponsable);
		// Modification de la ligne 
		$req = $db->prepare("update tblligneplanning set horaire=:horaire,descriptLignePlanning=:descriptLignePlanning,terrain=:terrain,responsable=:responsable 
				WHERE idPlanning='".$idPlanning."' AND idLignePlanning='".$idLignePlanning."';");
					$req->execute(array(
					'horaire' => $NHoraire,
					'descriptLignePlanning' => $NDescriptLignePlanning,
					'terrain' => $NTerrain,
					'responsable' => $NResponsable,			
				));
			$_SESSION['modif']="La ligne du planning a bien été mis à jour";
			return true;
			
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
 }
  // -----------------------------
// delLignePlanning($idLignePlanning)
// Fonction : Permet de supprimer une ligne du planning
//Argument : L'id de la ligne du planning à supprimer
 function delLignePlanning($idLignePlanning)
 {	
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tblligneplanning WHERE idLignePlanning ="'.$idLignePlanning.'" AND idPlanning="'.$_SESSION['idPlanning'].'";';
		$db->exec($requete);
	}
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
				$_SESSION['erreur']=$e->getMessage();
		}
 }
 
 ?>