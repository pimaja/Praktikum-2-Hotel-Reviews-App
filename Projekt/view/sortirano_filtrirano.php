<?php require_once __SITE_PATH . '/view/_header.php';  ?>
<h>Filtri: </h><br />
<?php foreach($filtri as $var)
          echo $var.' <br />';
      $i=0;
foreach($hoteli as $popis)
      { ?>
        <h>Sortirano po: <?php echo $hotel_kriteriji[$i].' <br />'; ?></h>

          <?php if($hotel_kriteriji[$i] === 'udaljenost_od_centra' || $hotel_kriteriji[$i] === 'ocjena' ||$hotel_kriteriji[$i] === 'broj_zvjezdica')
          { ?>
            <table><tr><th>Ime hotela</th><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th></tr>
            <?php foreach($popis as $var)
          {?>
            <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->adresa_hotela; ?> </td><td>
              <?php echo $var->udaljenost_od_centra; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
                <?php echo $var->broj_zvjezdica; ?> </td></tr>
        <?php  }
        }
        if($hotel_kriteriji[$i] === 'cijena_po_osobi'){
          $j=0; ?>
          <table><tr><th>Ime hotela</th><th>Ocjena hotela</th><th>Broj zvjezdica</th><th>Cijena jedne od ponuđenih soba</th></tr>
          <?php foreach($popis as $var)
          {?>
          <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
            <?php echo $var->broj_zvjezdica; ?> </td><td> <?php echo $sort_cijene[$j]; ?> </td></tr>
      <?php $j++; }
        }
        if ($hotel_kriteriji[$i] === 'broj_osoba'){
          $j=0; ?>
          <table><tr><th>Ime hotela</th><th>Ocjena hotela</th><th>Broj zvjezdica</th><th>Broj osoba u jednoj od ponuđenih soba</th></tr>
          <?php foreach($popis as $var)
          {?>
          <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
            <?php echo $var->broj_zvjezdica; ?> </td><td> <?php echo $sort_osobe[$j]; ?> </td></tr>
      <?php $j++; }
        } $i++;
      }  ?>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
