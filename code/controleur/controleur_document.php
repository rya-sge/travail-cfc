<?php
//Fonction liées au document
function gestionDoc()
{
    isConnected();
    $resultats = listeDoc();
    require "vue/vue_document_gestion.php";
}

function openDoc()
{
    isConnected();
    try {
        $filename = $_GET['qFilename'];
        $open = ouvrirDoc($filename);
        if ($open == true) {
            //Source : Le code suivant est tiré de ce site web : http://codes-sources.commentcamarche.net/faq/1089-integration-d-une-protection-htaccess-a-une-authentification-securisee-par-sessions-php-mysql
            $path = "contenu/documents/" . $_SESSION['idActivite'] . "/" . $filename;
            if (file_exists($path) && is_readable($path)) {
                $size = filesize($path);
                header('Content-Type: application/octet-stream');
                header('Content-Length: ' . $size);
                header('Content-Disposition: attachment; filename=' . $filename);
                header('Content-Transfer-Encoding: binary');
                // open the file in binary read-only mode
                // Envoie un message d'erreur si le fichier ne peut pas être ouvert
                $file = @ fopen($path, 'rb');
                if ($file) {
                    // stream the file and exit the script when complete
                    fpassthru($file);
                    exit;
                } else {
                    throw new Exception("<p>Le document n'existe pas.</p><a href='index.php?action=vue_document_gestion'> 
					<button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des document</strong></button> </a> </p>");
                }
            } else {
                throw new Exception("<p>Le document n'existe pas.</p><a href='index.php?action=vue_document_gestion'> 
				<button type='button' class='btn btn-primary'  ><strong>Revenir à la gestion des document</strong></button> </a> </p>");
            }

            //Fin de la source
            //@header("location: contenu/documents/".$_SESSION['idActivite']."/".$filename);
        }
    } catch (Exception $e) {
        $_SESSION['erreur'] = $e->getMessage();
        require "vue/vue_erreur.php";
    }
}

function addDoc()
{
    isConnected();
    if (isset($_POST['fAddDoc'])) //Variable post existe si l'utilisateur a cliqué sur le bouton Ajouter du document
    {
        ajoutDoc($_POST);
        @header("location: index.php?action=vue_document_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_document_add.php";

}

function updateDoc()
{

    isConnected();
    $infoDoc = infoDoc($_GET['qIdDocument']);//Récupère les données du document via le modèle
    //Variable post existe si l'utilisateur a cliqué sur le bouton modifer du document
    if (isset($_POST['fUpdDoc2']) AND isset($_GET['qIdDocument']))//Variable post existe si l'utilisateur a cliqué sur
        // le bouton modifer de son profil
    {
        $modif = updDoc($_POST, $_GET['qIdDocument']);
        if ($modif == true) {
            @header("location: index.php?action=vue_document_gestion");//redirection ves la page de confirmation de modification
            exit;
        } else {
            @header("location: index.php?action=vue_document_upd&qIdDocument=" . $_GET['qIdDocument']);
            exit;
        }
    }
    require "vue/vue_document_upd.php";
}

function deleteDoc()
{
    isConnected();
    if (isset($_GET['qIdDocument'])) //Variable post existe si l'utilisateur a cliqué sur le bouton modifer du document
    {
        delDoc($_GET['qIdDocument']);
        @header("location: index.php?action=vue_document_gestion");//redirection ves la page de confirmation de modification
        exit;
    }
    require "vue/vue_document_gestion.php";
}

?>
