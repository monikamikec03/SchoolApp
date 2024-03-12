<?php
include 'zaglavlje.php';




if (isset($_GET['id'])) {
    $id_ucenika = test_input($_GET['id']);
    if (!preg_match('/^[0-9]*$/', $id_ucenika)) {
        echo "<script>alert('Neispravan ID ucenika');window.location.href='ucenici.php'</script>";
    }
    $sql = "SELECT * FROM ucenici WHERE id_ucenika = $id_ucenika";
    $res = mysqli_query($veza, $sql);
    if (mysqli_num_rows($res) == 0) {
        echo "<script>alert('Nepostojeći predmet u bazi');window.location.href='ucenici.php'</script>";
    }
    $red = mysqli_fetch_array($res);
    $naziv_ucenika = $red['naziv_ucenika'];
    $id_ucenika = $red['id_ucenika'];
}
?>
<section class="p-3 container">
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0'>Ocjene: <?php echo $naziv_ucenika; ?></h4>
        <div>
            <a href='ucenici.php' class='btn btn-light'>Natrag</a>  
        </div>
    </div>
    <table class='table table-sm table-striped'>
        <thead>
            <tr>
                <th>Predmet</th>
                <th>Ocjena</th>
                <th></th>
            </tr>
            <tr>
                <form method="post" action="unos_ocjene.php">
                    <input type="hidden" name="ucenik_id" value="<?php echo $id_ucenika; ?>">
  
                    <th>
                        <select name="predmet_id" class="form-select">
                            <?php
                            $sql = "SELECT * FROM predmeti ORDER BY naziv_predmeta";
                            $res = mysqli_query($veza, $sql);
                            while($red = mysqli_fetch_array($res)){
                                $id_predmeta = $red["id_predmeta"];
                                $naziv_predmeta = $red["naziv_predmeta"];
                                ?>
                                <option value="<?php echo $id_predmeta; ?>"><?php echo $naziv_predmeta; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </th>
                    <th class="btn-group d-flex">
                        <?php
                        $sql = "SELECT * FROM ocjene ORDER BY id_ocjene";
                        $res = mysqli_query($veza, $sql);
                        while ($red = mysqli_fetch_array($res)) {
                            $id_ocjene = $red["id_ocjene"];
                            $naziv_ocjene = $red["naziv_ocjene"];
                            ?>
                        
                                <input type="radio" name="ocjena_id" class="btn-check" id="<?php echo $id_ocjene; ?>" autocomplete="off">
                                <label class="btn btn-outline-dark" for="<?php echo $id_ocjene; ?>"><?php echo $id_ocjene; ?></label>
                           
                            <?php
                        }
                        ?>
                    </th>
                    <th>
                        <input type="submit" class="btn btn-success w-100" value="Spremi" name="unos_ocjene">
                    </th>
                </form>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = 'SELECT * FROM ucenici ORDER BY updated_at DESC';
        $res = mysqli_query($veza, $sql);
        if (mysqli_num_rows($res) == 0) {
            echo "<tr><td colspan='3'>Nema podataka u bazi.</td></tr>";
        } 
        else {
            while ($red = mysqli_fetch_array($res)) {
            $naziv_ucenika = $red['naziv_ucenika'];
            $id_ucenika = $red['id_ucenika'];
            $email = $red['email'];
            $lozinka = $red['lozinka'];
            ?>
            <tr>
                <td><?php echo $naziv_ucenika; ?></td>
                <td><?php echo $naziv_ucenika; ?></td>
                <td><?php echo $naziv_ucenika; ?></td>

            </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
    
   

</section>
<?php include 'podnozje.php'; ?>