<?php 
//Fonctions liés au matériel
// getIdListeMat($nomListeMat)
//Argument : le nom de la liste de matériel
// Fonction : Récupérer l'id de la liste de matériel à partir de son nom
//Sortie $idListeMateriel['idListeMateriel']. C'est l'id de la liste de matériel passé en paramètre
function getIdListeMat($nomListeMat)
{
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT idListeMateriel FROM tbllistemateriel WHERE nomListeMat='".$nomListeMat."' AND idActivite='".$_SESSION["idActivite"]."';";
	// Exécution de la requete
	$res = $db->query($requete);
	$idListeMateriel = $res->fetch();
	return $idListeMateriel['idListeMateriel'];
}
// -----------------------------
// listeMat()
// Fonction : Récupérer l'ensemble des listes de matériel d'une activités
//Sortie $listeMat. Contient les listes de l'activité
function listeMat()
 {
	 $db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tbllistemateriel where idActivite='".$_SESSION["idActivite"]."' order by nomListeMat;";
	// Exécution de la requete
	$listeMat = $db->query($requete);
	return $listeMat;
 }
  // -----------------------------
// infoListeMat()
//Argument : l'id de la liste de matériel
// Fonction : Récupérer les informations d'une liste de matériel donné
//Sortie $materiel. Contient les informations de la liste
 function infoListeMat($idListeMateriel) 
{
	erreurUrl($idListeMateriel);
	$db = getBD();
	// Création de la string pour la requête
	$requete = "SELECT * FROM tbllistemateriel where idListeMateriel='".$idListeMateriel."';";
	// Exécution de la requete
	$resultats = $db->query($requete);
	$materiel=$resultats->fetch();
	return $materiel;
 }
  function ajoutListeMat($postArray)
{
	$db=getBD();
	try
	{	
		//Récupération des données passées en post
		$nomListeMat=$postArray ["fNomListeMat"];
		$descriptListeMat=$postArray ["fDescriptListeMat"];
		$dateCreation=date('Y-m-d H:i:s'); //Src : http://www.pontikis.net/tip/?id=18
		$idActivite=$_SESSION['idActivite'];
		
		$descriptListeMat=erreurText($descriptListeMat);
		erreurXss1($nomListeMat);
		champVide($nomListeMat,"Nom de la liste");
		lengthChamp($nomListeMat,"Nom de la liste",32);
		
		//Début Source : module 151--le test de la partie doublon
		// test si le nom de l'activité existe déjà pour éviter les doublons sur des activités
		$reqSelect ="SELECT * FROM tbllistemateriel WHERE nomListeMat='".$nomListeMat."' AND idActivite='".$idActivite."';";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur de l'activité sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomListeMat']))
			{
				// ajout de l'activité
				$req = $db->prepare('INSERT INTO tbllistemateriel (idActivite,dateCreation, nomListeMat,descriptListeMat)
					VALUES (:idActivite,:dateCreation,:nomListeMat, :descriptListeMat)');
				$req->execute(array(
				'idActivite'=>$idActivite,
				'dateCreation'=>$dateCreation,
				'nomListeMat' => $nomListeMat,
				'descriptListeMat' => $descriptListeMat,
				));
			$_SESSION['modif']="La liste a bien été ajoutée";
			return true;
			}
		else
		{  
			throw new Exception("La liste ne peut pas être ajoutée car elle existe déjà.");
      //return false;    
		}
  }
  catch (Exception $e)
  {
    $_SESSION['erreur']=$e->getMessage();
	//require "vue/vue_erreur.php";
    require "vue/vue_materiel_add.php";
  }
  //Fin Source : module 151
 } 
   // -----------------------------
