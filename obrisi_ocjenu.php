<?php
include 'zaglavlje.php';

if (isset($_GET['id'])) {
    $id = test_input($_GET['id']);
    if (!preg_match('/^[0-9]*$/', $id)) {
        echo "<script>alert('Neispravan ID');window.location.href='predmeti.php'</script>";
    }
    $sql = "SELECT * FROM ocjene_ucenika WHERE id = $id";
    $res = mysqli_query($veza, $sql);
    if (mysqli_num_rows($res) == 0) {
        echo "<script>alert('Nepostojeći ID u bazi');window.location.href='predmeti.php'</script>";
    }
    $red = mysqli_fetch_array($res);
    $id = $red['id'];
    $ucenik_id = $red['ucenik_id'];

    $sql = "DELETE FROM ocjene_ucenika WHERE id = $id";
    if(mysqli_query($veza, $sql)){
        echo "<script>alert('Zapis uspješno obrisan.');window.location.href=\"pregled_ucenika.php?id=$ucenik_id\"</script>";
    }
    else{
        echo "<script>alert('Pogreška brisanja, pokušajte ponovno.');window.location.href='index.php'</script>";
    }
}
?>

<?php include 'podnozje.php'; ?>