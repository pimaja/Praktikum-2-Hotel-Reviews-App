<?php require_once __SITE_PATH . '/view/_header.php';  ?>

<h2><?php echo $hotel->ime_hotela; ?></h2>
<table><tr><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th></tr>
<tr><td> <?php echo $hotel->adresa_hotela; ?> </td><td><?php echo $hotel->udaljenost_od_centra; ?> </td>
  <td> <?php echo $hotel->ocjena; ?> </td><td><?php echo $hotel->broj_zvjezdica; ?> </td></tr></table>

<h2>Ponuđene sobe: </h2>
<table><tr><th>Broj osoba</th><th>Tip kreveta</th><th>Vlastita kupaonica</th><th>Cijena po osobi</th></tr>
<?php foreach($hotel->sobe as $soba)
{ ?>
<tr><td><?php echo $soba->broj_osoba; ?></td><td><?php echo $soba->tip_kreveta; ?></td>
  <td><?php echo $soba->vlastita_kupaonica; ?></td><td><?php echo $soba->cijena_po_osobi; ?></td></tr>
<?php } ?>
</table>

<h2>Komentari i ocjene: </h2>
<table><tr><th>Ime</th><th>Prezime</th><th>Komentar</th><th>Ocjena</th></tr>
<?php foreach($komentari as $komentar){ ?>
  <tr><td> <?php echo $komentar->ime_korisnika; ?> </td><td><?php echo $komentar->prezime_korisnika; ?> </td>
    <td> <?php echo $komentar->komentar; ?> </td><td><?php echo $komentar->ocjena_korisnika; ?> </td></tr>
<?php } ?>
</table>
<br /><br />

<h2>Dodaj komentar: </h2>
<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_comments">
  Ocjena: <input type="text" name="ocjena" /><br />
  Opis: <br />
  <textarea name="komentar" rows="10" cols="50">
    Ovdje napišite komentar.
  </textarea><br />
<button type="submit" name="komentar">Dodaj komentar</button><br /><br />

<br /><br />

<button type="submit" name="natrag">Natrag</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
