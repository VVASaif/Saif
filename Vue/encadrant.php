<?php
ob_start();
session_start();

include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
$form = new Helper();
$form->isNotLogged();
$form->SessionDestroy();

 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VVA | Encadrant</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap-responsive.min.css">
<script type="text/javascript" src="http://localhost/lastvva/css/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/lastvva/css/style.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/lastvva/css/form/style.css" />

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="http://localhost/lastvva/">VVA</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="http://localhost/lastvva/">Accueil</a></li>
              <li><a href="http://www.vva.url.ph/Contact.php?vc=Riviere">Contact</a></li>
			  <?php if(!empty($_SESSION['pseudo'])){ echo  '<li><a href="?destroy=destroy">Deconnexion</a></li>';} ?>
			  
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<?php if(isset($_SESSION['activer']) && !empty($_SESSION['activer']))
	{
		echo $_SESSION['activer'];
	} 
	if(isset($_SESSION['desactiver']) && !empty($_SESSION['desactiver']))
	{
		echo $_SESSION['desactiver'];
	} 
	if(isset($_GET['value']) && !empty($_GET['value']))
	{
		$form->sessionDestroys($_GET['value']);
	}?>
    <div id="wrap" style="margin-top:5%;" >
<div class="center">

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Ajouter une activité</a></li>
    <li><a href="#tab2" data-toggle="tab">Ajouter une animation</a></li>
    <li><a href="#tab3" data-toggle="tab">Consulter une animation</a></li>
    <li><a href="#tab4" data-toggle="tab">Annuler une activitée</a></li>
    <li><a href="#tab5" data-toggle="tab">Liste des inscrits</a></li>
  </ul>
  
  
  <div class="tab-content">
  
    <div class="tab-pane active" id="tab1">
		<?php require 'encadrant/add_activite.php'; ?>
		
    </div>

    <div class="tab-pane" id="tab2">
		<?php require 'encadrant/add_animation.php'; ?>
  	</div>
  
  	<div class="tab-pane" id="tab3">
		<?php require 'encadrant/list_animations.php'; ?>
	</div>

    <div class="tab-pane" id="tab4">
	<style>
	a
	{
	cursor: pointer;
	}
	</style>
		<?php require 'encadrant/status_activite.php'; ?>
    </div>
	
     <div class="tab-pane" id="tab5"><br />
       <?php require 'encadrant/list_inscrits.php'; ?>
    </div>
	
  </div>
  
</div>
</div>
</div>
</body>
</html>


<?php require_once('../Outils/footer.php');

ob_end_flush(); ?>
