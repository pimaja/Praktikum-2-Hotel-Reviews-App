<h1>Odaberite kako želite da Vam hoteli budu sortirani i filtrirani</h1>
<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_sort_filt">
Odaberite kriterije po kojima želite sortirati:
<br />
<input type="textbox" name="sort" value = "cijena"> Cijena <br />
<input type="textbox" name="sort" value = "udaljenost"> Udaljenost od centra <br />
<input type="textbox" name="sort" value = "broj_osoba"> Broj osoba u sobi <br />
<input type="textbox" name="sort" value = "ocjena"> Ocjena <br />
<input type="textbox" name="sort" value = "broj_zvjezdica"> Broj zvjezdica <br />
<br />
Odaberite kriterij/e po kojima želite filtrirati:

<button type="submit" name="button">Dalje</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>
