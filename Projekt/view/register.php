<?php require_once __SITE_PATH . '/view/_header.php'; ?>
	<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_register">
	Ime: <input type="text" name="ime" /><br />
  Prezime: <input type="text" name="prezime" /><br />
	Password: <input type="password" name="pass"><br />
  Ponovi password: <input type="password" name="pass2"><br />
	<button type="submit">Registriraj se!</button>
	</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
