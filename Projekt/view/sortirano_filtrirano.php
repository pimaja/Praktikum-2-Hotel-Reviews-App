<?php require_once __SITE_PATH . '/view/_header.php';  ?>
<link rel="stylesheet" href="<?php echo __SITE_URL;?>/css/style2.css">
<h>Filtri: </h><br />
<?php foreach($filtri as $var)
          echo $var.' <br />';
      $i=0; ?>
<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=users/check_details">
<?php foreach($hoteli as $popis)
      { ?>
        <h2>Sortirano po: <?php if(isset($hotel_kriteriji[$i])) echo $hotel_kriteriji[$i].' <br />'; ?></h2>

          <?php if(!isset($hotel_kriteriji[$i]) ||
                  ($hotel_kriteriji[$i] === 'udaljenost_od_centra' || $hotel_kriteriji[$i] === 'ocjena' || $hotel_kriteriji[$i] === 'broj_zvjezdica'))
          { ?>
            <table><tr><th>Ime hotela</th><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th>
              <th> </th></tr>
            <?php foreach($popis as $var)
          {?>
            <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->adresa_hotela; ?> </td><td>
              <?php echo $var->udaljenost_od_centra; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
                <?php echo $var->broj_zvjezdica; ?> </td>
                <td><button type="submit" name="detalji" value="<?php echo $var->ime_hotela; ?>">Detalji</button><br /></td></tr>
        <?php  }
        }
        if(isset($hotel_kriteriji[$i]) && $hotel_kriteriji[$i] === 'cijena_po_osobi'){
          $j=0; ?>
          <table><tr><th>Ime hotela</th><th>Ocjena hotela</th><th>Broj zvjezdica</th><th>Cijena jedne od ponuđenih soba</th></tr>
            <th> </th></tr>
          <?php foreach($popis as $var)
          {?>
          <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
            <?php echo $var->broj_zvjezdica; ?> </td><td> <?php echo $sort_cijene[$j]; ?> </td>
            <td><button type="submit" name="detalji" value="<?php echo $var->ime_hotela; ?>">Detalji</button><br /></td></tr>
      <?php $j++; }
        }
        if (isset($hotel_kriteriji[$i]) && $hotel_kriteriji[$i] === 'broj_osoba'){
          $j=0; ?>
          <table><tr><th>Ime hotela</th><th>Ocjena hotela</th><th>Broj zvjezdica</th><th>Broj osoba u jednoj od ponuđenih soba</th>
            <th> </th></tr>
          <?php foreach($popis as $var)
          {?>
          <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
            <?php echo $var->broj_zvjezdica; ?> </td><td> <?php echo $sort_osobe[$j]; ?> </td>
            <td><button type="submit" name="detalji" value="<?php echo $var->ime_hotela; ?>">Detalji</button><br /></td></tr>
      <?php $j++; }
    }
      $i++; ?>
    </table> <?php
      }  ?>

      <button type="submit" name="natrag">Natrag</button><br /><br />
      <button type="submit" name="odlogiraj">Odlogiraj se</button>
    </form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
