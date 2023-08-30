<?php

$conn = new mysqli("localhost", "root", "password", "cinema");

if($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
}