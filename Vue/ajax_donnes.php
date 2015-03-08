<?php
ini_set("display_errors", 1);
include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$code=$_GET['code_anim'];
$contenu=$form->getAnimtionById($code);
//$liendl='<br><br><a href="cheminvirtuel.txr" download="/'.$feuille.'" />t&eacutel&eacutecharger</a>';
//$liendl=str_replace('-','/',$liendl);
?>
					
					<div class="field">
						<label for="designation" class="fields-label">Designation</label>
						<input class="field-input" id="designation" value="<?php echo $contenu->DESIGNATIONANIM; ?>" type="text" name="designation" required>
					</div>
					
					
					<label for="description" class="fields-label">Description</label>
					<textarea class="field-input" name="description" id="description"  style=" border-radius: 0;border: solid 1px #4BA6A3;margin: 0px 0px 10px;max-width:338px; max-height:60px; width: 338px; height: 60px;" required><?php echo $contenu->DESCRIPTANIM; ?></textarea>
					
					<div class="field">
						<label for="commentaire" class="fields-label">Commentaire</label>
		<input class="field-input" id="commentaire" value="<?php echo $contenu->COMMENTANIM; ?>" type="text" name="commentaire">
					</div>
					
					<div class="field">
						<label for="duree" class="fields-label">Durée</label>
		<input type="text" class="field-input" value="<?php echo $contenu->DUREEANIM; ?>" id="duree" name="duree">
					</div>
					
					<div class="field">
						<label for="difficulte" class="fields-label">Difficulté</label>
						<input type="text" class="field-input" value="<?php echo $contenu->DIFFICULTEANIM; ?>" id="difficulte" name="difficulte">
					</div>
					
					<div class="field">
						<label for="place" class="fields-label">Places</label>
						<input type="text" value="<?php echo $contenu->NBREPLACEANIM; ?>" class="field-input" id="place" name="place" required>
					</div>
					<div class="field">
						<label for="heure" class="fields-label">Heure</label>
						<input type="time" value="<?php echo $contenu->HRRDV; ?>" class="field-input" id="heure" name="heure" required>
					</div>
					
					<div class="field">
						<label for="age" class="fields-label">Limite age</label>
						<input type="text" value="<?php echo $contenu->LIMITAGE; ?>" class="field-input" id="age" name="age" required>
					</div>