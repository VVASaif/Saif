<?php
ob_start();
session_start();

include('../vendor/autoload.php');

	use \Helpers\Form\Helper;
	
$form = new Helper();
$form->isNotLogged();
$form->SessionDestroy();
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VVA | Membre</title>

<link rel="stylesheet" type="text/css" href="http://localhost/lastvva/css/styles_membre/layout.css" />


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap-responsive.min.css">
<script type="text/javascript" src="http://localhost/lastvva/css/bootstrap/js/bootstrap.min.js"></script>
<link href="http://localhost/lastvva/css/style_inscription.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="http://localhost/lastvva/css/form/style.css" />

<style>a, a:hover{color:#0076B8; text-decoration:none;}</style>
<script>
$(document).ready(function(){
	$('.field-input').focus(function(){
	$(this).parent().addClass('is-focused has-label');
	});
	
	$('.field-input').blur(function(){
		$parent = $(this).parent();
		if($(this).val() == ''){
			$parent.removeClass('has-label');
		}
		$parent.removeClass('is-focused');
	});
});
</script>
</head>
<body>
<div class="wrapper row2">
  <nav id="mainav" class="clear"> 
    <!-- ################################################################################################ -->
    <ul class="clear">
      <li><a href="../index.php">VVA</a></li>
      <li class="active"><a href="#">Mon compte</a></li>
	  
      <?php if(!empty($_SESSION['pseudo'])){ echo  '<li><a href="?destroy=destroy">Deconnexion</a></li>';} ?>
    </ul>
    <!-- ################################################################################################ --> 
  </nav>
</div>
<div class="wrapper row6">
  <div id="breadcrumb">
    <!-- ################################################################################################ -->
    <ul>
      <li><a href="../index.php">VVA</a></li>
      <li><a href="#">Mon compte</a></li>
	  <li><a href="#">Inscription</a></li>
    </ul>
    <!-- ################################################################################################ --> 
  </div>
</div>
	<div class="wrapper row3">
  <main class="container clear"> 
  <div id="globe" style="width:100%;">
   <div class="content three_quarter" style="width:100%;">
    <!-- main body --> 
	<section id="test" class="af-wrapper" style="width:100%;">
<form class="form-signin" role="form" method="post" >
<h3 class="form-signin-heading">Inscription à une activité.</h3>
<hr>
<div class="field">
<label for="date" class="fields-label">Date</label>
<input type="text" value="<?php if(isset($_GET['date'])){echo $_GET['date'];} ?>"  class="field-input" id="date" name="date" required>
</div>
<input type="hidden" value="<?php if(isset($_GET['nom'])){echo $_GET['nom'];} ?>"  class="field-input" id="password" name="password" >
<?php $form->getGroupes($_SESSION['pseudo']); ?><br />
 <button type="submit" class="myButton" value="submit" name="submit">Connect me</button>
</form>

<?php 
$post = $_POST;
var_dump($_POST);
if(isset($post['submit']) && !empty($post['submit']))
{
	if(isset($_GET['action']) && !empty($_GET['action']))
	{
		$action = $_GET['action'];
		switch($action)
		{
		case 'post':
		
			if(!empty($_POST['nbr1']))
				{
					$nb1=$_POST['nbr1'];
				}else
				{
					$nb1= null;
				}
		
			if(!empty($_POST['nbr2']))
				{
			 		$nb2=$_POST['nbr2'];
				}else
				{
			 		$nb2= null;
				}
				
        	if(!empty($_POST['nbr3']))
				{
			 		$nb3=$_POST['nbr3'];
				}else
				{
			 		$nb3= null;
				}
		
			if(!empty($_POST['nbr4']))
				{
			 		$nb4=$_POST['nbr4'];
				}else
				{
			 		$nb4= null;
				}
		
        	if(!empty($_POST['nbr5']))
				{
			 		$nb5=$_POST['nbr5'];
				}else
				{
			 		$nb5= null;
				}
        
			if(!empty($_POST['nbr6']))
				{
			 		$nb6=$_POST['nbr6'];
				}else
				{
			 		$nb6= null;
				}
					$total = $nb1 + $nb2 + $nb3 + $nb4 + $nb5 + $nb6;
					$date = $post['date'];
					$rand = rand(1, 9999);
					$user = $form->getProfilUser($_SESSION['pseudo']);
										
					$placeAnimation = $form->getPlaceAnimation($_GET['code']);
					$place = $form->getTotalPuInscription($_GET['code'],$_GET['date']); 
					$placeTotal = $placeAnimation - $place;
					
					$placeTotal.'<br>'; 
					$newPlace = $form->getCountInscription($_SESSION['pseudo'],$_GET['date']);
					$exist = $form->getExistInscription($_SESSION['pseudo'],$_GET['date']);
					$doubleDate = $form->getDateInscription($_SESSION['pseudo'],$_GET['date']);
					$TotalPu = $form->getTotalPlaces($_SESSION['pseudo']);
					$newTotal = $total + $newPlace;
					$errordate1 = '<center><span class="label label-important">Impossible de s\'inscrire, La date de début du séjour est superieur à la date d\'activité!</span></center>';
					$errordate2 = '<center><span class="label label-important">Impossible de s\'inscrire, La date de fin du séjour est inférieur à la date d\'activité!</span></center>';
				if($exist==0)
				{	
				if($total>$placeTotal): //1
					echo "<div class='alert alert-error'>
            		<button type='button' class='close' data-dismiss='alert'>&times;</button>
            		<center>Le nombre de personne choisi est trop grand, vous pouvez ajouter encore $placeTotal personnes à inscrire.</center>
					</div>
					</center>";
				else:
					if ($placeTotal > 0 && $placeTotal <= $place || $placeTotal > $place): // 2
					
						if ($user->dateDebutSejour < $date)://3
						
							if ($user->dateFinSejour > $date)://4

								 	if($form->setInscription($rand,$_SESSION['pseudo'],$_GET['code'],$post['date'],$total))://8
										var_dump($form->setParticipant($_SESSION['pseudo'],$rand,$nb1,$nb2,$nb3,$nb4,$nb5,$nb6));
										echo '<center><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
										L\'inscription à l\'activité est terminer ! Votre numéro d\'inscription est le : <b>'.$rand.'</b></div></center>';																
									endif; // 8	 
							else:
								echo $errordate2;
							endif;//4
							
						else:
							echo $errordate1;						
						endif;//3
						
					endif;//2
					
				endif; //1
				}else
				{
					echo '<center><div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>
						Vous êtes déjà inscrit à cette activité.</div></center>';	
				}
			break;
			case 'edit':
			
			if(!empty($_POST['nbr1']))
				{
					$nb1=$_POST['nbr1'];
				}else
				{
					$nb1= null;
				}
		
			if(!empty($_POST['nbr2']))
				{
			 		$nb2=$_POST['nbr2'];
				}else
				{
			 		$nb2= null;
				}
				
        	if(!empty($_POST['nbr3']))
				{
			 		$nb3=$_POST['nbr3'];
				}else
				{
			 		$nb3= null;
				}
		
			if(!empty($_POST['nbr4']))
				{
			 		$nb4=$_POST['nbr4'];
				}else
				{
			 		$nb4= null;
				}
		
        	if(!empty($_POST['nbr5']))
				{
			 		$nb5=$_POST['nbr5'];
				}else
				{
			 		$nb5= null;
				}
        
			if(!empty($_POST['nbr6']))
				{
			 		$nb6=$_POST['nbr6'];
				}else
				{
			 		$nb6= null;
				}
					$total = $nb1 + $nb2 + $nb3 + $nb4 + $nb5 + $nb6;
					$date = $post['date'];
					$user = $form->getProfilUser($_SESSION['pseudo']);	
								
					$placeAnimation = $form->getPlaceAnimation($_GET['code']);
					$place = $form->getTotalPuInscription($_GET['code'],$_GET['date']); 
					$placeTotal = $placeAnimation - $place;
					
					
					$newPlace = $form->getCountInscription($_SESSION['pseudo'],$_GET['date']);
					$exist = $form->getExistInscription($_SESSION['pseudo'],$_GET['date']);
					$doubleDate = $form->getDateInscription($_SESSION['pseudo'],$_GET['date']);
					$TotalPu = $form->getTotalPlaces($_SESSION['pseudo']);
					$newTotal = $total + $newPlace;
					
					$errordate1 = '<center><span class="label label-important">Impossible de s\'inscrire, La date de début du séjour est superieur à la date d\'activité!</span></center>';
					$errordate2 = '<center><span class="label label-important">Impossible de s\'inscrire, La date de fin du séjour est inférieur à la date d\'activité!</span></center>';
			if($total>$placeTotal): //1
				echo "<div class='alert alert-error'>
            		<button type='button' class='close' data-dismiss='alert'>&times;</button>
            		<center>Le nombre de personne choisi est trop grand, vous pouvez ajouter encore $placeTotal personnes à inscrire.</center>
					</div>
					</center>";
					else:
				if($place!=$total)
				{
				if ($placeTotal > 0 && $placeTotal <= $place || $placeTotal > $place): // 2					
					if ($user->dateDebutSejour < $date)://3
						if($user->dateFinSejour > $date)://4
							if ($exist == 1 && $doubleDate != $date)://5
				 					$reste = $TotalPu - $newPlace ;
								if ($newTotal > $TotalPu) : //6
									if ($reste < 0): $reste = 0; endif;
									echo '<center><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>
                              		<b>Le nombre choisi est trop grand vous pouvez ajoutez encore que '.$reste.' personne à inscrire !<b></div></center>';
									else:
										if($form->UpdateInscription($newTotal,$_SESSION['pseudo'],$date,$_GET['code']))://7
											var_dump($form->UpdateParticipant($_GET['noInscri'],$nb1,$nb2,$nb3,$nb4,$nb5,$nb6));
											echo '<center><span class="label label-success">Le changement à bien été pris en compte </span></center>
                                 			<center><span class="label label-success">il reste ' . $placeTotal . ' place </span></center>';											
										endif;//7		
									endif;//6			
							endif;// 5
						else:
							echo $errordate2;
						endif;//4
							
					else:
						echo $errordate1;						
					endif;//3
				endif;//2
				}
				else
				{
					echo '<center><span class="label label-success">Vous êtes déjà inscrit avec se nombre de personne.</span></center>';	
				}
			endif;//1
			break;
		}
	}else
	{
		 header('location: http://localhost/lastvva/Vue/membre.php');	
	}
}
?>

</section>
    <!-- / main body -->
    </div></div>
  </main>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <footer id="footer" class="clear"> 
    <!-- ################################################################################################ -->
    <div class="one_half first">
      <h6 class="title">Débug</h6>
		<?php var_dump($_SESSION);	 ?>
    </div>
    <div class="one_quarter">
      <h6 class="title">Adresse</h6>
      <address class="btmspace-30">
      VVA<br>
      Rue Jules Michelet 99<br>
      Colombes<br>
      92700/Zip
      </address>
      <ul class="nospace">
        <li class="btmspace-10"><i class="fa fa-clock-o"></i> Mon. - Fri. 9am - 7pm</li>
        <li class="btmspace-10"><i class="fa fa-phone"></i> 07 81 96 79 65</li>
        <li><i class="fa fa-envelope-o"></i> saif.kermoun@gmail.com</li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title">About Me</h6>
      <p class="btmspace-30">Dui leo egestas augue, eget molestie augue diam nec ante.</p>
      <form action="#" method="post">
        <input class="btmspace-15" type="text" value="" placeholder="Enter Email Here">
        <button class="bold uppercase" type="submit" value="Subscribe">Subscribe <i class="fa fa-chevron-right"></i></button>
      </form>
    </div>
    <!-- ################################################################################################ --> 
  </footer>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2015 - All Rights Reserved - <a href="#">VVA</a></p>
    
    <!-- ################################################################################################ --> 
  </div>
</div>
</body>
</html>


<?php ob_end_flush(); ?>
