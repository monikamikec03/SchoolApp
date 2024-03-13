<?php
include 'zaglavlje.php';

//Resetiram sve vrijednosti jer mi lokalno javlja grešku undefined variable
$ucenik_id = $predmet_id = $ocjena_id = $id_zapisa = '';
$ucenik_idErr = $predmet_idErr = $ocjena_idErr = $porukaErr =  '';
$zaokruzeno = $sredina = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unos_ocjene'])) {

    $id_zapisa = test_input($_POST['id_zapisa']);

    if (empty($_POST['ucenik_id'])) {
        $ucenik_idErr = 'Morate popuniti polje učenik.';
    } else {
        $ucenik_id = test_input($_POST['ucenik_id']);
        if (!preg_match('/^[0-9 ]*$/', $ucenik_id)) {
            $ucenik_idErr = 'Imate nedopuštene znakove u učeniku.';
        }
    }

    if (empty($_POST['predmet_id'])) {
        $predmet_idErr = 'Morate popuniti polje predmet.';
    } else {
        $predmet_id = test_input($_POST['predmet_id']);
        if (!preg_match('/^[0-9 ]*$/', $predmet_id)) {
            $predmet_idErr = 'Imate nedopuštene znakove u predmetu.';
        }
    }

    if (empty($_POST['ocjena_id'])) {
        $ocjena_idErr = 'Morate popuniti polje ocjena.';
    } else {
        $ocjena_id = test_input($_POST['ocjena_id']);
        if (!preg_match('/^[0-9 ]*$/', $ocjena_id)) {
            $ocjena_idErr = 'Imate nedopuštene znakove u ocjeni.';
        }
    }

    if(empty($ucenik_idErr) && empty($predmet_idErr) && empty($ocjena_idErr)){

        //insert
        if (empty($id_zapisa)) {
            $sql = "INSERT INTO ocjene_ucenika (ucenik_id, predmet_id, ocjena_id) VALUES($ucenik_id, $predmet_id, $ocjena_id)";
        }
        //update
        else{
            $sql = "UPDATE ocjene_ucenika SET ocjena_id = $ocjena_id WHERE id = $id_zapisa AND predmet_id = $predmet_id AND ucenik_id = $ucenik_id";
        }
        if(mysqli_query($veza, $sql)){
            header("location:pregled_ucenika.php?id=$ucenik_id");
        }
        else{
            $porukaErr = "Pogreška prilikom spremanja ili ažuriranja podataka.";
        }

    }else{
        $porukaErr = "Niste ispravno popunili sva polja.";
    }

    
}


