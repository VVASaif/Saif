		<section class="af-wrapper">
	            <h3>List des animations.</h3>
				<hr>
					<div class="field">
						
						<label class="fields-label">Animation</label>
						
						<select id="choixpersonnage" class="field-input" name="animations">
							<option selected value="">Sélectionner une animation</option>
							<?php echo $form->getAnimation(); ?>
						</select>
						
					</div>
					
					<div id="div_perso"></div>
<script>
$(document).ready(function(){
	
	
	$("#choixpersonnage").change(function(){
		
		var value, url;
		value = $("#choixpersonnage").val();
		url = "ajax_donnes.php?code_anim="+document.getElementById("choixpersonnage").value;
		
		console.log(value,url);
		 
		$.get(url, function(data){
		 
			console.log("data="+data);
			document.getElementById('div_perso').innerHTML = data;
		})		
		
	});
	
});
</script>
</section>