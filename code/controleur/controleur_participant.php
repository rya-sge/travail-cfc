<?php
//Fonctions liées aux participants
function gestionListePart()
{
    isConnected();
    $resultats = listePart();
    require "vue/vue_participant_gestion.php";
}

function afficherPart()
{
    isConnected();
    if (isset($_GET['qIdParticipant'])) {
        $infoPart = infoPart($_GET['qIdParticipant']);
        require "vue/vue_participant.php";
        exit();
    }
    //Récupère les données via le modèle
    require "vue/vue_participant_gestion.php";
}

function addPart()
{
    isConnected();
    if (isset($_POST['fAddPart'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
    {
        ajoutPart($_POST);
        @header("location: index.php?action=vue_participant_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_participant_add.php";

}

function updatePart()
{

    isConnected();
    $infoPart = infoPart($_GET['qIdParticipant']);//Récupérer les données de l'activité via le modèle
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de l'activité
    if (isset($_POST['fUpdPart2']) AND isset($_GET['qIdParticipant']))//Variable post existe si l'utilisateur a cliqué
        // sur le bouton modifer de son profil
    {
        updPart($_POST, $_GET['qIdParticipant']);
        @header("location: index.php?action=vue_participant&qIdParticipant=" . $_GET['qIdParticipant']);//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_participant_upd.php";
}

function deletePart()
{
    isConnected();
    if (isset($_GET['qIdParticipant'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer du participant
    {
        delPart($_GET['qIdParticipant']);
        @header("location: index.php?action=vue_participant_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_participant_gestion.php";
}

?>
