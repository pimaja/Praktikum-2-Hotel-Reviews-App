<?php

class SmjestajService
{
	function getPasswordsNameAndSurname( $name, $surname )
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
};

?>
