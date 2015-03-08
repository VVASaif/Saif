<?php
ob_start();
session_start();
include('vendor/autoload.php');
include('Outils/slidershow.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$form->isLoggedRedirect();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VVA</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap-responsive.min.css">
<script type="text/javascript" src="http://localhost/lastvva/css/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://localhost/lastvva/js/slidershow/jssor.js"></script>
<script type="text/javascript" src="http://localhost/lastvva/js/slidershow/jssor.slider.js"></script>
<script type="text/javascript" src="http://localhost/lastvva/js/slidershow/slide.js"></script>
<link href="http://localhost/lastvva/css/style.css" rel="stylesheet" type="text/css">
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
          <a class="brand" href="http://www.vva.url.ph/">VVA</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="http://www.vva.url.ph/">Accueil</a></li>
              <li><a href="http://www.vva.url.ph/Contact.php?vc=Riviere">Contact</a></li>
			  
			  <?php if(!empty($_SESSION['pseudo'])){ echo  '<li><a href="?destroy=destroy">Deconnexion</a></li>';} ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div id="wrap" >
<div class="center">
<section id="test" class="af-wrapper">
<form class="form-signin" role="form" method="post" action="index.php">
<h3 class="form-signin-heading">Connexion</h3>
<hr>
<div class="field">
<label for="pseudo" class="field-label">Pseudo</label>
<input type="text"  class="field-input" id="pseudo" name="pseudo">
</div>

<div class="field">
<label for="password" class="field-label">Password</label>
<input type="password"  class="field-input" id="password" name="password">
</div>
 <button type="submit" class="myButton" value="submit">Connect me</button>
</form>
</div>
</section>
  
<?php echo $form->Connect(); ?>


<script>
$(document).ready(function(){
	$('.field-input').focus(function(){
	$(this).parent().addClass('is-focused has-label');
	});
	
	$('.field-input').blur(function(){
		$parent = $(this).parent();
		if($(this).val() == ''){
			$parent.removeClass('has-label');
		}
		$parent.removeClass('is-focused');
	});
});
</script>
</div>
<?php require_once('Outils/footer.php');
ob_end_flush();
?>
