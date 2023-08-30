<?php

$conn = new mysqli("localhost", "root", "", "cinema");

if($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
}