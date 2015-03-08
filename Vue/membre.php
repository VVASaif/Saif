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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/lastvva/css/bootstrap/css/bootstrap-responsive.min.css">
<script type="text/javascript" src="http://localhost/lastvva/css/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/lastvva/css/styles_membre/layout.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/lastvva/css/form/style.css" />
<style>a, a:hover{color:#0076B8; text-decoration:none;}</style>

<script>
$(document).ready(function(){
	$("#myid li").click(function(){
		var value, url;
		value = this.id;
		url = "ajax_membre.php?code="+value;
		console.log(value,url);
		 
		$.get(url, function(data){
		 
			console.log("data="+data);
			document.getElementById('globe').innerHTML = data;
		})			
			
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
    </ul>
    <!-- ################################################################################################ --> 
  </div>
</div>
	<div class="wrapper row3">
  <main class="container clear"> 
    <!-- main body --> 
    <!-- ################################################################################################ -->
    <div class="sidebar one_quarter first"> 
      <!-- ################################################################################################ -->
      <h6>Liste des animations</h6>
      <nav class="sdb_holder">
        <ul id="myid">
          <?php $form->getAnimationMenu(); ?>
        </ul>
      </nav>
      <!-- ################################################################################################ --> 
    </div>
    <!-- ################################################################################################ --> 
	<div id="globe" style="width:100%;">
   <div class="content three_quarter">
   <?php $anim = $form->getAnimtionById('Sortie'); ?>
	<h1> <?php echo $anim->DESIGNATIONANIM; ?></h1>
	<?php echo $form->infos('Sortie'); ?>
	
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
			
			<?php echo $form->getActiviteByAnimation('Sortie',$anim->NBREPLACEANIM); ?>
			
		
		</table>
      </div>   
    </div>
	</div>
    	
    <!-- ################################################################################################ --> 
    <!-- / main body -->
    <div class="clear"></div>
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
		<?php 
			var_dump($anim);
	 ?>
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


<?php 
ob_end_flush(); ?>
