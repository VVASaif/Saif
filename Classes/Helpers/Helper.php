<?php

namespace Helpers\Form;

use Connection;

class Helper
{
	// Connexion
	public function Connect()
	{
		$flag = true;
		
		if(count($_POST)>0)
		{
		if(empty($_POST['pseudo']))
		{
			$errorsPseudo ='<div class="alert alert-error">  
  								<a class="close" data-dismiss="alert">×</a>  
  								<center><strong>Warning! </strong> Le champs pseudo est vide !. </center>  
							</div>';
			$flag = false;
			return $errorsPseudo;
			
		}
		if(empty($_POST['password']))
		{
			$errorsPassword ='<div class="alert alert-error">  
  								<a class="close" data-dismiss="alert">×</a>  
  								<center><strong>Warnin !</strong> Le champs password est vide !. </center>  
							  </div>';
			$flag = false;
			return $errorsPassword;
		}
		}
		if($flag = true && !empty($_POST))
		{
			$pdo = new Connection();
			
			if($pdo->ConnexionUser($_POST['pseudo'],$_POST['password'])==1)
			{
				$_SESSION['pseudo'] = $_POST['pseudo'];
				$this->RedirectUser();
			}
			else
			{
				return $CompteNotFound = '<div class="alert alert-error">  
  											<a class="close" data-dismiss="alert">×</a>  
  											<center><strong>Warnin !</strong> Le compte n\'existe pas !. </center>  
							  			 </div>';
				
			}
			
		}		
				
	}
	
	//User 
		
		public function getProfilUser($id)
		{
			$pdo = new Connection();
			$user = $pdo->getProfilUser($id);
			return $user;
		} 
	
	// Redirection
	private function RedirectUser()
	{
		$pdo = new Connection();
		$info = $pdo->getTypeProfil($pdo->getIdUser($_POST['pseudo']));
		
		switch($info)
		{
			case 'ME':
				header('Location: http://localhost/lastvva/Vue/membre.php');
			break;
			
			case 'GE':
				header('Location: Vue/encadrant.php');
			break;
			
			case 'AD':
				header('Location: Vue/admin.php');
			break;
			
		}
		
	}
	
	// Session
	public function isLoggedRedirect()
	{
		if(!empty($_SESSION['pseudo']))
		{
			$pdo = new Connection();
			$info = $pdo->getTypeProfil($pdo->getIdUser($_SESSION['pseudo']));
		
			switch($info)
			{
				case 'ME':
					header('Location: Vue/membre.php');
				break;
			
				case 'GE':
					header('Location: Vue/encadrant.php');
				break;
			
				case 'AD':
					header('Location: Vue/admin.php');
				break;
			}	
		}
		
	}
	
	public function isNotLogged()
	{
		if(empty($_SESSION['pseudo']))
		{
			header('Location: http://localhost/lastvva/');
		}
	}
	
	public function SessionDestroy()
	{
		if(isset($_GET['destroy']) && $_GET['destroy']=='destroy')
		{ 
			session_destroy();
			header('Location:  http://localhost/lastvva/');
		}
	}
	
	public function sessionDestroys($value)
	{
		
			switch($value)
			{
				case 'activer':
					unset($_SESSION['activer']);
					header('location: http://localhost/lastvva/Vue/encadrant.php');
				break;
				case 'desactiver':
					unset($_SESSION['desactiver']);
					header('location: http://localhost/lastvva/Vue/encadrant.php');
				break;
			}
		
	}
	
	// Activite 
	
	public function getNom()
	{
		$pdo = new Connection();
		$nom = $pdo->getProfilUserByName($_SESSION['pseudo']);
		return $nom->nom;
	}
	
	public function getActivites()
	{
		$pdo = new Connection();
		$get = $pdo->getActivites();
		while($data = $get->fetch())
		{
			echo '<tbody>';
			echo '<td>'.$data['DATEACT'].'</td>';
			echo '<td>'.$data['CODEANIM'].'</td>';
			echo '<td>'.$data['NOMRESP'].'</td>';
	   		if($data['ANNULATIONACT']==0)
			{
		   		echo '<td><img src="../img/ON.jpg"" class="OnOff" title="Status : On" alt="Status: On"/></td>'; 
		   		echo  "<td><a href='onOff.php?action=desactiver&date=".$data['DATEACT']." '>Désactiver</a><td>";
		   		
			}
			if($data['ANNULATIONACT']==1)
			{
		   		echo '<td><img src="../img/OFF.png" class="OnOff" title="Status : Off" alt="Status: Off"/></td>';
		   		echo "<td><a href='onOff.php?action=activer&date=".$data['DATEACT']." '>Activer</a></td>";
		   		
			}
		}
	   		echo  '</tbody>';  			
	}
	
