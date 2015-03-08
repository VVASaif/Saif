<section class="af-wrapper">
	            <h3>Ajouter une activité.</h3>
				<hr>
				<form class="form-signin" role="form" method="post" >
					<div class="field">
						<label for="animation" class="fields-label">Animation</label>
						
						<select class="field-input" id="animation" name="animation" required><?php echo $form->getAnimation(); ?></select>
						
					</div>
					<div class="field">
						<label for="date" class="fields-label">Date</label>
						<input type="date"  class="field-input" id="date" name="date" required>
					</div>
						<input type="hidden" class="field-input" value="<?php echo $form->getNom(); ?>" id="encadrant" name="encadrant">
 						<button type="submit" class="myButton" name="submit" value="submit">Valider</button>
					
				</form>
				
				<?php $form->setActivite(); ?>
			
				</section>
				
				