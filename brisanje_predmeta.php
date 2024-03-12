<?php
include 'zaglavlje.php';

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
    $id_predmeta = $red['id_predmeta'];

    $sql = "DELETE FROM predmeti WHERE id_predmeta = $id_predmeta";
    if(mysqli_query($veza, $sql)){
        echo "<script>alert('Predmet uspješno obrisan.');window.location.href='predmeti.php'</script>";
    }
    else{
        echo "<script>alert('Pogreška brisanja, pokušajte ponovno.');window.location.href='predmeti.php'</script>";
    }
}
?>

<?php include 'podnozje.php'; ?>