	public function getActivitesByDate($date)
	{
		$pdo = new Connection();
		$get = $pdo->getActivitesByDate($date);
		return $get;		
	}
	
	public function getCountDate($date)
	{
		$pdo = new Connection();
		$count = $pdo->getCountDate($date);
		return $count;
	}
	
	public function getActiviteByAnimation($code,$nbplace)
	{
		$pdo = new Connection();
		$req = $pdo->getActiviteByAnimation($code);
		while($data = $req->fetch())
		{
			$getTotalPu = $pdo->getTotalPuInscription($code,$data['DATEACT']);
			$count = $pdo->getExistInscription($_SESSION['pseudo'],$data['DATEACT']);
			$id = $pdo->getIdInscription($_SESSION['pseudo'],$data['DATEACT']);
			$restes = $nbplace - $getTotalPu;
			
			echo '<tbody>';
			echo '<td>'.$data['DATEACT'].'</td>';
			echo '<td>'.$data['NOMRESP'].'</td>';
			if($restes==0)
			{
				echo '<td><p style="color:red;">Complet !<p></td>';
			}else
			{
				echo '<td>'.$restes.'</td>';
			}
			if($data['ANNULATIONACT']==0)
				{
					if($restes<=0)
		 			{
			  			echo "<td><p>Impossible de s'inscrire !</p></td>";
			  			echo '<td><img src="../img/ON.jpg"" alt="Le statut est ON" /></td>';
					}
					elseif($restes>0)
					{
						if($count==1)
						{
							echo "<td><a href='inscription.php?action=edit&code=".$data['CODEANIM']."&date=".$data['DATEACT']."&nom=".$data['NOMRESP']."&noInscri=".$id."'>Modifier</a></td>";
						}else
						{
							echo "<td><a href='inscription.php?action=post&code=".$data['CODEANIM']."&date=".$data['DATEACT']."&nom=".$data['NOMRESP']."'>Séléctionner</a></td>";
						}						
						
						echo '<td><img src="../img/ON.jpg"" alt="Le statut est ON" /></td>';
					}	 
			}
		elseif($data['ANNULATIONACT'])
			{
				echo "<td><b>L'animation est annulée</b></td>";
				echo '<td><img src="../img/OFF.png" alt="Le statut est OFF"/></td>';
			}
			echo '</tbody>';
		}
		
	}
	
	public function OnOff($status,$date)
	{
		if(isset($status) && !empty($status))
		{

			$pdo = new Connection();
			switch($status)
			{
				case 'activer':
					$on = $pdo->UpdateActiviteOn($date);
					if($on)
						{
							$_SESSION['activer'] = '<div class="alert alert-success">
							<a class="close" href="http://localhost/lastvva/Vue/encadrant.php?value=activer" data-dismiss="alert">×</a> 
							<center><strong>Success !</strong> Le status a bien été mis à jour !. </center> 
							</div>';
								header('location: http://localhost/lastvva/Vue/encadrant.php');
						}
						else
						{
							$_SESSION['activer'] = '<div class="alert alert-error">  
  									<a class="close" href="http://localhost/lastvva/Vue/encadrant.php?value=activer" data-dismiss="alert">×</a>  
  									<center><strong>Warning !</strong> Une erreur est survenue !. </center>  
							  	</div>';
								header('location: http://localhost/lastvva/Vue/encadrant.php');
						}
				break;
				case 'desactiver':
					$off = $pdo->UpdateActiviteOff($date);
					if($off)
						{
							$_SESSION['desactiver'] = '<div class="alert alert-success">  
  									<a class="close" href="http://localhost/lastvva/Vue/encadrant.php?value=desactiver" data-dismiss="alert">×</a>  
  									<center><strong>Success !</strong> Le status a bien été mis à jour !. </center>  
							  	</div>';
								header('location: http://localhost/lastvva/Vue/encadrant.php');
						}
						else
						{
							$_SESSION['desactiver'] = '<div class="alert alert-error">  
  									<a class="close" href="http://localhost/lastvva/Vue/encadrant.php?value=desactiver" data-dismiss="alert">×</a>  
  									<center><strong>Warning !</strong> Une erreur est survenue !. </center>  
							  	</div>';
								
								header('location: http://localhost/lastvva/Vue/encadrant.php');
						}
					
				break;
			}
			
		}
	}
	
