<?php require_once __SITE_PATH . '/view/_header.php';  ?>

<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_odabir">
<br />
<input type="radio" name="odabir" value = "Amsterdam"> Amsterdam <br />
<input type="radio" name="odabir" value = "Atena"> Atena <br />
<input type="radio" name="odabir" value = "Berlin"> Berlin <br />
<input type="radio" name="odabir" value = "Lisabon"> Lisabon <br />
<input type="radio" name="odabir" value = "Moskva"> Moskva <br />
<input type="radio" name="odabir" value = "Pariz"> Pariz <br />
<input type="radio" name="odabir" value = "Prag"> Prag <br />
<br />
<button type="submit" name="button">Dalje</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
