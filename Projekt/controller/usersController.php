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
				$_SESSION['login'] = $_POST['ime'] . $_POST['prezime'] . ',' . md5( $_POST['ime'] . $secret_word );;
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
			$_SESSION['login'] = $_POST['ime'] . $_POST['prezime'] . ',' . md5( $_POST['ime'] . $secret_word );;
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
			$ime_grada = $_POST['odabir'];
			//sad treba omogućiti da pretrazuje hotele po filerima(udaljenost, vlastita soba...) ili sortira(po cijeni...)
		}
	}

};

?>