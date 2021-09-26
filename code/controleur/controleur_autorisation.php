<?php
// ------------ Autorisation ---------------------
function gestionAutori()
{
    isConnected();
    $resultats = listeAutori();
    require "vue/vue_autorisation_gestion.php";
}

function updateAutori()
{

    isConnected();
    $infoAutori = infoAutori($_GET['qIdUser']);//Ràcupère les données de l'activité via le modèle
    //Pour emp�cher de modifier les droits du superadmin via l'id de l'utilisateur
    if (($infoAutori['nomRole'] == "Super-admin" || $infoAutori['nomRole'] == "Admin") AND testR1() == false) {
        @header("location: index.php?action=vue_autorisation_gestion");//redirection ves la page de confirmation de modification
        exit();
    }
    $listeRoles = listeRole();
    $listeRolesA = listeRoleA();
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de l'activité
    if (isset($_POST['fUpdAutori2'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        updAutori($_POST);
        @header("location: index.php?action=vue_autorisation_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_autorisation_upd.php";
}

function addAutori()
{
    isConnected();
    $listeRoles = listeRole();
    $listeRolesA = listeRoleA();
    if (isset($_POST['fAddAutori'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        ajoutAutori($_POST);
        @header("location: index.php?action=vue_autorisation_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_autorisation_add.php";

}

function deleteAutori()
{
    isConnected();
    if (isset($_GET['qIdUser'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        delAutori($_GET['qIdUser']);//suppression du planning
        @header("location: index.php?action=vue_autorisation_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_autorisation_gestion.php";
}

?>
