<h1>Odaberite kako želite da Vam hoteli budu sortirani i filtrirani</h1>
<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_sort_filt">
<h2>Odaberite kriterij/e po kojima želite sortirati:</h2>
<input type="checkbox" name="sort[]" value = "cijena"> Cijena <br />
<input type="checkbox" name="sort[]" value = "udaljenost"> Udaljenost od centra <br />
<input type="checkbox" name="sort[]" value = "broj_osoba"> Broj osoba u sobi <br />
<input type="checkbox" name="sort[]" value = "ocjena"> Ocjena <br />
<input type="checkbox" name="sort[]" value = "broj_zvjezdica"> Broj zvjezdica <br />
<br />
<h2>Odaberite kriterij/e po kojima želite filtrirati:</h2>
<input type="checkbox" name="filter[]" value = "cijena"> Cijena iznosa <input type="text"> kn <br />
<input type="checkbox" name="filter[]" value = "udaljenost"> Udaljenost od centra iznosa <input type="text"> km <br />
<input type="checkbox" name="filter[]" value = "broj_osoba"> Broj osoba u sobi <input type="text"> <br />
<input type="checkbox" name="filter[]" value = "tip_kreveta"> Tip kreveta u sobi
<dd> broj <input type="text" value="bracni" name="bracni"> bracnih </dd>
<dd> broj <input type="text" value="bracni" name="bracni"> odvojenih </dd>
<dd> broj <input type="text" value="bracni" name="bracni"> na kat </dd>
<br />
<input type="checkbox" name="filter[]" value = "ocjena"> Ocjena <input type="text"> (1-10) <br />
<input type="checkbox" name="filter[]" value = "broj_zvjezdica"> Broj zvjezdica <input type="text"> (1-5) <br />
<br />
<button type="submit" name="button">Dalje</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>
