<section class="af-wrapper">
	            <h3>Ajouter une animation.</h3>
				<hr>
				<form class="form-signin" role="form" method="post" >
					<div class="field">
						<label for="code_animation" class="fields-label">Code Animation</label>
						<input class="field-input" id="code_animation" type="text" name="code_animation" required>
					</div>
					
					<div class="field">
						<label for="designation" class="fields-label">Designation</label>
						<input class="field-input" id="designation" type="text" name="designation" required>
					</div>
					
					
						<label for="description" class="fields-label">Description</label>
					<textarea class="field-input" name="description" id="description" style=" border-radius: 0;border: solid 1px #4BA6A3;margin: 0px 0px 10px;max-width:338px; max-height:60px; width: 338px; height: 60px;" required></textarea>
					
					<div class="field">
						<label for="commentaire" class="fields-label">Commentaire</label>
						<input class="field-input" id="commentaire" type="text" name="commentaire" required>
					</div>
					
					<div class="field">
						<label for="duree" class="fields-label">Durée</label>
						<input type="number" value="1" class="field-input" id="duree" name="duree" required>
					</div>
					
					<div class="field">
						<label for="difficulte" class="fields-label">Difficulté</label>
						<select class="field-input" id="difficulte" name="difficulte" required><option>Bassse</option><option>Moyenne</option><option>Dur</option></select>
					</div>
					
					<div class="field">
						<label for="place" class="fields-label">Places</label>
						<input type="number" value="1" class="field-input" id="place" name="place" required>
					</div>
					<div class="field">
						<label for="heure" class="fields-label">Heure</label>
						<input type="time" value="08:00" class="field-input" id="heure" name="heure" required>
					</div>
					
					<div class="field">
						<label for="age" class="fields-label">Limite age</label>
						<input type="number" value="2" class="field-input" id="age" name="age" required>
					</div>
 						<button type="submit" class="myButton" name="valider" value="submit">Valider</button>
					
				</form>
				<?php $form->setAnimation(); ?>
				
			
				</section>
				