<!DOCTYPE html>
<?php 

// gabarit.php
// Auteur : RSA
// Fonction :Page comprenant le design html/css de base du site pour les visiteurs
// _______________________________

?>
<!--
Source :
Pour ce gabarit, la mise en page, ainsi que le css (Hormis le menu vertical) est repris du module  I-151  / CPNV
 -->
<html lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<link href="contenu/scripts/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="contenu/scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
		<link href="contenu/styles/custom.css" rel="stylesheet" >
		<style>
		
		/*
		Code non terminé du header*/
		#header
		{
			top:0px;
			width : auto;
			background-color: black;
			display: block;
			height :35px;
			margin-left:300px;
		} 
		/* Source : Ce code css est entièrement repris d'un snippet bootstrap :
		http://bootsnipp.com/snippets/featured/responsive-navigation-menu
		Il n'est pas dans un fichier css à part car il ne serait pas pris en compte (bug).
		Probablement un problème d'écrasement avec le code de bootstrap
		*/
			.nav-side-menu 
			{
			  overflow: auto;
			  font-family: verdana;
			  font-size: 12px;
			  font-weight: 200;
			  background-color: #2e353d;
			  position: fixed;
			  top: 0px;
			  width: 300px;
			  height: 100%;
			  color: #e1ffff;
			}
			.nav-side-menu .brand {
			  background-color: #23282e;
			  line-height: 50px;
			  display: block;
			  text-align: center;
			  font-size: 14px;
			}
			.nav-side-menu .toggle-btn {
			  display: none;
			}
			.nav-side-menu ul,
			.nav-side-menu li {
			  list-style: none;
			  padding: 0px;
			  margin: 0px;
			  line-height: 35px;
			  cursor: pointer;
  /*    
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
			}
			.nav-side-menu ul :not(collapsed) .arrow:before,
			.nav-side-menu li :not(collapsed) .arrow:before {
			  font-family: FontAwesome;
			  content: "\f078";
			  display: inline-block;
			  padding-left: 10px;
			  padding-right: 10px;
			  vertical-align: middle;
			  float: right;
			}
			.nav-side-menu ul .active,
			.nav-side-menu li .active {
			  border-left: 3px solid #d19b3d;
			  background-color: #4f5b69;
			}
			.nav-side-menu ul .sub-menu li.active,
			.nav-side-menu li .sub-menu li.active {
			  color: #d19b3d;
			}
			.nav-side-menu ul .sub-menu li.active a,
			.nav-side-menu li .sub-menu li.active a {
			  color: #d19b3d;
			}
			.nav-side-menu ul .sub-menu li,
			.nav-side-menu li .sub-menu li {
			  background-color: #181c20;
			  border: none;
			  line-height: 28px;
			  border-bottom: 1px solid #23282e;
			  margin-left: 0px;
			}
			.nav-side-menu ul .sub-menu li:hover,
			.nav-side-menu li .sub-menu li:hover {
			  background-color: #020203;
			}
			.nav-side-menu ul .sub-menu li:before,
			.nav-side-menu li .sub-menu li:before {
			  font-family: FontAwesome;
			  content: "\f105";
			  display: inline-block;
			  padding-left: 10px;
			  padding-right: 10px;
			  vertical-align: middle;
			}
			.nav-side-menu li {
			  padding-left: 0px;
			  border-left: 3px solid #2e353d;
			  border-bottom: 1px solid #23282e;
			}
			.nav-side-menu li a {
			  text-decoration: none;
			  color: #e1ffff;
			}
			.nav-side-menu li a i {
			  padding-left: 10px;
			  width: 20px;
			  padding-right: 20px;
			}
			.nav-side-menu li:hover {
			  border-left: 3px solid #d19b3d;
			  background-color: #4f5b69;
			  -webkit-transition: all 1s ease;
			  -moz-transition: all 1s ease;
			  -o-transition: all 1s ease;
			  -ms-transition: all 1s ease;
			  transition: all 1s ease;
			}
			@media (max-width: 767px) {
				
			  .nav-side-menu {
				position: relative;
				width: 100%;
				margin-bottom: 10px;
			  }
			  .nav-side-menu .toggle-btn {
				display: block;
				cursor: pointer;
				position: absolute;
				right: 10px;
				top: 10px;
				z-index: 10 !important;
				padding: 3px;
				background-color: #ffffff;
				color: #000;
				width: 40px;
				text-align: center;
			  }
			  .brand {
				text-align: left !important;
				font-size: 22px;
				padding-left: 20px;
				line-height: 50px !important;
			  }
			}
			@media (min-width: 767px) {
			  .nav-side-menu .menu-list .menu-content {
				display: block;
			  }
			}
			body {
			  margin: 0px;
			  padding: 0px;
			}
		</style>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript"></script>
		<!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!--<script src="https://use.fontawesome.com/11e927f157.js"></script>-->
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" >
<!--<div id="header"></div>-->

<div style="float:right">
					<!--Source : Cours I-151  / CPNV -->
					<?php if(!isset($_SESSION['login']))
					{
						echo '<a href="index.php?action=vue_login">Login </a>';	
													
					}
					else
					{
						echo "<a href='index.php?action=vue_activite_gestion'><button type='button' class='btn btn-primary btn-sm'  >Revenir à vos activités</button></a>";
						echo "<a href='index.php?action=vue_logout'><button type='button' class='btn btn-primary btn-sm'  >Déconnexion</button></a>";
						echo "<a href='index.php?action=vue_profil'><button type='button' class='btn btn-primary btn-sm'  >Profil</button></a>";					
					}
						?>     		
					
</div>
<div class="nav-side-menu">
    <div class="brand">
	<?php if(isset($_SESSION['nomAct']))
	{
		echo $_SESSION['nomAct']; 
	}
	?>
	</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a class="alone" href="index.php?action=vue_accueil" id="accueil">
                  <i class="fa fa-home fa-lg " ></i>Accueil 
                  </a>
                </li>
				<?php 
				if (testR2()==true)
				{ ?>
					<li  data-toggle="collapse" data-target="#administration" class="collapsed">
                  <a href="#"><i class="fa fa-dashboard  fa-lg"></i>Administration <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="administration">
                    <li class="active"><a href="index.php?action=vue_activite">Activite</a></li>
					 <li class="active"><a href="index.php?action=vue_autorisation_gestion">Autorisation</a></li>
                </ul>
				<?php }?>
				 <li>
                  <a  class="alone" href="index.php?action=vue_lieu_gestion">
				  <i class="fa fa-globe fa-lg"></i>Lieux</a>
                </li>  
                <li data-toggle="collapse" data-target="#planning" class="collapsed">
                  <a href="#"><i class="fa fa-calendar fa-lg"></i> Planning <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="planning">
				<?php if (testR3()==true)
				{
					?>
                  <li class="active"><a href="index.php?action=vue_planning_gestion">Gestion des plannings</a></li>
				<?php }?>
                  <li><a href="index.php?action=vue_planning_ligne">Horaire</a></li>
                </ul>
				
				<li data-toggle="collapse" data-target="#materiel" class="collapsed">
                  <a href="#"><i class="fa fa-gavel fa-lg"></i> Matériel <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="materiel">
				<?php if (testR3()==true)
				{
					?>
                  <li class="active"><a href="index.php?action=vue_materiel_gestion">Gérer les listes</a></li>
				<?php } ?>
                  <li><a href="index.php?action=vue_materiel_ligne">Ajouter du matériel</a></li>
                </ul>
				
                 <li>
                  <a  class="alone" href="index.php?action=vue_participant_gestion">
                  <i class="fa fa-user fa-lg"></i>Participants
                  </a>
                  </li>
				   <li >
                  <a class="alone" href="index.php?action=vue_document_gestion">
                  <i class="fa fa-file fa-lg "></i>Document
                  </a>
                  </li>
            </ul>
     </div>
</div>
 <div class="contentArea contenu">
	
        <div class="divPanel notop page-content">
            
           <div class="row-fluid">
            <!--Partie réservé au contenu (contient les vues)-->
              <div class="span12" id="divMain">
                <?php
				//Les lignes font réflérences aux lignes de matériel et de planning
				//ligne =0 il n'y a pas d'erreur
				//Ligne=1 : il y a une erreur qui doit être affichée
				//Ligne=3 : l'erreur a été affichée
				if(@$_SESSION['erreur']!="" AND @$_SESSION['ligne']!=1 AND @$_SESSION['ligne']!=3)
				{
					require "vue/vue_erreur_visiteur2.php";
					$_SESSION['erreur']="";	
					$_SESSION['ligne']=0;			
				}
				if(isset($_SESSION['ligne']) AND $_SESSION['ligne']==3)
				{
					$_SESSION['ligne']=0;//Indique qu'il n'y a plus d'erreurs
				}
				?>
				<?=$contenu ?>
         	    </div>
            <!--Fin du contenu des vues-->
            </div>

            <div id="footerInnerSeparator"></div>
			
       </div>
    </div>
	</body>
</html>
