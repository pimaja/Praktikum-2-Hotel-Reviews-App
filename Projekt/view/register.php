<?php require_once __SITE_PATH . '/view/_header.php'; ?>
	<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_login">
	Ime: <input type="text" name="name" /><br />
  Prezime: <input type="text" name="surname" /><br />
	Password: <input type="text" name="pass"><br />
  Ponovi password: <input type="text" name="pass2"><br />
	<button type="submit">Registriraj se!</button>
	</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
