<?php

// controleur.php
// Date de création : 03/05/2017
// Auteur : RSA
// Fonction : controleur
// _______________________________

require "modele/modele_BDD.php";
require "modele/modele_user.php";
require "modele/modele_autorisation.php";
require "modele/modele_activite.php";
require "modele/modele_materiel.php";
require "modele/modele_lieu.php";
require "modele/modele_planning.php";
require "modele/modele_participant.php";
require "modele/modele_document.php";
require "library/permission.php";
require "library/erreur.php";
require "library/session.php";

// Affichage de la page d'accueil
function accueil()
{
    $connexion = false;
    if (isset($_SESSION['login']) && isset($_POST['fNomAct'])) //Nom de l'activité séllectionnée
    {
        createSessionActivite($_POST['fNomAct']);
        createSessionRole($_SESSION["idUser"], $_SESSION["idActivite"]);
        require "vue/vue_accueil.php";
        $connexion = true;
        exit;
    }
    if (isset($_SESSION['login']) && isset($_SESSION['idActivite'])) {
        require "vue/vue_accueil.php";
        $connexion = true;
        exit;
    }
    if (isset($_SESSION['login'])) {
        afficherActivite();
        $connexion = true;
    }
    if ($connexion == false) {
        require "vue/vue_visiteur.php";
    }

}

// ------------ Autres ---------------------
function erreur($msg)
{
    $_SESSION['erreur'] = $msg;
    if (isset($_SESSION['login']) && isset($_SESSION['idActivite'])) {
        require "vue/vue_erreur_activite.php";
    } else {
        require "vue/vue_erreur_visiteur.php";
    }
}









