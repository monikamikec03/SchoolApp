<?php include 'zaglavlje.php'; ?>
<section class="p-3 container">
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0'>Predmeti</h4>
        <a href='unos_predmeta.php' class='btn btn-primary ms-4'>+ Dodaj</a>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>R.br.</th>
                <th>Naziv predmeta</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $br = 0;
            $sql = 'SELECT * FROM predmeti ORDER BY updated_at DESC';
            $res = mysqli_query($veza, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo "<tr><td colspan='3'>Nema podataka u bazi.</td></tr>";
            } 
            else {
                while ($red = mysqli_fetch_array($res)) {
                $naziv_predmeta = $red['naziv_predmeta'];
                $id_predmeta = $red['id_predmeta'];
                ?>
                <tr>
                    <td><?php echo ++$br; ?>.</td>
                    <td><?php echo $naziv_predmeta; ?></td>
                    <td class='text-end'>
                        <span class=''>
                        <a href="unos_predmeta.php?id=<?php echo $id_predmeta; ?>" class="link-primary me-2">Uredi</a>
                        <a href="brisanje_predmeta.php?id=<?php echo $id_predmeta; ?>" class="link-danger">Obriši</a>
                        </span>
                    </td>
                </tr>
                <?php
                }
            }
        ?>
        </tbody>
    </table>
    
</section>
<?php include 'podnozje.php'; ?>