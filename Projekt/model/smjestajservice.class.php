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
};

?>
