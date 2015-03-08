<?php
ini_set("display_errors", 1);
include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$code=$_GET['code_anim'];
$action=$_GET['action'];
if($action=='delet')
{
$delet = $form->actionDeletAnimation($code);
echo $delet;
}
?>
 