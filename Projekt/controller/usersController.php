<?php

class UsersController extends BaseController
{
	public function index()
	{

	}

	public function odlogiraj()
	{
		unset($_POST['ime']); unset($_POST['prezime']); unset($_POST['pass']);
		session_unset(); session_destroy();
		//$this->registry->template->show( 'login' );
		header( 'Location: ' . __SITE_URL . '/index.php?rt=start/index');
	}

	public function odabir()
	{
		$this->registry->template->title = 'Odaberi!';
		$this->registry->template->show( 'odabir' );
	}

	public function check_login()
	{
		$ss = new SmjestajService();
		if(isset($_POST['ime'], $_POST['prezime']))
			$lozinka = $ss->getPasswordByNameAndSurname( $_POST['ime'], $_POST['prezime'] );
		if(isset( $_POST['pass'] ))
			if(password_verify($_POST['pass'], $lozinka))
			{
				session_start();
				$secret_word = 'racunarski praktikum 2!!!';
				$_SESSION['login'] = $_POST['ime'] . ','. $_POST['prezime'] . ',' . md5( $_POST['ime'] . $secret_word );;
				header( 'Location: ' . __SITE_URL . '/index.php?rt=users/odabir');
				exit();
			}
			else $this->odlogiraj();
		else $this->odlogiraj();
	}

  public function check_register()
	{
		if(isset( $_POST['pass'] ) && isset( $_POST['pass2'] ) && isset( $_POST['pass'] )===isset( $_POST['pass2'] ))
		{
			$ss2 = new SmjestajService();
			$ss2->dodajUsera($_POST['ime'], $_POST['prezime'], $_POST['pass']);
			session_start();
			$secret_word = 'racunarski praktikum 2!!!';
			$_SESSION['login'] = $_POST['ime'] . ',' . $_POST['prezime'] . ',' . md5( $_POST['ime'] . $secret_word );;
			header( 'Location: ' . __SITE_URL . '/index.php?rt=users/odabir');
			exit();
		}
		else $this->odlogiraj();
	}

	public function check_odabir()
	{
		if(isset($_POST['odlogiraj']))
		{
			$this->odlogiraj();
			exit();
		}
		if(isset($_POST['odabir']))
		{
			$_SESSION['ime_grada'] = $_POST['odabir'];
			$this->registry->template->title = 'Sortiraj i filtriraj!';
			$this->registry->template->show( 'sortiraj_filtriraj' );
			//exit();
			//sad treba omogućiti da pretrazuje hotele po filerima(udaljenost, vlastita soba...) ili sortira(po cijeni...)
		}
	}

