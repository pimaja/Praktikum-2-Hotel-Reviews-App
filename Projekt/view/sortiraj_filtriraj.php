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
<br />
<input type="textbox" name="filter" value = "cijena"> Cijena iznosa <input type="text"> <br />
<input type="textbox" name="filter" value = "udaljenost"> Udaljenost od centra iznosa <input type="text"> km <br />
<input type="textbox" name="filter" value = "broj_osoba"> Broj osoba u sobi <input type="text"> <br />
<input type="textbox" name="filter" value = "ocjena"> Ocjena (1-10) <input type="text"> <br />
<input type="textbox" name="filter" value = "broj_zvjezdica"> Broj zvjezdica (1-5) <input type="text"> <br />
<br />
<button type="submit" name="button">Dalje</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>
