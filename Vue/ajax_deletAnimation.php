<?php
ini_set("display_errors", 1);
include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$code=$_GET['code'];
$contenu=$form->actionDeletAnimation($code);
?>
<p id="content" style="visibility:hidden;"><?php $form->getAnimation(); ?></p>

<?php echo $contenu; ?>

