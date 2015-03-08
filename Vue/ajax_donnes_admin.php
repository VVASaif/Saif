<?php
ini_set("display_errors", 1);
include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$code=$_GET['code_anim'];
if($_GET['code_anim']=="Sélectionner"): header('Location: http://localhost/lastvva/Vue/admin.php'); endif;
$contenu=$form->getAnimtionById($code);
?>
					
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Designation</th>
				<th>Description</th>
				<th>Commentaire</th>
				<th>Durée</th>
				<th>Difficulté</th>
				<th>Places</th>
				<th>Heure</th>
				<th>Age</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<td><?php echo $contenu->DESIGNATIONANIM; ?></td>
		<td><?php echo $contenu->DESCRIPTANIM; ?></td>
		<td><?php echo $contenu->COMMENTANIM; ?></td>
		<td><?php echo $contenu->DUREEANIM; ?></td>
		<td><?php echo $contenu->DIFFICULTEANIM; ?></td>
		<td><?php echo $contenu->NBREPLACEANIM; ?></td>
		<td><?php echo $contenu->HRRDV; ?></td>
		<td><?php echo $contenu->LIMITAGE; ?></td>
		<td><a href="#"  onClick="removeAnimation()"><i class="icon-remove"></i> </a> - <a href="admin/EditAnimation.php?code=<?php echo $code; ?>" onclick="window.open(this.href, 'exemple', 'height=400, width=800, top=380, left=400, toolbar=yes, menubar=yes, location=no, resizable=yes, scrollbars=no, status=no'); return false;"><i class="icon-pencil"></i></a></td>
		</tbody>
	</table>
