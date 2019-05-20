<?php require_once __SITE_PATH . '/view/_header.php'; ?>
	<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_register">
	Ime: <input type="text" name="name" /><br />
  Prezime: <input type="text" name="surname" /><br />
	Password: <input type="text" name="pass"><br />
	<button type="submit">Ulogiraj se!</button>
	</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