	public function OnOffAdmin($status,$date)
	{
		if(isset($status) && !empty($status))
		{
			$pdo = new Connection();
			switch($status)
			{
				case 'activer':
					$on = $pdo->UpdateActiviteOn($date);
					if($on)
						{
							echo  '<div class="alert alert-success">
							<a class="close" data-dismiss="alert">×</a> 
							<center><strong>Success !</strong> Le status a bien été mis à jour !. </center> 
							</div>';
								
						}
						else
						{
							echo '<div class="alert alert-error">  
  									<a class="close" data-dismiss="alert">×</a>  
  									<center><strong>Warning !</strong> Une erreur est survenue !. </center>  
							  	</div>';
								
						}
				break;
				case 'desactiver':
					$off = $pdo->UpdateActiviteOff($date);
					if($off)
						{
							echo '<div class="alert alert-success">  
  									<a class="close" data-dismiss="alert">×</a>  
  									<center><strong>Success !</strong> Le status a bien été mis à jour !. </center>  
							  	</div>';
								
						}
						else
						{
							echo '<div class="alert alert-error">  
  									<a class="close" data-dismiss="alert">×</a>  
  									<center><strong>Warning !</strong> Une erreur est survenue !. </center>  
							  	</div>';
						}
					
				break;
			}
		}
	}
	
	
	
	public function setActivite()
	{
		$post = $_POST;
		if(isset($post['submit']) && !empty($post['submit']))
		{
			$pdo = new Connection();
			$set = $pdo->setActivite($post['date'],$post['animation'],$post['encadrant'],0);
			if($set)
			{
				echo '<div class="alert alert-success">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Success !</strong> L\'activité a bien été ajoutée !. </center>  
						</div>';
			}else
			{
				echo '<div class="alert alert-error">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Warning !</strong> Cette activite existe déjà avec cette date !. </center>  
						</div>';
			}
		}
	}
	
	public function deletActivite($date)
	{
		$pdo = new Connection();
		$id = $pdo->getIdInscriptionByDate($date);
		$code = $pdo->getAnimationByActivite($date);
		$delet = $pdo->DeletActivite($code,$date);
		$count = $pdo->getCountDate($date);
		
		if($delet)
			{
				var_dump($count);
				if($count>0):
					if($pdo->DeletInscriptionById($id->NOINSCRIP)):
						$pdo->DeletParticipant($id->NOINSCRIP);
					endif;
				endif;
				echo '<div class="alert alert-success">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Success !</strong> L\'activité a bien été supprimer !. </center>  
					</div>';
					
			}else
			{
				echo '<div class="alert alert-error">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Warning !</strong> Une erreur est survenue, veuillez réessayer dans quelques minutes !. </center>  
					</div>';
			}
		
	}
	
	public function getIdActivite()
	{
		$pdo = new Connection();
		$get = $pdo->getActivites();
		while($data = $get->fetch())
		{
			echo '<option>'.$data[0].'</option>';
		}
	}
	
	// Animation
	
	public function setAnimation()
	{
		$post = $_POST;
		if(isset($post['valider']) && !empty($post['valider']))
		{
			$pdo = new Connection();
			$set = $pdo->setAnimation($post['code_animation'],$post['designation'],$post['description'],$post['commentaire'],$post['duree'],$post['difficulte'],$post['place'],$post['heure'],$post['age']);
			if($set)
			{
				echo '<div class="alert alert-success">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Success !</strong> L\'animation a bien été ajoutée !. </center>  
						</div>';
			}else
			{
				echo '<div class="alert alert-error">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Warnin !</strong> Cette animation existe déjà !. </center>  
						</div>';
			}
		}
		
	}
	
	public function getAnimationMenu()
	{
		$pdo = new Connection();
		$animation = $pdo->getAnimation();
		while($data = $animation->fetch())
		{
			echo '<li id='.$data[0].'><a href="#">'.$data[0].'</a></li>';
			
		}	
	}
	
	public function getAnimation()
	{
		$pdo = new Connection();
		$animation = $pdo->getAnimation();
		while($data = $animation->fetch())
		{
			echo '<option>'.$data[0].'</option>';
			
		}
	}
	
	public function getAnimtionById($code)
	{
		$pdo = new Connection();
		$animation = $pdo->getAnimtionById($code);
		return $animation;
	}
	
