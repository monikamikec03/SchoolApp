<?php include 'zaglavlje.php'; ?>
<section class="p-3 container">
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0'>Ocjene učenika</h4>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>R.br.</th>
                <th>Naziv učenika</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $br = 0;
            $sql = 'SELECT * FROM ucenici ORDER BY updated_at DESC';
            $res = mysqli_query($veza, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo "<tr><td colspan='3'>Nema podataka u bazi.</td></tr>";
            } 
            else {
                while ($red = mysqli_fetch_array($res)) {
                $naziv_ucenika = $red['naziv_ucenika'];
                $id_ucenika = $red['id_ucenika'];
                ?>
                <tr>
                    <td><?php echo ++$br; ?>.</td>
                    <td><a href='pregled_ucenika.php?id=<?php echo $id_ucenika; ?>'><?php echo $naziv_ucenika; ?></a></td>
                </tr>
                <?php
                }
            }
        ?>
        </tbody>
    </table>
    
</section>
<?php include 'podnozje.php'; ?>