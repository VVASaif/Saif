<?php
session_start();
ini_set("display_errors", 1);
include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$status=$_GET['action'];
$date=$_GET['date'];
$form->OnOff($status,$date);
//$liendl='<br><br><a href="cheminvirtuel.txr" download="/'.$feuille.'" />t&eacutel&eacutecharger</a>';
//$liendl=str_replace('-','/',$liendl);

?>


					
					