	public function infos($code)
	{
		$anim = $this->getAnimtionById($code);
		$level = $anim->DIFFICULTEANIM;
		$duree = $anim->DUREEANIM;
		$heure = $anim->HRRDV;
		switch($level)
		{
			case 'Basse':
				echo '<p style= margin-top:-2%;font-size:11px;">Difficulté: <span style="color:green;">'.$level.'</span> - Durée: '.$duree.' - Départ à '.$heure.' heure</p>';
			break;
			case 'Moyenne':
				echo '<p style= margin-top:-2%;font-size:11px;">Difficulté: <span style="color:orange;">'.$level.'</span> - Durée: '.$duree.' - Départ à '.$heure.' heure</p>';
			break;
			case 'Dur':
				echo '<p style= margin-top:-2%;font-size:11px;">Difficulté: <span style="color:red;">'.$level.'</span> - Durée: '.$duree.' - Départ à '.$heure.' heure</p>';
			break;
			
		}
		
	}
	
	public function updateAnimation()
	{
		$post = $_POST;
		if(isset($post['update']) && !empty($post['update']))
		{
		$pdo = new Connection();
		$up = $pdo->updateAnimation($post['code_animation'],$post['designation'],$post['description'],$post['commentaire'],$post['duree'].'H',$post['difficulte'],$post['place'],$post['heure'],$post['age'].' ans');
		if($up)
			{
				echo '<div class="alert alert-success">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Success !</strong> L\'animation a bien été mis à jour !. </center>  
						</div>';
			}else
			{
				echo '<div class="alert alert-error">  
  							<a class="close" data-dismiss="alert">×</a>  
  							<center><strong>Warnin !</strong> Une erreur est survenue, veuillez réessayer dans quelques instants !. </center>  
						</div>';
			}
		}
	}
	
	
	
	
	// Inscription
	
		//Update
		public function UpdateInscription($newTot,$userID,$dateact,$idanim)
		{
			$pdo = new Connection();
			$get = $pdo->UpdateInscription($newTot,$userID,$dateact,$idanim);
			return $get;
		}
		
		//Insert
		
		public function setInscription($NOINSCRIP,$USER,$CODEANIM,$DATEACT,$NBRETOTALINSCRIT)
		{
			$pdo = new Connection();
			$set = $pdo->setInscription($NOINSCRIP,$USER,$CODEANIM,$DATEACT,$NBRETOTALINSCRIT);
			return $set;
		}
		
		public function setParticipant($id,$rand,$nb1,$nb2,$nb3,$nb4,$nb5,$nb6)
		{
			$pdo = new Connection();
			$groupe = $pdo->getGroupes($id);
			while($data = $groupe->fetch())
			{
				$code = $data['TYPE_VACANCIER'];
				echo $code;
				switch($code)
				{
					case 'CV1':
						$pdo->setParticipant($rand,$code,$nb1);
					break;
					case 'CV2':
						$pdo->setParticipant($rand,$code,$nb2);
					break;
					case 'CV3':
						$pdo->setParticipant($rand,$code,$nb3);
					break;
					case 'CV4':
						$pdo->setParticipant($rand,$code,$nb4);
					break;
					case 'CV5':
						$pdo->setParticipant($rand,$code,$nb5);
					break;
					case 'CV6':
						$pdo->setParticipant($rand,$code,$nb6);
					break;
				}
			}
		}
		
		
	public function UpdateParticipant($noInscri,$nb1,$nb2,$nb3,$nb4,$nb5,$nb6)
	{
		$pdo = new Connection();
		$get = $pdo->getParticipant($noInscri);
		while($data = $get->fetch())
		{
			$code = $data['CODE_VACANCIER'];
			var_dump($code);
			switch($code)
			{
				case 'CV1':
					
				 	$pdo->UpdateParticipant($nb1,$noInscri,$code);
				break;	
				
				case 'CV2':
					
				 	$pdo->UpdateParticipant($nb2,$noInscri,$code);
				break;
				
				case 'CV3':
					
				 	$pdo->UpdateParticipant($nb3,$noInscri,$code);
				break;
				
				case 'CV4':
					
				 	$pdo->UpdateParticipant($nb4,$noInscri,$code);
				break;
				
				case 'CV5':
					
				 	$pdo->UpdateParticipant($nb5,$noInscri,$code);
				break;
				
				case 'CV6':
					
				 	$pdo->UpdateParticipant($nb6,$noInscri,$code);
				break;												
			} 
		}
	}
	public function getGroupes($value)
	{
		$pdo = new Connection();
		$get = $pdo->getGroupes($value);
		while($data = $get->fetch())
		{
			$type = $data['TYPE_VACANCIER'];
			switch($type)
			{
				case 'CV1':
				echo '<div class="field">
				<label class="fields-label">Bébé :</label>
        		<select class="class="field-input" name="nbr1">';
        			$nb = $data['NBREPERSTP'] + 1;
        			while ($nb > 0)
					{
            			echo '<option>';
           				echo $nb = $nb - 1;
           				echo '</option>';
        			}
        		echo '</select></div>';
				
				break;
				
				case 'CV2':
				echo '<div class="field">
				<label class="fields-label">Enfants :</label>
        		<select class="field-input" name="nbr2">';
        			$nb = $data['NBREPERSTP'] + 1;
        			while ($nb > 0)
					{
            			echo '<option>';
           				echo $nb = $nb - 1;
           				echo '</option>';
        			}
        		echo '</select></div>';
				break;
				
				case 'CV3':
				echo '<div class="field">
				<label class="fields-label">Ados :</label>
        		<select class="field-input" name="nbr3">';
        			$nb = $data['NBREPERSTP'] + 1;
        			while ($nb > 0)
					{
            			echo '<option>';
           				echo $nb = $nb - 1;
           				echo '</option>';
        			}
        		echo '</select></div>';
				break;
				
				case 'CV4':
				echo '<div class="field">
				<label class="fields-label">Jeunes :</label>
        		<select class="field-input" name="nbr4">';
        			$nb = $data['NBREPERSTP'] + 1;
        			while ($nb > 0)
					{
            			echo '<option>';
           				echo $nb = $nb - 1;
           				echo '</option>';
        			}
        		echo '</select></div>';
				break;
				
				case 'CV5':
				echo '<div class="field">
				<label class="fields-label">Adultes :</label>
        		<select class="field-input" name="nbr5">';
        			$nb = $data['NBREPERSTP'] + 1;
        			while ($nb > 0)
					{
            			echo '<option>';
           				echo $nb = $nb - 1;
           				echo '</option>';
        			}
        		echo '</select></div>';
				break;
				
				case 'CV6':
				echo '<div class="field">
				<label class="fields-label">Sénior :</label>
        		<select class="field-input" name="nbr6">';
        			$nb = $data['NBREPERSTP'] + 1;
        			while ($nb > 0)
					{
            			echo '<option>';
           				echo $nb = $nb - 1;
           				echo '</option>';
        			}
        		echo '</select></div>';
				break;
				
			}
		}
	}
	