//dohvaćam podatke za učenika
if (isset($_GET['id'])) {
    $id_ucenika = test_input($_GET['id']);
    if (!preg_match('/^[0-9]*$/', $id_ucenika)) {
        echo "<script>alert('Neispravan ID učenika');window.location.href='index.php'</script>";
    }
    $sql = "SELECT * FROM ucenici WHERE id_ucenika = $id_ucenika";
    $res = mysqli_query($veza, $sql);
    if (mysqli_num_rows($res) == 0) {
        echo "<script>alert('Nepostojeći predmet u bazi');window.location.href='index.php'</script>";
    }
    $red = mysqli_fetch_array($res);
    $naziv_ucenika = $red['naziv_ucenika'];
    $id_ucenika = $red['id_ucenika'];

    //dohvaćam ocjene učenika
    $sql = "SELECT * FROM ocjene_ucenika WHERE ucenik_id = $id_ucenika";
    $res = mysqli_query($veza, $sql);
    if(mysqli_num_rows($res) > 0){
        while($red = mysqli_fetch_array($res)){
            $uneseni_predmet_id = $red["predmet_id"];
            //sve predmete pospremam u jedno polje kako bih kasnije mogla izračunati aritmetičku sredinu
            $uneseni_predmeti[] = $uneseni_predmet_id;
        }
        $uneseni_predmet_id = '';
        $uneseni_predmeti_str = implode(',', $uneseni_predmeti);

        $prvi_unos = 1;
    }
    else{
        $prvi_unos = 0;
    } 
    //prvi_unos mi treba dolje u select polju kada dohvaćam sve predmete, ne želim onda provjeravat koji predmeti su već uneseni jer nije nijedan, odnosno ocjene za koje predmete
    $backLink = "index.php";   
}
else if(isset($_GET['id_zapisa'])){ //update ocjene predmeta
    $id_zapisa = test_input($_GET['id_zapisa']);
    if (!preg_match('/^[0-9]*$/', $id_zapisa)) {
        echo "<script>alert('Neispravan ID zapisa');window.location.href='index.php'</script>";
    }
    $sql = "SELECT * FROM ocjene_ucenika, ucenici WHERE id = $id_zapisa
    And ucenik_id = id_ucenika";
    $res = mysqli_query($veza, $sql);
    if (mysqli_num_rows($res) == 0) {
        echo "<script>alert('Nepostojeći zapis u bazi');window.location.href='index.php'</script>";
        $id_zapisa = 0;
    }
    $red = mysqli_fetch_array($res);
    $id_ucenika = $red['ucenik_id'];
    $predmet_id = $red['predmet_id'];
    $ocjena_id = $red['ocjena_id'];
    $naziv_ucenika = $red['naziv_ucenika'];
    $backLink = "pregled_ucenika.php?id=$id_ucenika";
}
else{
    $backLink = "index.php";
}
?>
<section class="p-3 container">
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0'>Ocjene: <?php echo $naziv_ucenika; ?></h4>
        <div>
            <a href='<?php echo $backLink; ?>' class='btn btn-light'>Natrag</a>  
        </div>
        
    </div>
    <!-- Vraćam error u slučaju da dođe do izmjene -->
    <p class='text-danger'><?php echo $ucenik_idErr; ?></p>
    <p class='text-danger'><?php echo $predmet_idErr; ?></p>
    <p class='text-danger'><?php echo $ocjena_idErr; ?></p>
    <p class='text-danger'><?php echo $porukaErr; ?></p>
    <table class='table table-sm table-striped'>
        <thead>
            <tr>
                <th>Predmet</th>
                <th>Ocjena</th>
                <th></th>
            </tr>
            <tr>
                <form method="post" action="">
                    <input type="hidden" name="ucenik_id" value="<?php echo $id_ucenika; ?>">
                    <input type="hidden" name="id_zapisa" value="<?php echo $id_zapisa; ?>">
  
                    <th>
                        <!-- ovaj empty($id_zapisa) mi stavlja jednu klasu i kasnije kada imam update ocjene, želim koristit istu formu, ali ne želim da mi korisnik mijenja predmet i onda mu onemogućim promjenu podataka u ovom polju -->
                        <select name="predmet_id" class="form-select <?php if(!empty($id_zapisa)) echo 'editable'; ?>" id="predmet_id">
 

                            <option selected value=''>Odaberite predmet</option>
                            <?php
                            //tu su mi sad 2 select uvjeta, ovisno o tome jel ima već predmeta u bazi tak da maknem sve one za koje je već ocjena unesena, odnosno dohvatim sve ako nismo unijeli još nijednu ocjenu
                            if(empty($prvi_unos)){
                                
                                $sql = "SELECT * FROM predmeti ORDER BY naziv_predmeta";
                            } else {
                                
                                $sql = "SELECT * FROM predmeti WHERE id_predmeta NOT IN ($uneseni_predmeti_str) ORDER BY naziv_predmeta";
                            }
                            $res = mysqli_query($veza, $sql);
                            while($red = mysqli_fetch_array($res)){
                                $id_predmeta = $red["id_predmeta"];
                                $naziv_predmeta = $red["naziv_predmeta"];
                                ?>
                                <option value="<?php echo $id_predmeta; ?>" <?php if ($id_predmeta == $predmet_id)
                                       echo "selected"; ?>><?php echo $naziv_predmeta; ?></option>
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
                        
                                <input type="radio" name="ocjena_id" class="btn-check" id="<?php echo $id_ocjene; ?>" value="<?php echo $id_ocjene; ?>" autocomplete="off" <?php if ($id_ocjene == $ocjena_id)
                                          echo "checked"; ?>>
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
        //ovaj if sakriva cijelu tablicu ako dođe do izmjene, na taj način koristim opet istu formu, ali ne želim da osoba klika po nećem drugom, čisto radi intuitivnosti jer ako je kliknula da uredi ocjenu iz Matematike, u formu joj šibnem podatke za to i sve drugo sakrijem tak da se malo jače naglasi efekt uređivanja podataka.
        if (empty($id_zapisa)) {
            $sql = "SELECT * FROM ocjene_ucenika, predmeti, ocjene WHERE ucenik_id = $id_ucenika 
            AND predmeti.id_predmeta = ocjene_ucenika.predmet_id
            AND ocjene.id_ocjene = ocjene_ucenika.ocjena_id
            ORDER BY ocjene_ucenika.updated_at DESC";
            $res = mysqli_query($veza, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo "<tr><td colspan='3'>Nema podataka u bazi.</td></tr>";
            } else {
                while ($red = mysqli_fetch_array($res)) {
                    $id = $red['id'];
                    $naziv_predmeta = $red['naziv_predmeta'];
                    $naziv_ocjene = $red['naziv_ocjene'];
                    $id_ocjene = $red['id_ocjene'];
                    if ($id_ocjene == 1)
                        $klasa = 'text-danger';
                    else
                        $klasa = '';
                    $array_ocjene[] = $id_ocjene;

                    ?>
                <tr>
                    <td><?php echo $naziv_predmeta; ?></td>
                    <td class='<?php echo $klasa; ?>'><?php echo $naziv_ocjene; ?></td>
                    <td class="text-center">
                        <a class="link-primary" href="pregled_ucenika.php?id_zapisa=<?php echo $id; ?>">Uredi</a>
                        <a class="link-danger" href="obrisi_ocjenu.php?id=<?php echo $id; ?>">Obriši</a>
                    </td>

                </tr>
                <?php
                }
                if (!empty($array_ocjene)) {
                    $sredina = array_sum($array_ocjene) / count($array_ocjene);
                    $zaokruzeno = round($sredina);
                } 
                else{
                    $sredina = '';
                }
            }
        }
        ?>
            
        </tbody>
    </table>
    <?php
    //ako nema nijedne ocjene, nema smisla pokazat prosjek ocjena
    if (empty($id_zapisa)) { ?>
    <div class="bg-light p-3 border d-flex align-items-center justify-content-between">
        <p class='m-0'>Prosjek ocjena: <span class='fw-bold'><?php echo number_format($sredina, 2); ?></span></p>
        <h3>
            <?php
            $sql = "SELECT * FROM ocjene WHERE id_ocjene = $zaokruzeno";
            $res = mysqli_query($veza, $sql);
            if (mysqli_num_rows($res) > 0) {
                if (in_array(1, $array_ocjene)) {
                    $konacna_ocjena = '<span class="text-danger">Popravni ispit, potrebno ispraviti jedinice.</span>';
                } else {
                    if (mysqli_num_rows($res) > 0) {
                        $red = mysqli_fetch_array($res);
                        $konacna_ocjena = $red["naziv_ocjene"];
                    } else {
                        $konacna_ocjena = '';
                    }
                }

                echo $konacna_ocjena;
            }
            
            ?>
        </h3>
    </div>
    <?php } ?>
   
<script>
    // Disable user interaction with the dropdown
    document.getElementsByClassName('editable')[0].addEventListener('mousedown', function (event) {
        event.preventDefault();
    });
</script>
</section>
<?php include 'podnozje.php'; ?>