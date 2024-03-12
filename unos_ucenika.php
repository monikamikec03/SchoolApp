<?php
include 'zaglavlje.php';

$naziv_ucenika = $email = $lozinka = $emailErr = $lozinkaErr = $id_ucenika = $naziv_ucenikaErr = $porukaErr = '';
$naslov = 'Unos učenika';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['spremi'])) {

    $id_ucenika = $_POST['id_ucenika'];

    if (empty($_POST['naziv_ucenika'])) {
        $naziv_ucenikaErr = 'Morate popuniti polje.';
    } else {
        $naziv_ucenika = test_input($_POST['naziv_ucenika']);
        if (!preg_match('/^[a-zA-ZćĆčČžŽšŠđĐ0-9 ]*$/', $naziv_ucenika)) {
            $naziv_ucenikaErr = 'Imate nedopuštene znakove';
        }
    }
    if (empty($_POST['email'])) {
        $emailErr = '';
    } else {
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Niste napisali email adresu ispravnim formatom.';
        }
    }
    if (empty($_POST['lozinka'])) {
        $lozinkaErr = '';
    } else {
        $lozinka = test_input($_POST['lozinka']);
        if (!preg_match("/^[a-zA-ZćĆčČžŽšŠđĐ0-9?!*+='()\"\-_%&\/\,.;:   ]*$/",$lozinka)){
            $lozinkaErr = 'Imate nedopuštene znakove';
        }
        //$lozina_encrypted = sha1($lozinka); u ovom ili sličnom formatu moramo spremati inače lozinke, ali radi lakšeg testiranja stavljam otkrivenu lozinku
    }
    if (empty($naziv_ucenikaErr)) {

        if(empty($id_ucenika)){
            echo $id_ucenika;
            $sql = "INSERT INTO ucenici(naziv_ucenika, email, lozinka) VALUES('$naziv_ucenika', '$email', '$lozinka')";
        }
        else{
            $sql = "UPDATE ucenici SET naziv_ucenika = '$naziv_ucenika', email = '$email', lozinka = '$lozinka' WHERE id_ucenika = $id_ucenika";
        }
        
        if (mysqli_query($veza, $sql)) {
            header('location:ucenici.php');
        } else {
            $porukaErr = '<p class="alert alert-danger">Došlo je do pogreške.</p>';
        }
    } else {
        $porukaErr = '<p class="alert alert-danger">Niste ispravno popunili sva polja.</p>';
    }
}

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
    $email = $red['email'];
    $lozinka = $red['lozinka'];
    $id_ucenika = $red['id_ucenika'];
    $naslov = 'Izmjena učenika';
}
?>
<form class="p-3 container" action="" method="post">
    <input type='text' name='id_ucenika' value='<?php echo $id_ucenika; ?>' hidden>
    <div class='d-flex align-items-end justify-content-between border-0 border-bottom'>
        <h4 class='p-0 m-0'><?php echo $naslov; ?></h4>
        <div>
            <input type='submit' name='spremi' class='btn btn-success ms-4' value='Spremi'>
            <a href='unos_ucenika.php' class='btn btn-light'>Odustani</a>
            
        </div>
    </div>
    <div class="my-3 d-flex flex-column">
        <label for="naziv_ucenika" class="me-3">Naziv učenika:</label>
        <span class='text-danger'><?php echo $naziv_ucenikaErr; ?></span>
        <input type="text" name="naziv_ucenika" value="<?php echo $naziv_ucenika; ?>" class="form-control" minlength="2" maxlength="70" id="naziv_ucenika" autocomplete="off">
    </div>
    <div class="my-3 d-flex flex-column">
        <label for="email" class="me-3">Email:</label>
        <span class='text-danger'><?php echo $emailErr; ?></span>
        <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" minlength="5" maxlength="100" id="email" autocomplete="off">
    </div>
     <div class="my-3 d-flex flex-column">
        <label for="lozinka" class="me-3">Lozinka:</label>
        <span class='text-danger'><?php echo $lozinkaErr; ?></span>
        <input type="password" name="lozinka" value="<?php echo $lozinka; ?>" class="form-control" minlength="6" maxlength="20" id="lozinka" autocomplete="off">
    </div>
    <?php echo $porukaErr; ?>

</form>
<?php include 'podnozje.php'; ?>