<!--
// gabarit_visiteur.php
// Date de création : 02/05/17
// Auteur : RSA
// Fonction : gabarit pour les visiteurs et ceux n'ayant pas choisi d'activités
// _______________________________
 -->
<!--
Source :
Pour ce gabarit, la mise en page, ainsi que la parti du css est repris du module 151 donné par M.Benzonana Pascal
 -->
<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 		
		<link href="contenu/scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
		<link href="contenu/styles/custom.css" rel="stylesheet" type="text/css">
		<script type="text/javascript"></script>
	</head>
	<body id="pageBody">

<div id="divBoxed" class="container">

    <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

    <div class="divPanel notop nobottom">
            <div class="row-fluid">
                <div class="span12">
					<!-- Cours I-151  / CPNV-->
                </div>
            </div>

            <div class="row-fluid">
            <div class="span12">

                <div id="headerSeparator"></div>
                
                <div id="headerSeparator2"></div>

            </div>
        </div>
    </div>

    <div class="contentArea">
	
        <div class="divPanel notop page-content">
            
           <div class="row-fluid">
            <!--Edit Main Content Area here-->
              <div class="span12" id="divMain">
                <?=$contenu ?>
         	    </div>
            <!--End Main Content-->
            </div>

            <div id="footerInnerSeparator"></div>
			
       </div>
    </div>
    <div id="footerOuterSeparator"></div>
</div>
<br /><br /><br />
<script src="contenu/scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
