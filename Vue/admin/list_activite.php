		<section class="af-wrapper">
	            <h3>List des activités.</h3>
				<hr>
					<div class="field">
						
						<label class="fields-label">Activités</label>
						
						<select onChange="getActivite()" id="dateact" class="field-input" name="animations">
							<option selected id="option" value="">Sélectionner</option>
							<?php echo $form->getIdActivite(); ?>
						</select>
					</div>
					<div id="new">
					<div id="activite"></div>
					
					<div id="actionn"></div>
					</div>
<script>
function getActivite()
{
		var url,date;
		date = $("#dateact").val();
		url = "admin/ajax_activite.php?date="+date;
		
		console.log(date,url);
		 
		$.get(url, function(data){
		 
			console.log("data="+data);
			document.getElementById('new').innerHTML = data;
			
		})		
		
	
}
</script>
</section>