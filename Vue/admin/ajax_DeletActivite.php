<?php
ini_set("display_errors", 1);
include('../../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$date=$_GET['date'];
$delet = $form->deletActivite($date);
$contenu=$form->getActivitesByDate($date);
?>
			
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Date</th>
				<th>Responsable</th>
				<th>Code</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>

		<?php 
		while($data = $contenu->fetch())
		{
			echo '<tbody>';
			echo '<td>'.$data['DATEACT'].'</td>';
			
			echo '<td>'.$data['NOMRESP'].'</td>';
			echo '<td>'.$data['CODEANIM'].'</td>';
	   		if($data['ANNULATIONACT']==0)
			{
		   		echo '<td><img src="../img/ON.jpg"" class="status" title="Status : On" alt="Status: On"/></td>'; 
 				echo "<td>	<a title='Désactiver' 	href='#' 	onclick='DownActivite()' ><i class='icon-thumbs-down'>	</i>	</a> - 
							<a title='Supprimer' 	href='#' 	onclick='RemoveActivite()' ><i class='icon-remove'>		</i>	</a> - 
							<a title='Editer' 		href='#' 	onclick=''	>	</a>
					<td>";
			}
			if($data['ANNULATIONACT']==1)
			{
		   		echo '<td><img src="../img/OFF.png" class="status" title="Status : Off" alt="Status: Off"/></td>';
				echo "<td>	<a title='Activer' 		href='#' 	onclick='UpActivite()' ><i class='icon-thumbs-up'>	</i>	</a> - 
							<a title='Supprimer' 	href='#' 	onclick='RemoveActivite()' ><i class='icon-remove'>	</i>	</a> - 
							<a title='Editer' 		href='#' 	onclick='' 	>	</a>
					</td>";
			}
		}
	   		echo  '</tbody>'; 
		 ?>		
	</table>
	
<?php echo $delet; ?>
