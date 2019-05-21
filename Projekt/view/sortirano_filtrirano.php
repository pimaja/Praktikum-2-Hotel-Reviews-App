<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<?php foreach($hoteli as $popis)
      { ?>
       <table><tr><th>Ime hotela</th><th>Adresa hotela</th><th>Udaljenost od centra</th><th>Ocjena</th><th>Broj zvjezdica</th></tr>
          <?php foreach($popis as $var)
          {?>
            <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->adresa_hotela; ?> </td><td>
              <?php echo $var->udaljenost_od_centra; ?> </td><td> <?php echo $var->ocjena; ?> </td><td>
                <?php echo $var->broj_zvjezdica; ?> </td></tr>
        <?php  }
      }
      foreach ($sobe as $popis) { ?>
        <table><th>Ime hotela</th><th>Broj osoba u sobi</th><th>Tip kreveta u sobi</th><th>Vlastita kupaonica</th><th>Cijena po osobi po nocenju</th>
        <?php foreach($popis as $var)
          { ?>
        <tr><td> <?php echo $var->ime_hotela; ?> </td><td> <?php echo $var->broj_osoba; ?> </td><td>
          <?php echo $var->tip_kreveta; ?> </td><td> <?php echo $var->vlastita_kupaonica; ?> </td><td>
            <?php echo $var->cijena_po_osobi; ?> </td></tr>
      <?php  }
      } ?>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
