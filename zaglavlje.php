<?php

include 'veza.php';

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchoolApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav class="bg-light py-2 ">
        <div class='container d-flex justify-content-between align-items-center'>
            <h5><a href='index.php' class='nav-link link-primary px-1'>SchoolApp</a></h5>
            <div class="d-flex align-items-center">
                <a href='ucenici.php' class='nav-link link-primary px-1'>Učenici</a>
                <a href='predmeti.php' class='nav-link link-primary px-1'>Predmeti</a>
            </div>
        </div>
    </nav>