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
        echo "<script>alert('Nepostojeći učenik u bazi');window.location.href='ucenici.php'</script>";
    }
    $red = mysqli_fetch_array($res);
    $id_ucenika = $red['id_ucenika'];

    $sql = "DELETE FROM ucenici WHERE id_ucenika = $id_ucenika";
    if(mysqli_query($veza, $sql)){
        echo "<script>alert('Učenik uspješno obrisan.');window.location.href='ucenici.php'</script>";
    }
    else{
        echo "<script>alert('Pogreška brisanja, pokušajte ponovno.');window.location.href='ucenici.php'</script>";
    }
}
?>

<?php include 'podnozje.php'; ?>