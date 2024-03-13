<?php include 'zaglavlje.php'; ?>
<section class="p-3 container">
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0 flex-shrink-1'>Ocjene učenika</h4>
        <div class='d-flex align-items-center'>
            <span>Sort: </span>
            <!-- u ajax.js dohvaćam podatke ovih polja koristeći javascript i šaljem ih u ajax.php gdje radim novi upit ovisno o podacima koje korisnik odabere -->
            <select class='flex-grow-1 form-select' name='grupa_podataka'>
                <option value=''></option>
                <option value='ucenici.naziv_ucenika'>Naziv učenika</option>
                <option value='broj_ocjena'>Uneseno predmeta</option>
                <option value='prosjecna_ocjena'>Prosjek ocjena</option>
                <option value='broj_ocjena_jedan'>Broj jedinica</option>
            </select>
            <select class='form-select flex-shrink-1' name='sortiranje'>
                <option value=''></option>
                <option value='ASC'>ASC</option>
                <option value='DESC'>DESC</option>
            </select>
            <a href='index.php'><i class="material-icons">refresh</i></a>
        </div>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>R.br.</th>
                <th>Naziv učenika</th>
                <th>Uneseno predmeta</th>
                <th>Prosjek ocjena</th>
                <th>Broj jedinica</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $br = 0;
        $sql = "SELECT 
        ucenici.*, 
        AVG(ocjene_ucenika.ocjena_id) AS prosjecna_ocjena,
        COUNT(ocjene_ucenika.ocjena_id) AS broj_ocjena,
        (
            SELECT COUNT(*)
            FROM predmeti
        ) AS broj_predmeta,
        SUM(CASE WHEN ocjene_ucenika.ocjena_id = 1 THEN 1 ELSE 0 END) AS broj_ocjena_jedan
        FROM ucenici
        LEFT JOIN ocjene_ucenika ON ucenici.id_ucenika = ocjene_ucenika.ucenik_id
        GROUP BY ucenici.id_ucenika
        ORDER BY ocjene_ucenika.updated_at DESC;";
        $res = mysqli_query($veza, $sql);
        if (mysqli_num_rows($res) == 0) {
            echo "<tr><td colspan='3'>Nema podataka u bazi.</td></tr>";
        } 
        else {
            while ($red = mysqli_fetch_array($res)) {
            $naziv_ucenika = $red['naziv_ucenika'];
            $id_ucenika = $red['id_ucenika'];
            $prosjecna_ocjena = $red['prosjecna_ocjena'];
            $broj_predmeta = $red['broj_predmeta'];
            $broj_ocjena = $red['broj_ocjena'];
            $broj_ocjena_jedan = $red['broj_ocjena_jedan'];
            if ($broj_ocjena != $broj_predmeta)
                $klasa = 'text-danger fw-bold';
            else
                $klasa = '';

            
            ?>
            <tr>
                <td><?php echo ++$br; ?>.</td>
                <td><a href='pregled_ucenika.php?id=<?php echo $id_ucenika; ?>'><?php echo $naziv_ucenika; ?></a></td>
                
                <td><?php echo "<span class='$klasa'>$broj_ocjena</span>/$broj_predmeta"; ?></td>
                <td><?php echo number_format($prosjecna_ocjena, 2); ?></td>
                <td><?php echo $broj_ocjena_jedan; ?></td>
            </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
    
</section>

<?php include 'podnozje.php'; ?>
<script src="ajax.js"></script>