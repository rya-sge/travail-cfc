<?php
// ------------ Users --------------------- 
// -----------------------------
//Fonctions liées aux utilisateurs
function login()
{

    // Récupération des variables POST
    if (isset($_POST['fLogin'])) {
        //$postArray=&$_POST; Inutile car pas utilisé
        if (isset($_POST['fLogin'])) {
            $infoUser = checkLogin($_POST);//APpel de la fonction qui vérifie le login
            if ($infoUser != false) {
                //Initialise les variables de session nécessaires pour  être identifié sur le site avec son compte

                $_SESSION["isConnected"] = true;
                $_SESSION["idUser"] = $infoUser['idUser'];
                $_SESSION['login'] = $infoUser['login'];
                $_SESSION['email'] = $infoUser['email'];
                $_SESSION['error'] = "";
                @header("location: index.php?action=vue_activite_gestion");
                //Redirection vers  vue_activite_gestion (affiche liste des activités de l'utilisateur
                exit();
            }
        }
    } else {
        if (isset($_SESSION['login'])) {
            $resultats = isConnected();//Renvoie true si l'utilsateur est connecté
            if ($resultats) {
                require "vue/vue_accueil.php"; //affiche la vue accueil si l'utilisateur est co

            }
        } else //Si l'utilisateur n'est pas connecté
        {
            require "vue/vue_login.php";
        }
    }
}

// -----------------------------
//Supprime les variables de session de l'utilisateur
function logout()
{

    if (isset($_SESSION['idUser'])) {
        session_destroy();
        @header("location: index.php?action=vue_logout");
    } else {
        require "vue/vue_logout.php";
    }
}

// -----------------------------
//Pour ajouter un utilisateur au site
function addUser()
{
    if (isset($_POST['fLogin'])) {
        ajoutUser($_POST); // Renvoie les contenus des POST
    } else {
        require "vue/vue_inscription.php";
    }
}

function validateUser()
{
    validerUser();
}

//Pour accéder à la page permettant de recevoir le lien de réintialisation de mot de passe
function forgetPasswd()
{
    $postArray =& $_POST;
    if (isset($postArray['fForgetPasswd'])) {
        oubliPasswd($postArray);
    } else {
        require "vue/vue_passwd_reset.php";
    }
}

//Initialiser un nouveau mot de passe
function updatePasswd()
{
    $postArray =& $_POST;
    if (isset($postArray['fUpdPasswd'])) {
        $email = $_GET['qLog'];
        $cle = $_GET['qCle'];
        updPasswd($postArray, $cle, $email);//Créer le nouveau mot de passe
    } //d�termine si l'utilisateur peut accéder à la page de réintialisation de mot de passe
    else {
        $email = urldecode($_GET['qLog']);
        $cle = urldecode($_GET['qCle']);
        $verif = verifCle($cle, $email);
        if ($verif != false) {
            require "vue/vue_passwd_upd.php";
        }
    }
}

// -----------------------------
//Pour afficher le profil de l'utilisateur ou modifier
function profil()
{
    if (isset($_SESSION['idUser'])) {
        $infoUser = infoUtilisateur();//Récupèr les données de l'utilisateur via le modèle
        if (isset($_POST['fNProfil'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
        {
            require "vue/vue_profil_upd.php"; //Affichge de la vue permettant de modifier son profil
        } else //Affiche le profil avec les données de l'utilisateur
        {
            require "vue/vue_profil.php";
        }
    } else {
        require "vue/vue_visiteur.php";
    }
}

// -----------------------------
//Pour mettre à jour/changer son adresse email
function updateEmail()
{
    $infoUser = infoUtilisateur();
    if (isset($_SESSION['idUser']) AND isset($_POST['fBMEmail'])) {
        $modif = changeEmail();
        if ($modif != true) {
            require "vue/vue_profil_email_upd.php";
            exit();
        }
    } else {
        require "vue/vue_profil_email_upd.php";
    }
}

function validateEmail()
{
    if (empty($_SESSION['login'])) {
        require "vue/vue_validation_email3.php";
    } else {
        $email = urldecode($_GET['email']);
        $cle = urldecode($_GET['cle']);
        validerEmail($email, $cle);
    }
}

// -----------------------------
//Pour mettre à jour/changer son login
function updateLogin()
{
    $infoUser = infoUtilisateur();
    if (isset($_SESSION['idUser']) AND isset($_POST['fBMLogin'])) {
        $modif = changeLogin();
        if ($modif == true) {
            @header("location: index.php?action=vue_profil");
            exit();
        }
        require "vue/vue_profil_login_upd.php";
    } else {
        require "vue/vue_profil_login_upd.php";
    }
}

// -----------------------------
//Pour mettre à jour/changer son mot de passe
function modifPasswd()
{
    $infoUser = infoUtilisateur();
    if (isset($_POST['fNPasswdPost'])) {
        $pwd = changePasswd($_POST);
        $_SESSION['erreur2'] = $pwd;
        if ($pwd == true) {
            @header("location: index.php?action=vue_profil");
            exit;
        } else {
            require "vue/vue_profil_passwd_modif.php";
        }
    } else {
        require "vue/vue_profil_passwd_modif.php";
    }
}

function updateProfil()
{
    $pwd = true;
    if (isset($_SESSION['idUser']) AND isset($_POST['fBMProfil'])) {

        if (isset($_POST['fNLogin'])) {
            if (isset($_POST['fNPasswdPost'])) {
                $pwd = changePasswd($_POST);
                $_SESSION['erreur2'] = $pwd;
            }
            if ($pwd == true) {
                $modif = changeProfil($_POST);
            }
        }
        //require "vue/vue_profil.php";
        if ($modif == true) {
            @header("location: index.php?action=vue_profil");
            exit;
        } else {
            @header("location: index.php?action=vue_profil_upd");
            exit;
            //require "vue/vue_erreur_visiteur2.php";
        }
    } else if (isset($_SESSION['idUser'])) {
        $infoUser = infoUtilisateur();
        require "vue/vue_profil_upd.php";
    } else {
        require "vue/vue_visiteur.php";
    }

}

function deleteUser()
{
    //Variable post existe si l'utilisateur a cliqué sur le bouton suppriner de son profil
    if (isset($_SESSION['idUser']) AND isset($_POST['delUser']))

    {
        delUser($_SESSION['idUser']);//suppression de l'utilisateur
        session_destroy();//Destruction des variables de sessions
        @header("location: index.php?action=vue_validation_del");//redirection ves la page de confirmation de modification
        exit;
    } else {
        require "vue/vue_profil_del.php";
    }

}

?>
