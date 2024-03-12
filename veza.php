<?php

$veza = mysqli_connect('localhost', 'root', '', 'schoolapp');
if (!$veza) {
    exit('Error connecting to the database.');
}
