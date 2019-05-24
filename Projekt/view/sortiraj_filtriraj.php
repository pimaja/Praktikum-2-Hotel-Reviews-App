<h1>Odaberite kako želite da Vam hoteli budu sortirani i filtrirani</h1>
<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_sort_filt">
<h2>Odaberite kriterij/e po kojima želite sortirati:</h2>
<input type="checkbox" name="sort[]" value = "cijena_po_osobi"> Cijena <br />
<input type="checkbox" name="sort[]" value = "udaljenost_od_centra"> Udaljenost od centra <br />
<input type="checkbox" name="sort[]" value = "broj_osoba"> Broj osoba u sobi <br />
<input type="checkbox" name="sort[]" value = "ocjena"> Ocjena <br />
<input type="checkbox" name="sort[]" value = "broj_zvjezdica"> Broj zvjezdica <br />
<br />
<h2>Odaberite kriterij/e po kojima želite filtrirati:</h2>
<input type="checkbox" name="filter[]" value = "cijena_po_osobi"> Maksimalna cijena <input type="text" name="cijena"> kn <br />
<input type="checkbox" name="filter[]" value = "udaljenost_od_centra"> Udaljenost od centra najviše <input type="text" name="udaljenost"> km <br />
<input type="checkbox" name="filter[]" value = "broj_osoba"> Broj osoba u sobi <input type="text" name="osobe"> <br />
<input type="checkbox" name="filter[]" value = "tip_kreveta"> Tip kreveta u sobi
<dd> broj <input type="text" name="bracni"> bracnih </dd>
<dd> broj <input type="text" name="odvojeni"> odvojenih </dd>
<dd> broj <input type="text" name="na_kat"> na kat </dd>
<br />
<input type="checkbox" name="filter[]" value = "ocjena"> Minimalna ocjena <input type="text" name="ocjena"> (1-10) <br />
<input type="checkbox" name="filter[]" value = "broj_zvjezdica"> Minimalni broj zvjezdica <input type="text" name="zvjezdice"> (1-5) <br />
<input type="checkbox" name="filter[]" value = "vlastita_kupaonica"> Obvezna kupaonica<br />
<br />
<button type="submit" name="button">Dalje</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>