	public function getTotalPlaces($id)
	{
		$pdo = new Connection();
		$get = $pdo->getTotalPlaces($id);
		return $get;
	}
	
	public function getPlaceAnimation($id)
	{
		$pdo = new Connection();
		$get = $pdo->getAnimtionById($id);
		return $get->NBREPLACEANIM;
	}	
	
	public function getTotalPuInscription($id,$date)
	{
		$pdo = new Connection();
		$get = $pdo->getTotalPuInscription($id,$date);
		if($get==null): $get = 0 ; endif;
		return $get;
	}
	
	public function getExistInscription($id,$date)
	{
		$pdo = new Connection();
		$get = $pdo->getExistInscription($id,$date);
		return $get;
	}
	
	public function getCountInscription($id,$date)
	{
		$pdo = new Connection();
		$get = $pdo->getCountInscription($id,$date);
		if($get==null): $get = 0 ; endif;
		return $get;
	}

	public function getDateInscription($id,$date)
	{
		$pdo = new Connection();
		$get = $pdo->getDateInscription($id,$date);
		return $get;
	}
	
	public function getInscription()
	{
		$pdo = new Connection();
		$get = $pdo->getInscription();
		while($data = $get->fetch())
		{
		$nom = $pdo->getProfilUser($data['USER']);	
		echo '<tbody>';
		echo '<td>'.$data['NOINSCRIP'].'</td>';
		echo '<td>'.$nom->nom.'</td>';
		echo '<td>'.$data['CODEANIM'].'</td>';
		echo '<td>'.$data['DATEACT'].'</td>';
		echo '<td>'.$data['NBRETOTALINSCRIT'].'</td>';
		}
	}


	//Admin
	public function actionDeletAnimation($code)
	{
		$pdo = new Connection();
		$count = $pdo->countAnimation($code);
		if($count==0):
			if($pdo->DeletAnimation($code)):
				echo'<div class="alert alert-success">  
  					<a class="close" data-dismiss="alert">×</a>  
  					<center><strong>Success !</strong> L\'animation à bien été supprimer !. </center>  
					</div>';
			endif;
		else:
			echo	'<div class="alert alert-error">  
  					<a class="close" data-dismiss="alert">×</a>  
  					<center><strong>Warnin !</strong> Cette animation est déjà lié à une activité !. </center>  
					</div>';
		endif;
		
	}
	
}
?>