	public function check_sort_filt()
	{
		if(isset($_POST['odlogiraj']))
		{
			$this->odlogiraj();
			exit();
		}
		//$polje_polja_soba= array();
		$polje_polja_hotela= array();
		//$soba_kriteriji= array();
		$hotel_kriteriji= array();
		$filtri = array();
		if(isset($_POST['sort']))
		{
			$ss3 = new SmjestajService();

			if(isset($_POST['sort']))
			{
				$N = count($_POST['sort']);
				for($i=0; $i < $N; $i++)
	    	{
						$polje_hotela = $ss3->getHotelsByNameOrderBy($_SESSION['ime_grada'], $_POST['sort'][$i]);
						array_push($polje_polja_hotela, $polje_hotela);
						array_push($hotel_kriteriji, $_POST['sort'][$i]);
				}
		}
			if(isset($_POST['filter']))
			{
				$M = count($_POST['filter']);
				for($i=0; $i < $M; $i++)
				{
					if($_POST['filter'][$i] === 'cijena_po_osobi' && isset($_POST['cijena']))
					{
						$ss3->applyFilterCijena($polje_polja_hotela, $_POST['cijena']);
						array_push($filtri, 'cijena po osobi po noćenju najviše: '.$_POST['cijena']);
					}
					if($_POST['filter'][$i] === 'udaljenost_od_centra' && isset($_POST['udaljenost']))
					{
						$ss3->applyFilterUdaljenost($polje_polja_hotela, $_POST['udaljenost']);
						array_push($filtri, 'udaljenost od centra najviše: '.$_POST['udaljenost']);
					}
					if($_POST['filter'][$i] === 'broj_osoba' && isset($_POST['osobe']))
					{
						$ss3->applyFilterOsobe($polje_polja_hotela, $_POST['osobe']);
						array_push($filtri, 'broj osoba: '.$_POST['osobe']);
					}
					if($_POST['filter'][$i] === 'tip_kreveta' && (isset($_POST['bracni']) || isset($_POST['odvojeni']) || isset($_POST['na_kat'])))
					{
						$nizKreveti = array();
						if($_POST['bracni'] !== '' && $_POST['bracni'] !== '0') array_push($nizKreveti, $_POST['bracni'].' x bracni');
						if($_POST['odvojeni'] !== '' && $_POST['odvojeni'] !== '0') array_push($nizKreveti, $_POST['odvojeni'].' x odvojeni');
						if($_POST['na_kat'] !== '' && $_POST['na_kat'] !== '0') array_push($nizKreveti, $_POST['na_kat'].' x na kat');
						$string = ' ';
						foreach($nizKreveti as $var) $string.= $var.' ';
						$ss3->applyFilterKreveti($polje_polja_hotela, $nizKreveti);
						array_push($filtri, 'tip kreveta: '.$string);
					}
					if($_POST['filter'][$i] === 'ocjena' && isset($_POST['ocjena']))
					{
						$ss3->applyFilterOcjena($polje_polja_hotela, $_POST['ocjena']);
						array_push($filtri, 'minimalna ocjena: '.$_POST['ocjena']);
					}
					if($_POST['filter'][$i] === 'broj_zvjezdica' && isset($_POST['zvjezdice']))
					{
						$ss3->applyFilterZvjezdice($polje_polja_hotela, $_POST['zvjezdice']);
						array_push($filtri, 'minimalni broj zvjezdica: '.$_POST['zvjezdice']);
					}
					if($_POST['filter'][$i] === 'vlastita_kupaonica')
					{
						$ss3->applyFilterKupaonica($polje_polja_hotela);
						array_push($filtri, 'obvezna kupaonica' );
					}
				}
			}

			$sort_cijene = array();
			$sort_osobe = array();
			$i=0;
			$niz_id = array();
			foreach($polje_polja_hotela as $polje_hotela)
			{
				if($hotel_kriteriji[$i] === 'cijena_po_osobi')
				{
					foreach($polje_hotela as $hotel)
						array_push($niz_id, $hotel->id);
					array_unique($niz_id);
					foreach($polje_hotela as $hotel)
					{
						if(in_array($hotel->id, $niz_id))
							foreach($hotel->sobe as $soba)
							{
								array_push($sort_cijene, $soba->cijena_po_osobi);
								unset($niz_id[array_search($hotel->id, $niz_id)]);
							}
					}
				}
				if($hotel_kriteriji[$i] === 'broj_osoba')
				{
					foreach($polje_hotela as $hotel)
						array_push($niz_id, $hotel->id);
					array_unique($niz_id);
					foreach($polje_hotela as $hotel)
					{
						if(in_array($hotel->id, $niz_id))
							foreach($hotel->sobe as $soba)
							{
								array_push($sort_osobe, $soba->broj_osoba);
								unset($niz_id[array_search($hotel->id, $niz_id)]);
							}
					}
				}
				$i++;
			}
			sort($sort_cijene); sort($sort_osobe);
			$this->registry->template->hoteli = $polje_polja_hotela;
			//$this->registry->template->sobe = $polje_polja_soba;
			//$this->registry->template->soba_kriteriji = $soba_kriteriji;
			$this->registry->template->hotel_kriteriji = $hotel_kriteriji;
			$this->registry->template->filtri = $filtri;
			$this->registry->template->sort_cijene = $sort_cijene;
			$this->registry->template->sort_osobe = $sort_osobe;
			$this->registry->template->title = 'Sortiraj i filtriraj!';
			$this->registry->template->show( 'sortirano_filtrirano' );
			echo '<br>';

			//$ss3->obradiSort($_SESSION['ime_grada'], $_POST['sort']);
		}
	}

};

?>
