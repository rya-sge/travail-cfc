<?php
session_set_cookie_params(10000); // durée de vie de session à 20 min si > destruction automatique
session_start();

// index.php
// Date de création : 02/05/17
// Auteur : RSA
// Fonction : page d'accueil
// _______________________________

require  'controleur/controleur.php';
require  'controleur/controleur_activite.php';
require  'controleur/controleur_lieu.php';
require  'controleur/controleur_planning.php';
require  'controleur/controleur_materiel.php';
require  'controleur/controleur_user.php';
require  'controleur/controleur_autorisation.php';
require  'controleur/controleur_participant.php';
require  'controleur/controleur_document.php';

try
{
  if (isset($_GET['action']))
  {
    $action = $_GET['action'];
    
    switch ($action)
    {
		case 'vue_accueil' :
			accueil();
			break;
		case 'vue_login' :
			login();
			break;
		case 'vue_logout':
			logout();
			break;
		case 'vue_inscription':
			addUser();
			break;
		case 'vue_validation2':
			validateUser();
			break;
		case 'vue_passwd_reset':
			forgetPasswd();
			break;
		case 'vue_passwd_upd':
			updatePasswd();
			break;
		////
		case 'vue_activite_gestion':
			activiteGestion();
			break;
		case 'vue_activite_add':
			addActivite();
			break;
		case 'vue_activite':
			if (testR2()==true)
			{
				afficherActivite();
				break;
			}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_activite_upd':
			if (testR2()==true)
				{
					updateActivite();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_activite_del':
			if (testR1()==true)
				{
					deleteActivite();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		///
		case 'vue_profil':
			if (testConnected()==true)
			{
				profil();
				break;
			}
		case 'vue_profil_login_upd':
			if (testConnected()==true)
				{
					updateLogin();
					break;
				}
		case 'vue_profil_email_upd':
			if (testConnected()==true)
				{
					updateEmail();
					break;
				}
		case 'vue_profil_passwd_modif':
			if (testConnected()==true)
				{
					modifPasswd();
					break;
				}
		case 'vue_validation_email':
			validateEmail();
			break;
		case 'vue_profil_del':
			if (testConnected()==true)
				{
					deleteUser();
					break;
				}
		////
		case 'vue_autorisation_gestion':
			if (testR2()==true)
				{
					gestionAutori();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_autorisation_upd':
			if (testR2()==true)
				{
					updateAutori();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_autorisation_add':
			if (testR2()==true)
				{
					addAutori();
					break;
				}
				
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_autorisation_del':
			if (testR2()==true)
				{
					deleteAutori();
					break;
				}
				
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		///////
		case 'vue_planning_gestion':
			gestionPlanning();
			break;
			
		case 'vue_planning_add':
			if (testR3()==true)
			{
				addPlanning();
				break;
			}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_planning_upd':
			if (testR3()==true)
				{
					updatePlanning();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_planning_del':
			if (testR3()==true)
				{
					deletePlanning();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_planning_ligne':
			addLignePlanning();
			break;
		case 'vue_planning_ligne_upd':
			updateLignePlanning();
			break;
		case 'vue_planning_ligne_del':
			deleteLignePlanning();
			break;
		///////
		case 'vue_lieu_gestion':
			lieuGestion();
			break;
		case 'vue_lieu':
			afficherLieu();
			break;
		case 'vue_lieu_upd':
			updateLieu();
			break;
		case 'vue_lieu_add':
			if (testR3()==true)
				{
					addLieu();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_lieu_del':
			if (testR3()==true)
			{
				deleteLieu();
				break;
			}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		///////
		
		case 'vue_materiel_gestion':
			if (testR3()==true)
			{
				gestionListeMat();
				break;
			}
		case 'vue_materiel_add':
			if (testR3()==true)
			{
				addListeMat();
				break;
			}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_materiel_upd':
				updateListeMat();
				break;
		case 'vue_materiel_del':
			if (testR3()==true)
				{
					deleteListeMat();
					break;
				}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_materiel_ligne':
			addLigneMat();
			break;
		case 'vue_materiel_ligne_upd':
			updateLigneMat();
			break;
		case 'vue_materiel_ligne_del':
			deleteLigneMat();
			break;
		///////
		case 'vue_participant_gestion':
			gestionListePart();
			break;
		case 'vue_participant_add':
			if (testR3()==true)
			{
				addPart();
				break;
			}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_participant_del':
			if (testR3()==true)
			{
				deletePart();
				break;
			}
			else
			{
				throw new Exception("Vous n'avez pas accès à cette page");
			}
		case 'vue_participant':
			afficherPart();
			break;
		case 'vue_participant_upd':
			updatePart();
			break;
		///////
		case 'vue_document_gestion':
			gestionDoc();
			break;
		case 'vue_document_add':
				addDoc();
				break;
		case 'vue_document_del':
			if (testR3()==true)
			{
				deleteDoc();
				break;
			}
		case 'vue_document_upd':
			updateDoc();
			break;
		case 'vue_document_open':
			openDoc();
			break;
     default :
        throw new Exception("L'action demandée est inconnue !");
    }   
  }
  else
    accueil();
  
}
catch (Exception $e)
{
  erreur($e->getMessage());
}