// updActivite($postArray)
// Fonction : Mettre à jour la liste de matériel  
//Argument : les informations sur la liste passées en POST
 function updListeMat($postArray,$idListeMateriel)
 {
	$db=getBD();
	$NNomListeMat=$postArray ["fNNomListeMat"];
	$NDescriptListeMat=$postArray ["fNDescriptListeMat"];
	try
	{
		champVide($NNomListeMat,"Nom de la liste");
		erreurXss1($NNomListeMat);
		$NDescriptListeMat=erreurText($NDescriptListeMat);
		lengthChamp($NDescriptListeMat,"Nom de la liste",32);
		
		$reqSelect ="SELECT * FROM tbllistemateriel WHERE nomListeMat='".$NNomListeMat."' AND idListeMateriel!='".$idListeMateriel."' AND idActivite='".$_SESSION['idActivite']."' ;";
		$res=$db->query($reqSelect);
		$ligne = $res->fetch(); // récupère la valeur du projet sélectionné s'il y en a un  
		// Test le résultat
		if (empty($ligne['nomListeMat']))
			{
				// Modification de l'activité
				$req = $db->prepare("update tbllistemateriel set nomListeMat=:nomListeMat,descriptListeMat=:descriptListeMat 
				WHERE idListeMateriel='".$idListeMateriel."' AND idActivite='".$_SESSION['idActivite']."';");
				$req->execute(array(
				'nomListeMat' => $NNomListeMat,
				'descriptListeMat' => $NDescriptListeMat,
				));
			$_SESSION['modif']="La liste de matériel a bien été mis à jour";
			return true;
			}
		else
		{  
			throw new Exception("<p>La liste de matériel ne peut pas être modifié car le nom existe déjà.</p><a href='index.php?action=vue_materiel_gestion'> 
			<button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des listes</strong></button> </a> </p>");
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
// listeLigneMat($idListeMateriel)
// Fonction : COntient la liste de matériel
//Argument : L'id du journal
//Sortie $resultats
 function listeLigneMat($idListeMateriel)
 {
	
		$db = getBD();
		// Création de la string pour la requête
		$requete = "SELECT * FROM tbllignemateriel where idListeMateriel='".$idListeMateriel."';";
		// Exécution de la requete
		$resultats = $db->query($requete);
		return $resultats;
 }
  // -----------------------------
// infoLigneMat($idLigneMateriel)
//Argument : L'id de la ligne du matériel
// Fonction : Récupérer les informations d'une ligne de matériel donné
//Sortie ligneMateriel : contient les informations sur la ligne
 function infoLigneMat($idLigneMateriel) 
{
	try
	{
		
		$db = getBD();
		// Création de la string pour la requête
		$requete = "SELECT * FROM tbllignemateriel where idLigneMateriel='".$idLigneMateriel."' AND idListeMateriel='".$_SESSION['idListeMateriel']."';";
		// Exécution de la requete
		$resultats = $db->query($requete);
		$ligneMat=$resultats->fetch();
		if (empty($ligneMat['idLigneMateriel']))
		{
			throw new Exception("<p>Cette ligne est inconnue ou vous n'avez pas les droits nécessaires pour la modifier. </p><p><a href='index.php?action=vue_materiel_ligne'> 
					<button type='button' class='btn btn-primary'  >Revenir à la gestion de matériel</button> </a> </p>");
		}
		else
		{
			return $ligneMat;
		}
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		require "vue/vue_erreur.php";
	}
 }
 // -----------------------------
// ajoutLigneMat($idMateriel,$postArray)
// Fonction :Ajouter une ligne à une liste de matériel
//Argument : L'id de la liste de matériel et les informations de la ligne passées en post
 function ajoutLigneMat($idListeMateriel,$postArray)
 {
	 $db=getBD();
	 $nomMat=$postArray['fNomMat'];
	$descriptMat=$postArray['fDescriptMat'];
	$quantite=$postArray['fQuantite'];
	$responsable=$postArray['fResponsable'];
	 try
		{
			erreurXss1($nomMat);
			erreurXss1($quantite);
			$responsable=erreurText($responsable);
			$descriptMat=erreurText($descriptMat);
			champVide($nomMat,"Nom");
			lengthChamp($nomMat,"Nom",32);
			// ajout de la ligne
			$req = $db->prepare('INSERT INTO tbllignemateriel (idListeMateriel,nomMat,descriptMat,quantite,responsable)
					VALUES (:idListeMateriel,:nomMat,:descriptMat,:quantite,:responsable)');
				$req->execute(array(
				'idListeMateriel'=>$idListeMateriel,
				'nomMat' => $nomMat,
				'descriptMat' => $descriptMat,
				'quantite' => $quantite,
				'responsable' => $responsable,
				));
			return true;
	}
	catch (Exception $e)
	{
		$_SESSION['ligne']=1;
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur.php";
	}
 }
   // -----------------------------
// updLigneMat($postArray,$idLigneMateriel)
//Argument : les nouvelles données de la ligne passées en post, l'id de la ligne a modifier
// Fonction : Modifier les données d'une ligne de la liste de matériel
 function updLigneMat($idLigneMateriel,$postArray)
 {
	 $db=getBD();
	$NNomMat=$postArray['fNNomMat'];
	$NDescriptMat=$postArray['fNDescriptMat'];
	$NQuantite=$postArray['fNQuantite'];
	$NResponsable=$postArray['fNResponsable'];
	$idListeMateriel=$_SESSION['idListeMateriel'];
	try
	{
		erreurXss1($NNomMat);
		erreurXss1($NQuantite);
		$NDescriptMat=erreurText($NDescriptMat);
		$NResponsable=erreurText($NResponsable);
		champVide($NNomMat,"Nom");
		lengthChamp($NNomMat,"Nom",32);
		// Modification de la ligne 
		$req = $db->prepare("update tbllignemateriel set nomMat=:nomMat,descriptMat=:descriptMat,quantite=:quantite,responsable=:responsable 
				WHERE idListeMateriel='".$idListeMateriel."' AND idLigneMateriel='".$idLigneMateriel."';");
					$req->execute(array(
					'nomMat' => $NNomMat,
					'descriptMat' => $NDescriptMat,
					'quantite' => $NQuantite,
					'responsable' => $NResponsable,			
				));
			$_SESSION['modif']="La ligne du matériel a bien été mis à jour";
			return true;
			
	}
	catch (Exception $e)
	{
		$_SESSION['erreur']=$e->getMessage();
		//require "vue/vue_erreur.php";
	}
 }
  // -----------------------------
// delLigneMat($idLigneMat)
// Fonction : Permet de supprimer une ligne de la liste de matériel
//Argument : L'id de la ligne de matériel à supprimer
 function delLigneMat($idLigneMateriel)
 {	
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tbllignemateriel WHERE idLigneMateriel ="'.$idLigneMateriel.'" AND idListeMateriel="'.$_SESSION['idListeMateriel'].'";';
		$db->exec($requete);
	}
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
				$_SESSION['erreur']=$e->getMessage();
		}
 }
  // -----------------------------
// delListeMat(($idListeMateriel)
// Fonction : Permet de supprimer un planning
//Argument : L'id du planning à supprimer
 function delListeMat($idListeMateriel)
 {	
	try
	{
		$db=getBD();
		$requete = 'DELETE FROM tbllignemateriel WHERE idListeMateriel ="'.$idListeMateriel.'";';
		$db->exec($requete);
		$requete = 'DELETE FROM tbllistemateriel WHERE idListeMateriel ="'.$idListeMateriel.'" AND idActivite="'.$_SESSION["idActivite"].'";';
		$db->exec($requete);
	}
	
	 catch (Exception $e)
		{
				trigger_error($e->getMessage(), E_USER_ERROR);
				$_SESSION['erreur']=$e->getMessage();
		}
 }
 ?>