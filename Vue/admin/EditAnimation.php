<?php
ob_start();
session_start();

include('../../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$form->isNotLogged();
$form->SessionDestroy();
$anim = $form->getAnimtionById($_GET['code']);
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
 <div id="wrap" style="margin-top:5%;" >
		<section class="af-wrapper">
	            <h3>Editer l'animations.</h3>
				<hr>
				
				<form class="form-signin" role="form" method="post" >
				<input class="field-input" id="code_animation" value="<?php echo $_GET['code']; ?>" type="text" name="code_animation" hidden >

					
					<div class="field">
						<label for="designation" class="fields-label">Designation</label>
						<input class="field-input" id="designation" value="<?php if(isset($_POST['update'])): echo $_POST['designation']; else: echo $anim->DESIGNATIONANIM; endif; ?>" type="text" name="designation" required>
					</div>
					
					
						<label for="description" class="fields-label">Description</label>
					<textarea class="field-input" name="description" id="description" style=" border-radius: 0;border: solid 1px #4BA6A3;margin: 0px 0px 10px;max-width:338px; max-height:60px; width: 338px; height: 60px;" required><?php if(isset($_POST['update'])): echo $_POST['description']; else: echo $anim->DESCRIPTANIM; endif; ?></textarea>
					
					<div class="field">
						<label for="commentaire" class="fields-label">Commentaire</label>
						<input class="field-input" id="commentaire" type="text" value="<?php if(isset($_POST['update'])): echo $_POST['commentaire']; else: echo $anim->COMMENTANIM; endif; ?>" name="commentaire" required>
					</div>
					
					<div class="field">
						<label for="duree" class="fields-label">Durée</label>
						<input type="text" class="field-input" value="<?php if(isset($_POST['update'])): echo $_POST['duree']; else: echo $anim->DUREEANIM; endif; ?>" id="duree" name="duree" required>
					</div>
					
					<div class="field">
						<label for="difficulte" class="fields-label">Difficulté</label>
						<select class="field-input" id="difficulte" value="<?php if(isset($_POST['update'])): echo $_POST['difficulte']; else: echo $anim->DIFFICULTEANIM; endif; ?>" name="difficulte" required><option>Bassse</option><option>Moyenne</option><option>Dur</option></select>
					</div>
					
					<div class="field">
						<label for="place" class="fields-label">Places</label>
						<input type="text" value="<?php if(isset($_POST['update'])): echo $_POST['place']; else: echo $anim->NBREPLACEANIM; endif; ?>" class="field-input" id="place" name="place" required>
					</div>
					<div class="field">
						<label for="heure" class="fields-label">Heure</label>
						<input type="time" value="<?php if(isset($_POST['update'])): echo $_POST['heure']; else: echo $anim->HRRDV; endif; ?>" class="field-input" id="heure" name="heure" required>
					</div>
					
					<div class="field">
						<label for="age" class="fields-label">Limite age</label>
						<input type="text" value="<?php if(isset($_POST['update'])): echo $_POST['age']; else: echo $anim->LIMITAGE; endif; ?>" class="field-input" id="age" name="age" required>
					</div>
 						<button type="submit" class="myButton" name="update" value="submit">Valider</button> <button type="button" onClick="window.close()" class="myButton" name="annuler" value="submit">Annuler</button>
					
				</form>
				<?php echo $form->updateAnimation(); ?>	
</section>
</div>
</body>
</html>