<?php require_once __SITE_PATH . '/view/_header.php';  ?>
<link rel="stylesheet" href="<?php echo __SITE_URL;?>/css/style2.css">

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

<h2>Pogledaj na karti: </h2>
<div id="mapa"></div>
<script>
/*var sir = [52.326110, 52.383840, 52.360590, 52.332880, 52.369030, 48.847500, 48.874670, 48.827110, 48.878540, 38.727700,
  38.726400, 38.715990, 38.721650, 52.521751, 52.512980, 52.530160, 55.780980, 55.777490, 55.744430, 55.758940, 37.985950,
  37.978230, 36.897220, 50.101140, 50.086980, 50.080800];
var duz = [4.953490, 4.902230, 4.915950, 4.920040, 4.897320, 2.371860, 2.305720, 2.348530, 2.370630, -9.158480, -9.142370,
  -9.143810, -9.146190, 13.411500, 13.405100, 13.401940, 37.620820, 37.580170, 37.635880, 37.605380, 23.720780, 23.724300,
  30.714830, 14.397590, 14.433370, 14.417900];
$( document ).ready( function()
{
  var id = "<?php echo $hotel->id ?>";
  var openLayerMap = new ol.Map(
        {
            target: 'mapa', // id elementa gdje će se nacrtati mapa
            layers: // koje slojeve ćemo prikazati na mapi
            [
                // OpenStreetMap
                new ol.layer.Tile( { source: new ol.source.OSM() } )
            ],
            view: new ol.View(
            {
                center: ol.proj.fromLonLat( [duz[id-1], sir[id-1]] ), // zemljopisne koord. centra mape
                zoom: 15
            })
        });
});*/
</script>

<br /><br />

<h2>Dodaj komentar: </h2>
<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_comments">
  Ocjena: <input type="text" name="ocjena" /><br />
  Opis: <br />
  <textarea name="komentar" rows="10" cols="50">
    Ovdje napišite komentar.
  </textarea><br />
<button type="submit" name="komentar_gumb">Dodaj komentar</button><br /><br />

<br /><br />

<button type="submit" name="natrag">Natrag</button><br /><br />
<button type="submit" name="odlogiraj">Odlogiraj se</button>
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
