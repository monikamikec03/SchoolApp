<?php
include("veza.php");

if(isset($_POST["grupa_podataka"]) && isset($_POST["sortiranje"])){
    $grupa_podataka = $_POST["grupa_podataka"];
    $sortiranje = $_POST["sortiranje"];

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
    ORDER BY $grupa_podataka $sortiranje";
    //ovdje sam tak postavila vrijednosti grupa_podataka da mi uvijek dohvati onaj parametar po kojem hoću sortirat

    /*GRUPA_PODATAKA value je jednak kao podaci u sql upitu, isto tak je SORTIRANJE ili ASC ili DESC
        <option value='ucenici.naziv_ucenika'>Naziv učenika</option>
        <option value='broj_ocjena'>Uneseno predmeta</option>
        <option value='prosjecna_ocjena'>Prosjek ocjena</option>
        <option value='broj_ocjena_jedan'>Broj jedinica</option>
    */
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
}
?>