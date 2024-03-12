<?php
include 'zaglavlje.php';

$naziv_predmeta = $id_predmeta = $naziv_predmetaErr = $porukaErr = '';
$naslov = 'Unos predmeta';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['spremi'])) {

    $id_predmeta = $_POST['id_predmeta'];

    if (empty($_POST['naziv_predmeta'])) {
        $naziv_predmetaErr = 'Morate popuniti polje.';
    } else {
        $naziv_predmeta = test_input($_POST['naziv_predmeta']);
        if (!preg_match('/^[a-zA-ZćĆčČžŽšŠđĐ0-9 ]*$/', $naziv_predmeta)) {
            $naziv_predmetaErr = 'Imate nedopuštene znakove';
        }
    }
    if (empty($naziv_predmetaErr)) {

        if(empty($id_predmeta)){
            echo $id_predmeta;
            $sql = "INSERT INTO predmeti(naziv_predmeta) VALUES('$naziv_predmeta')";
        }
        else{
            $sql = "UPDATE predmeti SET naziv_predmeta = '$naziv_predmeta' WHERE id_predmeta = $id_predmeta";
        }
        
        if (mysqli_query($veza, $sql)) {
            header('location:predmeti.php');
        } else {
            $porukaErr = '<p class="alert alert-danger">Došlo je do pogreške.</p>';
        }
    } else {
        $porukaErr = '<p class="alert alert-danger">Niste ispravno popunili sva polja.</p>';
    }
}

if (isset($_GET['id'])) {
    $id_predmeta = test_input($_GET['id']);
    if (!preg_match('/^[0-9]*$/', $id_predmeta)) {
        echo "<script>alert('Neispravan ID predmeta');window.location.href='predmeti.php'</script>";
    }
    $sql = "SELECT * FROM predmeti WHERE id_predmeta = $id_predmeta";
    $res = mysqli_query($veza, $sql);
    if (mysqli_num_rows($res) == 0) {
        echo "<script>alert('Nepostojeći predmet u bazi');window.location.href='predmeti.php'</script>";
    }
    $red = mysqli_fetch_array($res);
    $naziv_predmeta = $red['naziv_predmeta'];
    $id_predmeta = $red['id_predmeta'];
    $naslov = 'Izmjena predmeta';
}
?>
<form class="p-3 container" action="" method="post">
    <input type='text' name='id_predmeta' value='<?php echo $id_predmeta; ?>' hidden>
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0'><?php echo $naslov; ?></h4>
        <div>
            <input type='submit' name='spremi' class='btn btn-success ms-4' value='Spremi'>
            <a href='unos_predmeta.php' class='btn btn-light'>Odustani</a>
            
        </div>
    </div>
    <div class="my-3 d-flex flex-column">
        <label for="naziv_predmeta" class="me-3">Naziv predmeta:</label>
        <span class='text-danger'><?php echo $naziv_predmetaErr; ?></span>
        <input type="text" name="naziv_predmeta" value="<?php echo $naziv_predmeta; ?>" class="form-control" minlength="2" maxlength="100" id="naziv_predmeta" autocomplete="off">
        
    </div>
    <?php echo $porukaErr; ?>

</form>
<?php include 'podnozje.php'; ?>