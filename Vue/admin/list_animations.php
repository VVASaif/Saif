		<section class="af-wrapper">
	            <h3>List des animations.</h3>
				<hr>
					<div class="field">
						
						<label class="fields-label">Animation</label>
						
						<select onChange="getAnimation()" id="code" class="field-input" name="animations">
							<option selected id="option" value="">Sélectionner</option>
							<?php echo $form->getAnimation(); ?>
						</select>
						
					</div>
					
					<div id="div_perso"></div>
					<div id="action"></div>
<script>
function getAnimation(code)
{

		
		var url;
		code = $("#code").val();
		url = "ajax_donnes_admin.php?code_anim="+code;
		
		console.log(code,url);
		 
		$.get(url, function(data){
		 
			console.log("data="+data);
			document.getElementById('div_perso').innerHTML = data;
			
		})		
		
	
}
</script>

</section>