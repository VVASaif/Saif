<?php
session_start();
ini_set("display_errors", 1);
include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$code=$_GET['code'];

?>
<div id="globe" style="width:100%;">
<div class="content three_quarter">
	<?php $anim = $form->getAnimtionById($code); ?>
	<h1> <?php echo $anim->DESIGNATIONANIM; ?></h1>
	<?php echo $form->infos($code); ?>
	
     <p><?php echo $anim->COMMENTANIM; ?></p>
      <p><?php echo $anim->DESCRIPTANIM; ?></p>
	  
      <h1>Choisir une activité</h1>
      <div class="scrollable">
	  	<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>Responsable</th>
					<th>Place</th>
					<th>Choix</th>
					<th>Status</th>
				</tr>
			</thead>
			
			<?php echo $form->getActiviteByAnimation($code,$anim->NBREPLACEANIM); ?>
		
		</table>
      </div>   
    </div>
	</div>