<script type="text/javascript">
  jQuery(document).ready(function($){
    $('.OnOff').tooltip({
        animation: true,
        html: true,
        placement: 'bottom'
    });
});
</script>
		
<section id="test" class="af-wrapper">
<h3>Activer ou Désactiver une activité.</h3>
<hr>
	<div id="mycontent">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Date Activite</th>
				<th>Code Animation</th>
				<th>Nom résponsable</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php echo $form->getActivites(); ?>
	</table>
	</div>
</section>

					

	

