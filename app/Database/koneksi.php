<?php
$mysqli = new mysqli("localhost", "root", "", "peminjaman");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
