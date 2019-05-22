<?php

class SmjestajService
{
	function getPasswordByNameAndSurname( $name, $surname )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT password FROM projekt_korisnici WHERE name=:name AND surname=:surname' );
			$st->execute( array( 'name' => $name , 'surname' => $surname ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return $row['password'];
	}

	function dodajUsera ($name, $surname, $pass)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT INTO projekt_korisnici(name, surname, password) VALUES ' .
							'(:name, :surname, :password)' );
			$st->execute( array( 'name' => $name, 'surname'=>$surname,
							'password' => password_hash( $pass, PASSWORD_DEFAULT ) ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}
		function getHotelIdsByName( $ime_grada)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id FROM projekt_hoteli WHERE ime_grada=:ime_grada' );
			$st->execute(array('ime_grada' => $ime_grada));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = $row['id'];
		}

		return $arr;
	}

	function getHotelNameById( $id)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT ime_hotela FROM projekt_hoteli WHERE id=:id' );
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;

		return $row['ime_hotela'];
	}

	function getRoomsByNameOrderBy($ime_grada, $kriterij)
	{
		try
		{
			$db = DB::getConnection();
			if($kriterij === 'broj_osoba')
			{
				echo "uslo";
				$st = $db->prepare( 'SELECT * FROM projekt_sobe ORDER BY broj_osoba' );
			}
			if($kriterij === 'cijena_po_osobi')
			{
				echo "uslo1";
				$st = $db->prepare( 'SELECT * FROM projekt_sobe ORDER BY cijena_po_osobi' );
			}
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$ids = $this->getHotelIdsByName( $ime_grada);
		$arr = array();

		while( $row = $st->fetch() )
		{
			if(in_array($row['id_hotela'], $ids)) // greška!!
			{
				$ime_hotela = $this->getHotelNameById( $row['id_hotela']);
				$arr[] = new Soba($ime_hotela, $row['id'], $row['id_hotela'], $row['broj_osoba'], $row['tip_kreveta'], $row['vlastita_kupaonica'],
													$row['cijena_po_osobi']);
			}
		}


		return $arr;
	}

	function getHotelsByNameOrderBy( $ime_grada, $kriterij )
	{
		try
		{
			$db = DB::getConnection();
			if($kriterij === 'udaljenost_od_centra')
				$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada ORDER BY udaljenost_od_centra' );
			if($kriterij === 'ocjena')
				$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada ORDER BY ocjena' );
			if($kriterij === 'broj_zvjezdica')
				$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada ORDER BY broj_zvjezdica' );
			$st->execute(array('ime_grada' => $ime_grada));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Hotel( $row['id'], $row['ime_grada'], $row['ime_hotela'], $row['adresa_hotela'], $row['udaljenost_od_centra'],
														$row['ocjena'], $row['broj_zvjezdica'] );
		}

		return $arr;
	}

	function applyFilterCijena( & $polje_polja_soba, $cijena)
	{
		foreach($polje_polja_soba as $kljuc => $polje)
			foreach($polje as $key => $soba)
				if($soba->cijena_po_osobi > $cijena)
					unset($polje_polja_soba[$kljuc][$key]);
	}

	function applyFilterUdaljenost( & $polje_polja_hotela, $udaljenost)
	{
		foreach($polje_polja_hotela as $kljuc => $polje)
			foreach($polje as $key => $hotel)
				if($hotel->udaljenost_od_centra > $udaljenost)
					unset($polje_polja_hotela[$kljuc][$key]);
	}

	function applyFilterOsobe( & $polje_polja_soba, $osobe)
	{
		foreach($polje_polja_soba as $kljuc => $polje)
			foreach($polje as $key => $soba)
				if($soba->broj_osoba != $osobe)
					unset($polje_polja_soba[$kljuc][$key]);
	}

	function applyFilterOcjena( & $polje_polja_hotela, $ocjena)
	{
		foreach($polje_polja_hotela as $kljuc => $polje)
			foreach($polje as $key => $hotel)
				if($hotel->ocjena < $ocjena)
					unset($polje_polja_hotela[$kljuc][$key]);
	}

	function applyFilterZvjezdice( & $polje_polja_hotela, $zvjezdice)
	{
		foreach($polje_polja_hotela as $kljuc => $polje)
			foreach($polje as $key => $hotel)
				if($hotel->broj_zvjezdica < $zvjezdice)
					unset($polje_polja_hotela[$kljuc][$key]);
	}

	/*function obradiSort($ime_grada, $nizKriterija)
	{
		try
		{
			echo $ime_grada.'<br>';
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada' );
			$st->execute( array('ime_grada' => $ime_grada) );
			$cijena = array(); $udaljenost=array(); $osoba=array(); $ocjena=array(); $zvjezdica=array();
			$N = count($nizKriterija);
			$row = $st->fetch();
			if( $row === false )
				{return null; exit();}
			else{
				do{
					//echo $row['ime_hotela']. " ";
					//prolazimo po svakom od odabranih kriterija i pushamo u pripadni niz vrijednost iz tog reda za taj kriterij
					for($i=0; $i < $N; $i++)
			    {
			      	if($nizKriterija[$i]==="udaljenost") {
								array_push($udaljenost, $row['udaljenost_od_centra']);
								//echo $nizKriterija[$i]. " ". $row['udaljenost_od_centra']." ";
							}
							if($nizKriterija[$i]==="ocjena") {
								array_push($ocjena, $row['ocjena']);
								//echo $nizKriterija[$i]. " ". $row['ocjena']." ";
							}
							if($nizKriterija[$i]==="broj_zvjezdica") {
								array_push($zvjezdica, $row['broj_zvjezdica']);
								//echo $nizKriterija[$i]. " ". $row['broj_zvjezdica'];
							}
							if($nizKriterija[$i]==="cijena")
							{
								$st2 = $db->prepare( 'SELECT cijena_po_osobi FROM projekt_sobe WHERE id_hotela=:id_hotela' );
								$st2->execute( array('id_hotela' => $row['id']) );
								while($row2=$st2->fetch()){
									array_push($cijena, $row2['cijena_po_osobi']);
									//echo $nizKriterija[$i]. " ". $row2['cijena_po_osobi']." ";
								}
							}
							if($nizKriterija[$i]==="broj_osoba")
							{
								$st2 = $db->prepare( 'SELECT broj_osoba FROM projekt_sobe WHERE id_hotela=:id_hotela' );
								$st2->execute( array('id_hotela' => $row['id']) );
								while($row2=$st2->fetch()){
									array_push($osoba, $row2['broj_osoba']);
									//echo $nizKriterija[$i]. " ". $row2['broj_osoba']. " ";
								}
							}
			    }
					$row=$st->fetch();
				} while($row!== false);
				//sortiramo odabrane vrijednosti
				sort($cijena); sort($osoba); sort($udaljenost); sort($ocjena); sort($zvjezdica);
				//ispisujemo hotele s tim vrijednostima
				$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada' );
				$st->execute( array('ime_grada' => $ime_grada) );
				$N = count($nizKriterija);
				for($i=0; $i < $N; $i++)
				{
					if($nizKriterija[$i]==="udaljenost") {
						echo "<table><tr><th>Ime hotela</th><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th></tr>";
						foreach ($udaljenost as $u) {
							while($row=$st->fetch())
								if($row['udaljenost_od_centra']===$u){
									echo "<tr><td>". $row['ime_hotela']. "</td><td>".$row['adresa_hotela']. "</td><td>". $row['udaljenost_od_centra'].
									 "</td><td>".$row['ocjena']. "</td><td>". $row['broj_zvjezdica']. '</td></tr>';
								}
							$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada' );
							$st->execute( array('ime_grada' => $ime_grada) );
						}
						echo "</table>";
					}
					if($nizKriterija[$i]==="ocjena") {
						echo "<table><th>Ime hotela</th><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th>";
						foreach ($ocjena as $oc) {
							while($row=$st->fetch())
								if($row['ocjena']===$oc){
									echo "<tr><td>". $row['ime_hotela']. "</td><td>".$row['adresa_hotela']. "</td><td>". $row['udaljenost_od_centra'].
									 "</td><td>".$row['ocjena']. "</td><td>". $row['broj_zvjezdica']. '</td></tr>';
								}
							$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada' );
							$st->execute( array('ime_grada' => $ime_grada) );
						}
						echo "</table>";
					}
					if($nizKriterija[$i]==="broj_zvjezdica") {
						echo "<table><th>Ime hotela</th><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th>";
						foreach ($zvjezdica as $z) {
							while($row=$st->fetch())
								if($row['broj_zvjezdica']===$z){
									echo "<tr><td>". $row['ime_hotela']. "</td><td>".$row['adresa_hotela']. "</td><td>". $row['udaljenost_od_centra'].
									 "</td><td>".$row['ocjena']. "</td><td>". $row['broj_zvjezdica']. '</td></tr>';
								}
							$st = $db->prepare( 'SELECT * FROM projekt_hoteli WHERE ime_grada=:ime_grada' );
							$st->execute( array('ime_grada' => $ime_grada) );
						}
						echo "</table>";
					}
					if($nizKriterija[$i]==="cijena")
					{
						echo "<table><th>Ime hotela</th><th>Broj osoba u sobi</th><th>Tip kreveta u sobi</th><th>Vlastita kupaonica</th><th>Cijena po osobi po nocenju</th>";
						foreach ($cijena as $c) {
							$st2 = $db->query( 'SELECT * FROM projekt_sobe' );
							while($row2=$st2->fetch()){
								if($row2['cijena_po_osobi']===$c){
									$st=$db->prepare('SELECT ime_hotela FROM projekt_hoteli WHERE id=:id AND ime_grada=:ime_grada');
									$st->execute(array('id'=>$row2['id_hotela'], 'ime_grada'=>$ime_grada));
									if($row=$st->fetch()){
										echo "<tr><td>".$row['ime_hotela']. "</td><td>".$row2['broj_osoba']."</td><td>".$row2['tip_kreveta']."</td><td>";
										if($row2['vlastita_kupaonica']==='1') echo "da";
										else echo "ne";
										echo "</td><td>".$row2['cijena_po_osobi']. '</td></tr>';
									}
								}
							}
						}
						echo "</table>";
					}
					if($nizKriterija[$i]==="broj_osoba")
					{
						echo "<table><th>Ime hotela</th><th>Broj osoba u sobi</th><th>Tip kreveta u sobi</th><th>Vlastita kupaonica</th><th>Cijena po osobi po nocenju</th>";
						foreach ($osoba as $os) {
							$st2 = $db->query( 'SELECT * FROM projekt_sobe' );
							while($row2=$st2->fetch()){
								if($row2['broj_osoba']===$os){
									$st=$db->prepare('SELECT ime_hotela FROM projekt_hoteli WHERE id=:id AND ime_grada=:ime_grada');
									$st->execute(array('id'=>$row2['id_hotela'],'ime_grada'=>$ime_grada));
									if($row=$st->fetch()){
										echo "<tr><td>".$row['ime_hotela']. "</td><td>".$row2['broj_osoba']."</td><td>".$row2['tip_kreveta']."</td><td>";
										if($row2['vlastita_kupaonica']==='1') echo "da";
										else echo "ne";
										echo "</td><td>".$row2['cijena_po_osobi']. '</td></tr>';
									}
								}
							}
						}
						echo "</table>";
					}
				}
			}
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}*/
};

?>
