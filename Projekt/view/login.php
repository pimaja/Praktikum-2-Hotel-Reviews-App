<?php require_once __SITE_PATH . '/view/_header.php'; ?>

	<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_login">
	Ime: <input type="text" name="ime" /><br />
  Prezime: <input type="text" name="prezime" /><br />
	Password: <input type="password" name="pass"><br />
	<button type="submit">Ulogiraj se!</button>
	</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
