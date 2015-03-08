<?php
class Connection{

    protected $db;

    public function Connection(){

    $conn = NULL;

        try{
            $conn = new PDO("mysql:host=localhost;dbname=lastvva", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage();
                }   
            $this->db = $conn;
    }
   
    public function getConnection(){
        return $this->db;
    }


	// Les Selects

	
	// Animation
	public function getAnimation()
	{
		$req = $this->db->query("SELECT * FROM animation");
		return $req;
	}
	
	public function getAnimtionById($vc)
	{
		$v = $this->db->quote($vc);
		$req = $this->db->query("SELECT * FROM animation WHERE codeAnim=$v");
		
		while($a = $req->fetch(PDO::FETCH_OBJ))
		{
			return $a;
		}
	}
	
	
	// Profil
	public function getTypeProfil($id)
	{
		$i = $this->db->quote($id);
		$sql = "SELECT typeProfil FROM profil where USER_ID = $i";
		$req = $this->db->query($sql);
		while($data = $req->fetch(PDO::FETCH_OBJ))
		{
			return $data->typeProfil;
		}		
	}	
	
	public function getProfilUser($login)
	{
		$l = $this->db->quote($login);
		$sql = "SELECT * FROM profil where USER_ID = $l";
		$req = $this->db->query($sql);
		while($data = $req->fetch(PDO::FETCH_OBJ))
		{
			return $data;
		}
			
	}
	
	public function getProfilUserByName($login)
	{
		$l = $this->db->quote($login);
		$sql = "SELECT * FROM profil where login = $l";
		$req = $this->db->query($sql);
		while($data = $req->fetch(PDO::FETCH_OBJ))
		{
			return $data;
		}
			
	}
	
	public function getIdUser($login)
	{
		$l = $this->db->quote($login);
		$req = "SELECT USER_ID FROM profil WHERE login=$l";
		$fp = $this->db->query($req);
		while($a = $fp->fetch(PDO::FETCH_OBJ))
		{
			return $a->USER_ID;
			
		}
		
	}
		
	public function ConnexionUser($login,$mdp) 
	{
		$l = $this->db->quote($login);
		$m = $this->db->quote($mdp);
		$req = $this->db->query("SELECT * FROM profil WHERE login=$l AND mdp=$m");
		$count = $req->rowCount();
		return $count;
	}
	
		
	//
	public function SelectTypeV()
	{
		$req = "SELECT * FROM type_vacancier";
		$fp = $this->db->query($req);
		return $fp;
	}
	

	// Inscription
	
	public function getLoginExist($login,$mdp) 
	{
		$l = $this->db->quote($login);
		$m = $this->db->quote($mdp);
		$req = $this->db->query("SELECT login FROM profil WHERE login=$l And mdp!=$m");
		$count = $req->rowCount();
		return $count;
	}
	
	public function getDateControl($login) 
	{
		$l = $this->db->quote($login);
		$req = $this->db->query("SELECT dateFinSejour FROM profil WHERE login=$l");
		while($a = $req->fetch(PDO::FETCH_OBJ))
		{
			return $a->dateFinSejour;
		}
	}
	
		public function SelectTypeProfil($login)
	{
		$l = $this->db->quote($login);
		$req = $this->db->query("SELECT typeProfil FROM `profil` WHERE login=$l");
		while($a = $req->fetch(PDO::FETCH_OBJ))
		{
			return $a->typeProfil;
		}
	}
	
	public function SelectFormule($code)
	{
		$c = $this->db->quote($code);
		$req = $this->db->query("SELECT * FROM formule WHERE code_formule=$c");
		while($a = $req->fetch(PDO::FETCH_OBJ))
		{
			return $a;
		}
	}
	
	public function MenuAnim()
	{
		$req = $this->db->query("SELECT * FROM animation");
		while($a = $req->fetch(PDO::FETCH_OBJ))
		{
			echo "<li><a href='http://localhost/train/Vue/compte.php?vc={$a->codeAnim}'>{$a->codeAnim}</a></li>";
		}
	}
	
	
	

	
	public function Double($codeAnimation)
	{
	$ca = $this->db->quote($codeAnimation);
	$req = $this->db->query("SELECT codeAnim FROM animation WHERE codeAnim=$ca");
	$double = $req->rowCount();
	return $double;
	}
	

	
	// Activite
	public function getActivites()
	{
		$req = $this->db->query("SELECT * FROM ACTIVITE");
		return $req;
	}
	
	public function getActivitesByDate($date)
	{
		$d = $this->db->quote($date);
		$req = $this->db->query("SELECT * FROM ACTIVITE where DATEACT=$d");
		return $req;
	}
	
	public function getActiviteByAnimation($vc)
	{
		$v = $this->db->quote($vc);
		$req = $this->db->query("SELECT * FROM ACTIVITE WHERE CODEANIM=$v");
		return $req;
	}
	public function getAnimationByActivite($date)
	{
		$date = $this->db->quote($date);
		$req = $this->db->query("SELECT CODEANIM FROM ACTIVITE WHERE DATEACT=$date");
		while($data = $req->fetch(PDO::FETCH_OBJ))
		{
			return $data->CODEANIM;
		}
	}
	
	public function countAnimation($code)
	{
		$code = $this->db->quote($code);
		$req = $this->db->query("SELECT CODEANIM FROM ACTIVITE WHERE CODEANIM=$code");
		return $count = $req->rowCount();
	}
	
	
	// Inscription
	
	public function getGroupes($USER_ID)
	{
		$l = $this->db->quote($this->getIdUser($USER_ID));
		$req = $this->db->query("SELECT * FROM groupe WHERE USER_ID=$l");
		return $req;	
	}
	
	
	public function getInscription()
	{
		$req = $this->db->query("SELECT * FROM inscription");
		return $req;
	}
	
	public function GetNoInscrip($id)
	{
		$i = $this->db->quote($id);
		$req = $this->db->query("SELECT NOINSCRIP FROM inscription WHERE USER=$i");
		while($a = $req->fetch(PDO::FETCH_OBJ))
		{
				return $a->NOINSCRIP;
		}
	}
	
	public function getExistInscription($id,$dateact)
	{
			$id = $this->db->quote($this->getIdUser($id));
			$dateact = $this->db->quote($dateact);
			$modif = $this->db->query("SELECT NOINSCRIP FROM inscription WHERE USER=$id AND DATEACT=$dateact");
			return $modif->rowCount();		
	}
	
	public function getIdInscriptionByDate($dateact)
	{
			
			$dateact = $this->db->quote($dateact);
			$req = $this->db->query("SELECT * FROM inscription WHERE DATEACT=$dateact");
			while($data = $req->fetch(PDO::FETCH_OBJ))
			{
				return $data;
			}		
	}
	
	public function getCountInscription($id,$date)
	{
			$id = $this->db->quote($this->getIdUser($id));
			$date = $this->db->quote($date);
			$req = $this->db->query("SELECT NOINSCRIP FROM inscription WHERE USER=$id AND DATEACT=$date");
			while($data = $req->fetch(PDO::FETCH_OBJ))
			{
				$resu = $data->NOINSCRIP;
			}	
	}
	
		public function getCountDate($date)
	{
			
			$date = $this->db->quote($date);
			$req = $this->db->query("SELECT * FROM inscription WHERE DATEACT=$date");
			return $req->rowCount();	
			
	}

	public function getDateInscription($id,$date)
	{
			$id = $this->db->quote($this->getIdUser($id));
			$date = $this->db->quote($date);
			$req = $this->db->query("SELECT DATEACT FROM inscription WHERE USER=$id AND DATEACT=$date");
			while($data = $req->fetch(PDO::FETCH_OBJ))
			{
				$resu = $data->DATEACT;
			}	
	}	
	
	public function getTotalPuInscription($id,$date)
	{
		$id = $this->db->quote($id);
		$date = $this->db->quote($date);
		$req = $this->db->query("SELECT SUM(NBRETOTALINSCRIT) as tot FROM inscription WHERE CODEANIM=$id AND DATEACT=$date");
		while($tpu = $req->fetch(PDO::FETCH_OBJ))
			{
				return $tpu->tot;
			}
	}
	
	public function getIdInscription($id,$date)
	{
		$id = $this->db->quote($this->getIdUser($id));
		$date = $this->db->quote($date);
		$req = $this->db->query("SELECT NOINSCRIP FROM inscription WHERE USER=$id AND DATEACT=$date");
		while($tpu = $req->fetch(PDO::FETCH_OBJ))
			{
				return $tpu->NOINSCRIP;
			}
	}
	
	public function getTotalPlaces($id)
	{
		$i = $this->db->quote($this->getIdUser($id));
		$req = $this->db->query("SELECT SUM(NBREPERSTP) as total FROM groupe WHERE USER_ID=$i");
		while($a = $req->fetch(PDO::FETCH_OBJ))
			{
				return $a->total;
			} 
	}
	
	public function PlaningAct($id)
	{
		$i = $this->db->quote($id);
		$req = $this->db->query("SELECT i.NOINSCRIP, p.nom, p.prenom,i.DATEACT,a.NOMRESP,an.DESIGNATIONANIM
								FROM inscription as i, profil as p,ACTIVITE as a,animation as an
								WHERE p.USER_ID=i.USER
								AND i.DATEACT=a.DATEACT
								AND a.CODEANIM=an.codeAnim
								AND p.USER_ID=$i");
		
		return $req;
	}
	
	public function DoubleInscrit($id,$date,$code)
	{
		$i = $this->db->quote($id);
		$d = $this->db->quote($date);
		$c = $this->db->quote($code);
		
		$req = $this->db->query("SELECT * FROM inscription WHERE USER=$i AND DATEACT=$d AND CODEANIM=$c");
		while($a = $req->fetch(PDO::FETCH_OBJ))
			{
				return $a;
			} 
	}
	
	public function DoubleInscritRows($id,$date,$code)
	{
		$i = $this->db->quote($id);
		$d = $this->db->quote($date);
		$c = $this->db->quote($code);
		
		$req = $this->db->query("SELECT * FROM inscription WHERE USER=$i AND DATEACT=$d AND CODEANIM=$c");
		$ok = $req;
		return $ok->rowCount();
	}
	
	
	
	public function getParticipant($noInscri)
	{
		$n = $this->db->quote($noInscri);
		$req = $this->db->query("SELECT * FROM PARTICIPANT WHERE NOISNCRIPT=$n");
		return $req;
	}
	
	
	// Les Updats
	
	
	public function UpdateInscription($newTot,$userID,$dateact,$idanim)
	{
		$n = $this->db->quote($newTot);
		$u = $this->db->quote($this->getIdUser($userID));
		$d = $this->db->quote($dateact);
		$i = $this->db->quote($idanim);
		$req = ("UPDATE inscription SET NBRETOTALINSCRIT=$n WHERE USER=$u AND DATEACT=$d AND CODEANIM=$i");
		$succes = $this->db->exec($req);
		if($succes){ return true;} else   {return false;}	
	}
	
	public function updateAnimation($code,$desi,$descri,$comment,$duree,$level,$place,$heure,$age)
	{
		$a = $this->db->quote($code);
		$b = $this->db->quote($desi);
		$c = $this->db->quote($descri);
		$d = $this->db->quote($comment);
		$e = $this->db->quote($duree);
		$f = $this->db->quote($level);
		$g = $this->db->quote($place);
		$h = $this->db->quote($heure);
		$i = $this->db->quote($age);
		$req = ("UPDATE animation SET DESIGNATIONANIM=$b, DESCRIPTANIM=$c ,COMMENTANIM=$d, DUREEANIM=$e, DIFFICULTEANIM=$f, NBREPLACEANIM=$g, HRRDV=$h, LIMITAGE=$i WHERE codeAnim=$a");
		$succes = $this->db->exec($req);
		if($succes){ return true;} else   {return false;}
	}
	
	public function UpdateParticipant($valeur,$noInscri,$codeVac)
	{
		$v = $this->db->quote($valeur);
		$n = $this->db->quote($noInscri);
		$c = $this->db->quote($codeVac);
		$req = ("UPDATE PARTICIPANT SET NBREINSCRIT=$v WHERE NOISNCRIPT=$n AND CODE_VACANCIER=$c");		
		if($this->db->exec($req)){ return true;}else{return false;}	
	}
	
	public function UpdateActiviteOff($date)
	{
		$d = $this->db->quote($date);
		$req = $this->db->exec("UPDATE ACTIVITE SET ANNULATIONACT = 1 WHERE `DATEACT`=$d");
		if($req){return true;}else{return false;}
	}
	
	public function UpdateActiviteOn($date)
	{
		$d = $this->db->quote($date);
		$req = $this->db->exec("UPDATE ACTIVITE SET ANNULATIONACT = 0 WHERE `DATEACT`=$d");
		if($req){return true;}else{return false;}
	}
	
	// Fin Updat
	
	// Les Delets
	public function DeletProfil($USERID)
	{
		$id = $this->db->quote($USERID);
		$req = "DELETE FROM `profil` WHERE USER_ID=$id";
		$adr = "DELETE FROM adresse WHERE USER_ID=$id";
		$grp = "DELETE FROM groupe WHERE USER_ID=$id";
		if($this->db->exec($grp))
		{
			if($this->db->exec($adr))
			{
				if($this->db->exec($req))
				{
					return true;
				}
			}
		}else
		{
			return false;
		}		
	}
	
	public function DeletInscription($user,$date)
	{
		$u = $this->db->quote($user);
		$d = $this->db->quote($date);
		$req = $this->db->query("DELETE FROM inscription WHERE USER=$u AND DATEACT=$d");
		return $req;
	}
	
	public function DeletInscriptionById($id)
	{
		$u = $this->db->quote($id);
		$req = $this->db->query("DELETE FROM inscription WHERE NOINSCRIP=$u");
		if($req){return true;}else{return false;}
	}
	
	public function DeletParticipant($user)
	{
		$u = $this->db->quote($user);
		$req = $this->db->query("DELETE FROM `PARTICIPANT` WHERE NOISNCRIPT=$u");
		return $req;
	}
	
	public function DeletAnimation($code)
	{
		$u = $this->db->quote($code);
		$req = $this->db->query("DELETE FROM `animation` WHERE codeAnim=$u");
		return $req;
	}
	
	public function DeletActivite($code,$date)
	{
		$date = $this->db->quote($date);
		$code = $this->db->quote($code);
		$req = $this->db->query("DELETE FROM `activite` WHERE DATEACT=$date AND CODEANIM=$code");
		if($req){return true;}else{return false;}
	}
	
	// Fin Delet
	
	// Les Inserts	
	public function InsertProfil($login,$mdp,$nom,$prenom,$dateNow,$dateDebut,$DateFin,$type)
	{
		$req = ("INSERT INTO profil (login,mdp,nom,prenom,dateInscrip,dateDebutSejour,dateFinSejour,typeProfil) VALUES ('".$login."','".$mdp."','".$nom."','".$prenom."','".$dateNow."','".$dateDebut."','".$DateFin."','".$type."')");
		if($this->LoginExist($login)==0)
		{
			if($this->db->exec($req))
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	public function insertGroupe($login,$tv,$nb)
	{
		$l = $this->db->quote($login);
		$t = $this->db->quote($tv);
		$n = $this->db->quote($nb);
		$req = "INSERT INTO groupe (USER_ID,TYPE_VACANCIER,NBREPERSTP) VALUES ($l,$t,$n)";
		if($fp = $this->db->exec($req))
		{ return true; }else{return false;}
	}
		
	public function insertAdr($rue,$cp,$ville,$id,$adr)
	{
		$r = $this->db->quote($rue);
		$c = $this->db->quote($cp);
		$v = $this->db->quote($ville);
		$i = $this->db->quote($id);
		$a = $this->db->quote($adr);
		$req = $this->db->exec("INSERT INTO adresse (Rue,CodePostal,Ville,USER_ID,Adr) VALUES ($r,$c,$v,$i,$a)");
		if($req){ return true; } else{ return false; }
	}
	
	public function insertCommande($user_id,$formule)
	{
		$id = $this->db->quote($user_id);
		$f = $this->db->quote($formule);

		$req = $this->db->exec("INSERT INTO commande (USER_ID,FORMULE) VALUES ($id,$f)");
		if($req){ return true; } else{ return false; }
	}
	
	public function setInscription($NOINSCRIP,$USER,$CODEANIM,$DATEACT,$NBRETOTALINSCRIT)
	{
		$no = $this->db->quote($NOINSCRIP);
		$u = $this->db->quote($this->getIdUser($USER));
		$c = $this->db->quote($CODEANIM);
		$d = $this->db->quote($DATEACT);
		$nb = $this->db->quote($NBRETOTALINSCRIT);
		
		$req = $this->db->exec("INSERT INTO inscription (NOINSCRIP,USER,CODEANIM,DATEACT,NBRETOTALINSCRIT) VALUES ($no,$u,$c,$d,$nb)");
		if($req){ return true; } else{ return false; }
	}
	
	public function setParticipant($id,$code,$value)
	{
		$i = $this->db->quote($id);
		$c = $this->db->quote($code);
		$v = $this->db->quote($value);
		$req = $this->db->exec("INSERT INTO `participant`(`NOISNCRIPT`, `CODE_VACANCIER`, `NBREINSCRIT`) VALUES ($i,$c,$v)");
		if($req){ return true; } else{ return false; }
		var_dump($req);
	}
	
	public function setActivite($date,$selectAnim,$nom,$active)
	{
		$d = $this->db->quote($date);
		$s = $this->db->quote($selectAnim);
		$n = $this->db->quote($nom);
		$a = $this->db->quote($active);
		try{
		$req = $this->db->exec("INSERT INTO ACTIVITE (DATEACT,CODEANIM,NOMRESP,ANNULATIONACT) VALUES ($d,$s,$n,$a)");
		if($req){ return true; }else{ return false; }
		}catch(PDOException $e)
		{
			$e->getMessage();
		}
		
	}
	
	public function setAnimation($CDEANIM,$DesignAnim,$DescrAnim,$CommentAnim,$Duree,$Niveau,$NbrPlace,$HrRdv,$limitAge)
	{
		$c = $this->db->quote($CDEANIM);
		$d = $this->db->quote($DesignAnim);
		$des = $this->db->quote($DescrAnim);
		$com = $this->db->quote($CommentAnim);
		$du = $this->db->quote($Duree);
		$ni = $this->db->quote($Niveau);
		$nb = $this->db->quote($NbrPlace);
		$hr = $this->db->quote($HrRdv);
		$li = $this->db->quote($limitAge);
		try{
		$req = $this->db->exec("INSERT INTO animation
	(codeAnim,DESIGNATIONANIM,DESCRIPTANIM,COMMENTANIM,DUREEANIM,DIFFICULTEANIM,NBREPLACEANIM,HRRDV,LIMITAGE) 
	VALUES ($c,$d,$des,$com,$du,$ni,$nb,$hr,$li)");
		if($req){ return true; }else{ return false; }
		}catch(PDOException $e)
		{
			$e->getMessage();
		}
		
	}
	
	// Fin Insert
}

?>